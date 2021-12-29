<?php
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon']) && isset($_SESSION['admin'])){
        switch (xss($_POST['type'])) {
            case 'addMessageSuggest':
                $message = xss($_POST['message']);

                if(!$message){
                    $res['error'] = "Trường message không được để trống.";
                    die(json_encode($res));
                }else{
                    $create = mysqli_query($conn, "INSERT INTO `message_suggest` (`message`) VALUES ('$message') ");
                    if($create){
                        $res['success'] = "Thêm tin nhắn thành công";
                        die(json_encode($res));
                    }
                }
                break;
            case 'deleteMessageSuggest':
                $id = intval($_POST['id']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `message_suggest` WHERE `id` = '$id' "));
                if($info){
                    $delete = mysqli_query($conn, "DELETE FROM `message_suggest` WHERE `id` = '$id' ");
                    if($delete){
                        $res['success'] = true;
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Tin nhắn này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            default:
                // code...
                break;
        }
        	
    }