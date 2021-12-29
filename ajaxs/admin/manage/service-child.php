<?php
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon']) && isset($_SESSION['admin'])){
        switch (xss($_POST['type'])) {
            case 'addServiceChild':
                $service = xss($_POST['service']);
                $name = xss($_POST['name']);
                $icon = xss($_POST['icon']);
                $customOption = xss($_POST['customOption']);
                $extract_id = filter_var($_POST['extract_id'], FILTER_VALIDATE_BOOLEAN);
                $reactions_arr = xss($_POST['reactions_arr']);
                $amount_minimum = intval($_POST['amount_minimum']);
                $amount_maximum = intval($_POST['amount_maximum']);
                $warn_msg = $_POST['warn_msg'];
                $warn_msg = str_replace('<p><br></p>', '', $warn_msg);


                if(!$service || !$name || !$icon || !$amount_minimum || !$amount_maximum){
                    $res['error'] = "Vui lòng điền đầy đủ thông tin";
                    die(json_encode($res));
                }

                $infoService = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service` WHERE `key` = '$service' "));

                if($infoService){
                    if($customOption != ""){
                        switch($customOption){
                            case 'reactions':
                                $json_ex_re = explode(',', $reactions_arr);

                                foreach($json_ex_re as $reactions){
                                    $reaction = explode('|', $reactions)[0];
                                    $rate = intval(explode('|', $reactions)[1]);

                                    if(!$reaction || $rate < 0){
                                        $res['error'] = "Có gì đó sai sai";
                                        die(json_encode($res));
                                    }else{
                                        $valid_reactions_arr = ['like', 'love', 'haha', 'wow', 'care', 'sad', 'angry'];
                                        if(!in_array($reaction, $valid_reactions_arr)){
                                            $res['error'] = "Bạn đang cố tình bug à ?";
                                            die(json_encode($res));
                                        }
                                    }
                                }

                                $jzon_reactions = json_encode(explode(',', $reactions_arr));
                                $jzon_comment = "false";
                                break;

                            case 'comment':
                                $jzon_reactions = "";
                                $jzon_comment = "true";
                                break;

                            default:
                                $res['error'] = "Định dạng không đúng";
                                die(json_encode($res));
                                break;
                        }
                    }
                    if(is_bool($extract_id) === false){
                        $res['error'] = HACKER_MSG;
                        die(json_encode($res));
                    }
                    $insert = mysqli_query($conn, "INSERT INTO `list_service_child` SET 
                    `father` = '".$service."',
                    `slug` = '".genSlug($name, $infoService['name'])."',
                    `icon` = '$icon',
                    `name` = '$name',
                    `reactions` = '$jzon_reactions',
                    `comment_field` = '$jzon_comment',
                    `warn_msg` = '$warn_msg',
                    `autoExtractID` = '".xss($_POST['extract_id'])."',
                    `amount_minimum` = '$amount_minimum',
                    `amount_maximum` = '$amount_maximum'
                    ");

                    if($insert) {
                        $res['success'] = "Thêm dịch vụ con thành công";
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Dịch vụ bạn chọn không tồn tại.";
                    die(json_encode($res));
                }
                break;
            case 'saveServiceChild':
                $id = intval($_POST['id']);

                $name = xss($_POST['name']);
                $icon = xss($_POST['icon']);
                $customOption = xss($_POST['customOption']);
                $extract_id = filter_var($_POST['extract_id'], FILTER_VALIDATE_BOOLEAN);
                $reactions_arr = xss($_POST['reactions_arr']);
                $amount_minimum = intval($_POST['amount_minimum']);
                $amount_maximum = intval($_POST['amount_maximum']);
                $warn_msg = $_POST['warn_msg'];
                $warn_msg = str_replace('<p><br></p>', '', $warn_msg);


                if(!$name || !$icon || !$amount_minimum || !$amount_maximum){
                    $res['error'] = "Vui lòng điền đầy đủ thông tin";
                    die(json_encode($res));
                }
                $checkIdServiceChild = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `id` = '$id' "));
                $infoService = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service` WHERE `key` = '$service' "));

                if($checkIdServiceChild){ 
                    if($customOption != ""){
                        switch($customOption){
                            case 'reactions':
                                $json_ex_re = explode(',', $reactions_arr);

                                foreach($json_ex_re as $reactions){
                                    $reaction = explode('|', $reactions)[0];
                                    $rate = intval(explode('|', $reactions)[1]);

                                    if(!$reaction || $rate < 0){
                                        $res['error'] = "Có gì đó sai sai";
                                        die(json_encode($res));
                                    }else{
                                        $valid_reactions_arr = ['like', 'love', 'haha', 'wow', 'care', 'sad', 'angry'];
                                        if(!in_array($reaction, $valid_reactions_arr)){
                                            $res['error'] = "Bạn đang cố tình bug à ?";
                                            die(json_encode($res));
                                        }
                                    }
                                }

                                $jzon_reactions = json_encode(explode(',', $reactions_arr));
                                $jzon_comment = "false";
                                break;

                            case 'comment':
                                $jzon_reactions = "";
                                $jzon_comment = "true";
                                break;

                            default:
                                $res['error'] = "Định dạng không đúng";
                                die(json_encode($res));
                                break;
                        }
                    }else{
                        $jzon_comment = "false";
                    }
                    if(is_bool($extract_id) === false){
                        $res['error'] = HACKER_MSG;
                        die(json_encode($res));
                    }
                    $save = mysqli_query($conn, "UPDATE `list_service_child` SET 
                    `icon` = '$icon',
                    `name` = '$name',
                    `reactions` = '$jzon_reactions',
                    `comment_field` = '$jzon_comment',
                    `warn_msg` = '$warn_msg',
                    `autoExtractID` = '".xss($_POST['extract_id'])."',
                    `amount_minimum` = '$amount_minimum',
                    `amount_maximum` = '$amount_maximum'
                    WHERE `id` = '$id'
                    ");

                    if($save) {
                        $res['success'] = "Lưu thay đổi thành công";
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Bạn đang cố tình bug ??";
                    die(json_encode($res));
                }
                break;
            case 'deleteServiceChild':
                $id = intval($_POST['id']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `id` = '$id' "));
                if($info){
                    $delete = mysqli_query($conn, "DELETE FROM `list_service_child` WHERE `id` = '$id' ");
                    if($delete){
                        $res['success'] = true;
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Dịch vụ con này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            default:
                // code...
                echo "???";
                break;
        }
        	
    }