<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon'])){
        if(isset($_SESSION['username'])){
            $code = xss($_POST['code']);
            $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `code` = '$code' AND `username` = '".$_SESSION['username']."' AND `status` = 'done' "));

            if(!$code){
                $res['error'] = HACKER_MSG;
                die(json_encode($res));
            }
            
            iF(!$info){
                $res['error'] = "Hỗ trợ này chưa được đóng nên không mở được.";
                die(json_encode($res));
            }

            $set = mysqli_query($conn, "UPDATE `support_list` SET `status` = 'process' WHERE `id` = '".$info['id']."' ");

            if($set){
                if(setting('nofication_action_support') == 'yes'){
                    sendTele(genContent($_SESSION['username']." thao tác mở hỗ trợ #".$info['code']));
                }
                $res['success'] = "Mở hỗ trợ thành công.";
                die(json_encode($res));
            }
            
        }else{
            $res['error'] = "Đăng nhập để tiếp tục";
            die(json_encode($res));
        }
    }

?>