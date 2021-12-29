<?php 
    $admin_page = true;
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon'])){
        if(isset($_SESSION['admin'])){
            $message = xss($_POST['message']);
            $code = xss($_POST['code']);

            if(!$code){
                $res['error'] = HACKER_MSG;
                die(json_encode($res));
            }
            
            if(strlen($message) <= 8 || strlen($message) > 200){
                $res['error'] = "Nội dung tin nhắn không hợp lệ";
                die(json_encode($res));
            } else {
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `code` = '$code' "));
                if($info){
                    if($info['status'] == 'wait' || $info['status'] == 'process'){    
                        $insert = mysqli_query($conn, "INSERT INTO `support_message` SET 
                        `code` = '".$info['code']."',
                        `sender` = 'admin',
                        `message` = '".base64_encode($message)."',
                        `created_time` = '".time()."'
                        ");
                        $reply = mysqli_query($conn, "UPDATE `support_message` SET `isReply` = '1' WHERE `code` = '$code' ");

                        if($insert && $reply){
                            mysqli_query($conn, "UPDATE `support_list` SET `status` = 'process' WHERE `code` = '$code' ");
                            $res['success'] = true;
                            $res['message'] = $message;
                            die(json_encode($res));
                        }
                    }else{
                        $res['error'] = "Hỗ trợ này đã được đóng, không trả lời được.";
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Hỗ trợ này đã bị xóa hoặc không tồn tại.";
                    die(json_encode($res));
                }
            }
            
        }else{
            $res['error'] = "Đăng nhập để tiếp tục";
            die(json_encode($res));
        }
    }

?>