<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");
	
	if(isset($_POST['jzon'])){
        if(isset($_SESSION['username'])){
            $telco = xss($_POST['telco']);
            $amount = intval($_POST['amount']);
            $pin = xss($_POST['pin']);
            $serial = xss($_POST['serial']);
            $request_id = randomString();


            if(!$telco){
                $res['error'] = "Trường telco không được để trống";
                die(json_encode($res));
            }
            if(!$amount){
                $res['error'] = "Trường amount không được để trống";
                die(json_encode($res));
            }
            if(!$pin){
                $res['error'] = "Trường pin không được để trống";
                die(json_encode($res));
            }
            if(!$serial){
                $res['error'] = "Trường serial không được để trống";
                die(json_encode($res));
            }
            
            $call = card1s($telco, $amount, $pin, $serial, $request_id);

            if(isset($call['status'])){
                if($call['status'] == 'success'){
                    $insert = mysqli_query($conn, "INSERT INTO `auto-card` SET 
                    `username` = '".$_SESSION['username']."',
                    `request_id` = '$request_id',
                    `telco` = '$telco',
                    `amount_origin` = '$amount',
                    `pin` = '$pin',
                    `serial` = '$serial',
                    `status` = 'wait',
                    `created_time` = '".time()."',
                    `day` = '".date('d')."',
                    `month` = '".date('m')."',
                    `year` = '".date('Y')."'
                    ");

                    if($insert){
                        $res['success'] = "Gửi thẻ thành công, vui lòng chờ...";
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = $call['message'];
                    die(json_encode($res));
                }
            }

        }else{
            $res['error'] = "Đăng nhập để tiếp tục...";
            die(json_encode($res));
        }
	}
?>