<?php
    
    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA
    
    $no_bot = true;

    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(!setting('vcb_token')){
        die("VCB token is missing.");
    }

    $stk = explode('_', setting('vcb_token'))[0];
    $mk = explode('_', setting('vcb_token'))[1];
    $mk = explode('|', $mk)[0];
    $token = explode('|', setting('vcb_token'))[1];

    $result = curl_get("https://api.web2m.com/historyapivcb/$mk/$stk/$token");
    $result = json_decode($result, true);

    if($result['status'] != true)
    {
        die('Lấy dữ liệu thất bại');
    }

    foreach($result['data']['ChiTietGiaoDich'] as $data)
    {
        $des = $data['MoTa'];
        $amount = str_replace(',' ,'', $data['SoTienGhiCo']);
        $tid = $data['SoThamChieu'];

        $extractComment = jzonParseContent($des);

        if(setting('memo_mode') == 'user'){
            $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$extractComment' LIMIT 1"));
        }else if(setting('memo_mode') == 'uid'){
            $user = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$extractComment' LIMIT 1"));
        }else{
            die("No method found.");
        }

        if ($user)
        {
            if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `bank_auto` WHERE `tid` = '$tid' ")) == 0)
            {
                if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `bank_auto` WHERE `description` = '$des' ") == 0)
                {
                    mysqli_query($conn, "INSERT INTO `bank_auto` (`tid`, `description`, `amount`, `time`, `username`) VALUES ('$tid', '$des', '$amount', '".time()."', '".$user['username']."') ");

                    $jzonTech = "Nạp <b style=\"color: red;\">".number_format($amount)." VNĐ</b> qua Vietcombank (Mã giao dịch: <b style=\"color: green;\">".$tid."</b>)";
                    if(setting('nofication_vcb') == 'yes') {
                        sendTele(genContent($user['username'].": nạp ".number_format($amount)." VNĐ qua Vietcombank (Mã giao dịch: ".$tid.")"));
                    }
                    addLog($jzonTech, $user['username']);
                    addTop($user['username'], $amount);
                }
            }
        }    
    }
?>