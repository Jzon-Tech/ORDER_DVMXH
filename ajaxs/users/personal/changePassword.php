<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon'])){
        if(isset($_SESSION['username'])){
            $password = xss($_POST['password']);
            $newPassword = xss($_POST['newPassword']);
            $renewPassword = xss($_POST['renewPassword']);

            if(!$password){
                $res['error'] = "Trường password không được để trống";
                die(json_encode($res));
            }

            if(!$newPassword){
                $res['error'] = "Trường newPassword không được để trống";
                die(json_encode($res));
            }

            if(!$renewPassword){
                $res['error'] = "Trường renewPassword không được để trống";
                die(json_encode($res));
            }

            if(typePassword($password) == infoMe('password')){
                if(strlen($password) > 6){
                    if($renewPassword == $newPassword){
                        $change = mysqli_query($conn, "UPDATE `users` SET `password` = '".typePassword($newPassword)."' WHERE `username` = '".$_SESSION['username']."' ");
                        if($change){
                            if(setting('nofication_changepass_member') == 'yes'){
                                sendTele(genContent($_SESSION['username']." đã thực hiện thay đổi mật khẩu"));
                            }
                            $res['success'] = "Thay đổi mật khẩu thành công";
                            die(json_encode($res));
                        }
                    }else{
                        $res['error'] = "Mật khẩu nhập lại không khớp";
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Mật khẩu mới không hợp lệ";
                    die(json_encode($res));
                }
            }else{
                $res['error'] = "Mật khẩu cũ không đúng, hãy thử lại";
                die(json_encode($res));
            }
        }else{
            $res['error'] = "Đăng nhập để tiếp tục";
            die(json_encode($res));
        }
    }