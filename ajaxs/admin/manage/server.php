<?php
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon']) && isset($_SESSION['admin'])){
        switch (xss($_POST['type'])) {
            case 'showMoreServiceChild':
                $service = xss($_POST['service']);
                
                if($service != ""){
                    $serviceChild = mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `father` = '$service' ");
                    while($child = mysqli_fetch_assoc($serviceChild)) {
                        echo '<option value="'.$child['slug'].'">'.$child['name'].'</option>'."\n";
                    }
                }

                break;
            case 'addServer':
                $service = xss($_POST['service']);
                $serviceChild = xss($_POST['serviceChild']);
                $note = xss($_POST['note']);
                $display = xss($_POST['display']);
                $display_arr = ['show', 'hide'];
                $price = intval($_POST['price']);
                $max_order = intval($_POST['max_order']);

                if(!$service || !$serviceChild || !$note){
                    $res['error'] = "Vui lòng điền đầy đủ thông tin";
                    die(json_encode($res));
                }

                if(!in_array($display, $display_arr)){
                    $res['error'] = "Bạn đang cố tình bug ??";
                    die(json_encode($res));
                }

                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `father` = '$service' AND `slug` = '$serviceChild' LIMIT 1"));

                if($info){
                    $insert = mysqli_query($conn, "INSERT INTO `list_server` (`key`, `slug`, `note`, `price`, `display`, `max_order`) VALUES ('".md5(time())."', '$serviceChild', '$note', '$price', '$display', '$max_order') ");
                    if($insert){
                        $res['success'] = "Thêm máy chủ thành công";
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Something went wrong ??";
                    die(json_encode($res));
                }
                break;
            case 'infoServer':
                $id = intval($_POST['id']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_server` WHERE `id` = '$id' "));
                if($info){
                    $res['success'] = true;
                    $res['key'] = $info['key'];
                    $res['note'] = $info['note'];
                    $res['price'] = $info['price'];
                    $res['max_order'] = $info['max_order'];
                    
                    if($info['display'] == 'show'){
                        $res['display'] = '<option value="show">🟢 HIỆN</option>
                        <option value="hide">🔴 ẨN</option>';
                    }else{
                        $res['display'] = '<option value="hide">🔴 ẨN</option>
                        <option value="show">🟢 HIỆN</option>';
                    }

                    die(json_encode($res));
                }else{
                    $res['error'] = "Dịch vụ này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;

            case 'saveServer':
                $key = xss($_POST['key']);
                $note = xss($_POST['note']);
                $price = intval($_POST['price']);
                $max_order = intval($_POST['max_order']);
                $display = xss($_POST['display']);
                $display_arr = ['show', 'hide'];


                if(!$key || !$note){
                    $res['error'] = "Vui lòng điền đầy đủ thông tin";
                    die(json_encode($res));
                }

                if(!in_array($display, $display_arr)){
                    $res['error'] = "Bạn đang cố tình bug ??";
                    die(json_encode($res));
                }

                $check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_server` WHERE `key` = '$key' "));

                if($check){
                    $save = mysqli_query($conn, "UPDATE `list_server` SET `note` = '$note', `price` = '$price', `display` = '$display', `max_order` = '$max_order' WHERE `key` = '$key' ");

                    if($save){
                        $res['success'] = "Lưu thông tin máy chủ thành công";
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "???";
                    die(json_encode($res));
                }


                break;
            case 'deleteServer':
                $id = intval($_POST['id']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_server` WHERE `id` = '$id' "));
                if($info){
                    $delete = mysqli_query($conn, "DELETE FROM `list_server` WHERE `id` = '$id' ");
                    if($delete){
                        $res['success'] = true;
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Máy chủ này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            default:
                // code...
                break;
        }
        	
    }