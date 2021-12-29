<?php 
    $admin_page = true;
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon'])){
        if(isset($_SESSION['admin'])){
            $code = xss($_POST['code']);
            $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `code` = '$code' "));

            if(!$code){
                $res['error'] = HACKER_MSG;
                die(json_encode($res));
            }
            
            iF(!$info){
                $res['error'] = "Hỗ trợ này đã được xóa hoặc không tồn tại";
                die(json_encode($res));
            }

            $delete = mysqli_query($conn, "DELETE FROM `support_list` WHERE `id` = '".$info['id']."' ");
            $reset_ms = mysqli_query($conn, "DELETE FROM `support_message` WHERE `code` = '$code' ");
            if($delete && $reset_ms){
                $res['success'] = "Xóa hỗ trợ thành công.";
                die(json_encode($res));
            }
            
        }else{
            $res['error'] = "Đăng nhập để tiếp tục";
            die(json_encode($res));
        }
    }

?>