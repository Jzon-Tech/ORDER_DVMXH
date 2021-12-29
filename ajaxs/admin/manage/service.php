<?php
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon']) && isset($_SESSION['admin'])){
        switch (xss($_POST['type'])) {
            case 'addService':
                $name = xss($_POST['name']);
                $icon = xss($_POST['icon']);

                if(!$name || !$icon){
                    $res['error'] = "Vui lòng điền đầy đủ thông tin.";
                    die(json_encode($res));
                }else{
                    $create = mysqli_query($conn, "INSERT INTO `list_service` (`name`, `icon`, `key`) VALUES ('$name', '$icon', '".md5(time())."') ");
                    if($create){
                        $res['success'] = "Thêm dịch vụ thành công";
                        die(json_encode($res));
                    }
                }
                break;
            case 'deleteService':
                $id = intval($_POST['id']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service` WHERE `id` = '$id' "));
                if($info){
                    $delete = mysqli_query($conn, "DELETE FROM `list_service` WHERE `id` = '$id' ");
                    if($delete){
                        $res['success'] = true;
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Dịch vụ này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            case 'infoService':
                $id = intval($_POST['id']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service` WHERE `id` = '$id' "));
                if($info){
                    $res['success'] = true;
                    $res['name'] = $info['name'];
                    $res['icon'] = $info['icon'];
                    $res['key'] = $info['key'];
                    die(json_encode($res));
                }else{
                    $res['error'] = "Dịch vụ này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            case 'saveService':
                $key = xss($_POST['key']);
                $name = xss($_POST['name']);
                $icon = xss($_POST['icon']);

                if(!$name || !$icon){
                    $res['error'] = "Vui lòng điền đầy đủ thông tin.";
                    die(json_encode($res));
                }

                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service` WHERE `key` = '$key' "));
                if($info){
                    $save = mysqli_query($conn, "UPDATE `list_service` SET `name` = '$name', `icon` = '$icon' WHERE `key` = '$key' ");
                    if($save){
                        $res['success'] = "Đã lưu thay đổi dịch vụ";
                        die(json_encode($res));
                    }
                    die(json_encode($res));
                }else{
                    $res['error'] = "Dịch vụ này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            default:
                // code...
                break;
        }
        	
    }