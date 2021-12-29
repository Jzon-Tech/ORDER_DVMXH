<?php
    
    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA
    
    $no_bot = true;
    
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(!setting('zalo_token')){
        die("Zalo Pay token is missing.");
    }

    $call = json_decode(jzonCurl("https://api.web2m.com/historyapizalopay/".setting('zalo_token')), true);

    if($call['status'] === true && $call['code'] == 200) {

        foreach($call['data'] as $zalo) {
            $owner          = $zalo['appusername'];
            $transid        = $zalo['transid'];
            $amount         = $zalo['amount'];
            $comment        = $zalo['description'];
            $transfer_time  = $zalo['reqdate'];
            $extractComment = jzonParseContent($comment);

            if(setting('memo_mode') == 'user'){
                $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$extractComment' LIMIT 1"));
            }else if(setting('memo_mode') == 'uid'){
                $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$extractComment' LIMIT 1"));
            }else{
                die("No method found.");
            }

            $zaloData = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `auto-zalo-pay` WHERE `transid` = '$transid' "));

            if(!$zaloData){
                if($user){
                    $insert = mysqli_query($conn, "INSERT INTO `auto-zalo-pay` SET
                    `mode` = '".setting('memo_mode')."',
                    `username` = '".$user['username']."',
                    `transid` = '$transid',
                    `owner` = '$owner',
                    `amount` = '$amount',
                    `comment` = '$comment',
                    `created_time` = '".microtime($transfer_time)."',
                    `day` = '".date('d', microtime($transfer_time))."',
                    `month` = '".date('m', microtime($transfer_time))."',
                    `year` = '".date('Y', microtime($transfer_time))."'
                    ");
                    $cash = mysqli_query($conn, "UPDATE `users` SET `cash` = `cash` + '$amount', `total_cash` = `total_cash` + '$amount' WHERE `username` = '".$user['username']."' ");
                    
                    if($insert && $cash){
                        $jzonTech = "Nạp <b style=\"color: red;\">".number_format($amount)." VNĐ</b> qua Zalo Pay (Mã giao dịch: <b style=\"color: green;\">".$transid."</b>)";
                        if(setting('nofication_zalopay') == 'yes') {
                            sendTele(genContent($user['username'].": nạp ".number_format($amount)." VNĐ qua Zalo Pay (Mã giao dịch: ".$transid.")"));
                        }
                        addLog($jzonTech, $user['username']);
                        addTop($user['username'], $amount);
                    }
                }
            }
            
        }
    
    }else{
        die('Lấy dữ liệu Zalo Pay thất bại!');
    }