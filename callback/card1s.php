<?php
    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA

    $no_bot = true;

    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_GET['status']) && isset($_GET['request_id'])) {
        $status = $_GET['status'];
        $request_id = $_GET['request_id'];

        $telco = $_GET['telco']; // NHÀ MẠNG
        $pin = $_GET['pin']; // MÃ THẺ
        $serial = $_GET['serial']; // SERIAL
        $amount = intval($_GET['amount']); // MỆNH GIÁ GỬI
        $amount_real = intval($_GET['amount_real']); // MỆNH GIÁ THỰC
        $amount_recieve = intval($_GET['amount_recieve']); // SỐ TIỀN NHẬN ĐƯỢC

        $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `auto-card` WHERE `request_id` = '$request_id' AND `status` = 'wait' "));

        if($info) {
            if($status == 'success') {
                $update = mysqli_query($conn, "UPDATE `auto-card` SET `status` = 'success', `amount_recieve` = '$amount_recieve' WHERE `request_id` = '$request_id' ");
                $cash = mysqli_query($conn, "UPDATE `users` SET `cash` = `cash` + '$amount_recieve', `total_cash` = `total_cash` + '$amount_recieve' WHERE `username` = '".$info['username']."' ");
                
                if($update && $cash){
                    $jzonTech = "Duyệt thành công thẻ <b class=\"jzon_custom\">".$info['telco']."</b> (Cộng <b style=\"color: red;\">".number_format($amount_recieve)." VNĐ</b> vào tài khoản)";
                    if(setting('nofication_success_card') == 'yes') {
                        sendTele(genContent($info['username'].": duyệt thành công thẻ ".$info['telco']." (Cộng ".number_format($amount_recieve)." VNĐ vào tài khoản)"));
                    }
                    addLog($jzonTech, $info['username']);
                    addTop($info['username'], $amount_recieve);
                    die("success approved");
                }
            } else {
                $update = mysqli_query($conn, "UPDATE `auto-card` SET `status` = 'error' WHERE `request_id` = '$content' ");
                if($update){
                    die('error approved');
                }
            }
        }else{
            die("not found rq id");
        }
    }
?>