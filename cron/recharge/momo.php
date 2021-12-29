<?php
    
    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA
    
    $no_bot = true;

    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(!setting('momo_token')){
        die("Momo token is missing.");
    }

    $call = json_decode(jzonCurl("https://api.web2m.com/historyapimomo1h/".setting('momo_token')), true);

    foreach($call['momoMsg']['tranList'] as $momo) {
        $partnerId      = $momo['partnerId'];
        $comment        = $momo['comment'];
        $tranId         = $momo['tranId'];
        $partnerName    = $momo['partnerName'];
        $amount         = $momo['amount'];
        $extractComment = jzonParseContent($comment);

        if(setting('memo_mode') == 'user'){
            $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$extractComment' LIMIT 1"));
        }else if(setting('memo_mode') == 'uid'){
            $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$extractComment' LIMIT 1"));
        }else{
            die("No method found.");
        }

        $momoData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `auto-momo` WHERE `tranId` = '$tranId' "));

        if(!$momoData){
            if($user){
                $insert = mysqli_query($conn, "INSERT INTO `auto-momo` SET
                `mode` = '".setting('memo_mode')."',
                `username` = '".$user['username']."',
                `tranId` = '$tranId',
                `partnerId` = '$partnerId',
                `partnerName` = '$partnerName',
                `amount` = '$amount',
                `comment` = '$comment',
                `created_time` = '".time()."',
                `day` = '".date('d')."',
                `month` = '".date('m')."',
                `year` = '".date('Y')."'
                ");
                $cash = mysqli_query($conn, "UPDATE `users` SET `cash` = `cash` + '$amount', `total_cash` = `total_cash` + '$amount' WHERE `username` = '".$user['username']."' ");
                
                if($insert && $cash){
                    $jzonTech = "Nạp <b style=\"color: red;\">".number_format($amount)." VNĐ</b> qua Ví MOMO (Mã giao dịch: <b style=\"color: green;\">".$tranId."</b>)";
                    if(setting('nofication_momo') == 'yes') {
                        sendTele(genContent($user['username'].": nạp ".number_format($amount)." VNĐ qua Ví MOMO (Mã giao dịch: ".$tranId.")"));
                    }
                    addLog($jzonTech, $user['username']);
                    addTop($user['username'], $amount);

                }
            }
        }
        
    }
 