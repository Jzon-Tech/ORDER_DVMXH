<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon'])){
        if(isset($_SESSION['username'])){
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
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `code` = '$code' AND `username` = '".$_SESSION['username']."' "));
                if($info){
                    if($info['status'] == 'wait' || $info['status'] == 'process'){


                        if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_message` WHERE `code` = '$code' AND `sender` = '".$_SESSION['username']."' AND `isReply` = '0' ")) >= 5){
                            $res['error'] = "Vui lòng không SPAN, chờ trả lời...";
                            die(json_encode($res));
                        }


                        $insert = mysqli_query($conn, "INSERT INTO `support_message` SET 
                        `code` = '".$info['code']."',
                        `sender` = '".$_SESSION['username']."',
                        `message` = '".base64_encode($message)."',
                        `created_time` = '".time()."'
                        ");
                        if(setting('nofication_reply_support') == 'yes'){
                            sendTele(genContent($_SESSION['username']." đã trả lời hỗ trợ #".$info['code']." ($message)"));
                        }
                        $res['success'] = true;
                        $res['message'] = $message;
                        die(json_encode($res));
                    }else{
                        $res['error'] = "Hỗ trợ này đã được đóng, không tiếp nhận thêm.";
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