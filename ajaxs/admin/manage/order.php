<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['type']) && isset($_POST['jzon']) && isset($_SESSION['admin'])){
        $type = xss($_POST['type']);
        switch($type){
            case 'actionOrder':
                $action = xss($_POST['action']);
                $orderCode = xss($_POST['orderCode']);
                $totalCode = intval($_POST['totalCode']);
                $totalCode2 = count(explode(",", $orderCode)) - 1;

                if($totalCode2 != $totalCode){
                    $res['error'] = "Bạn đang cố tình bug ??";
                    die(json_encode($res));
                }
                $jzonExplode = explode(",", $orderCode);
                
                switch ($action) {
                    case 'done':
                        foreach($jzonExplode as $code){
                            if($code != ""){
                                mysqli_query($conn, "UPDATE `order` SET `status` = 'done' WHERE `code` = '$code' ");
                            }
                        }
                        $res['success'] = "Đã thao tác duyệt đơn hàng loạt";
                        die(json_encode($res));

                        break;
                    
                    case 'running':
                        foreach($jzonExplode as $code){
                            if($code != ""){
                                mysqli_query($conn, "UPDATE `order` SET `status` = 'running' WHERE `code` = '$code' ");
                            }
                        }
                        $res['success'] = "Đã thao tác đang chạy đơn hàng loạt";
                        die(json_encode($res));
                        break;
                    
                    case 'fail':
                        foreach($jzonExplode as $code){
                            if($code != ""){
                                $isBack = filter_var($_POST['isBack'], FILTER_VALIDATE_BOOLEAN);
                                if($isBack === true){
                                    $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `order` WHERE `code` = '$code' "));
                                    if($info){
                                        addLog('Hoàn tiền đơn hàng <b style="color: black;">'.$info['code'].'</b> với số tiền <b style="color: red;">'.number_format($info['total_cash']).' VNĐ</b>', $info['buyer']);
                                        mysqli_query($conn, "UPDATE `users` SET `cash` = `cash` + '".$info['total_cash']."' WHERE `username` = '".$info['buyer']."' ");
                                        mysqli_query($conn, "UPDATE `order` SET `total_back` = '".$info['total_cash']."' WHERE `code` = '".$info['code']."' ");
                                    }
                                }
                                mysqli_query($conn, "UPDATE `order` SET `status` = 'fail' WHERE `code` = '$code' ");
                            }
                        }
                        $res['success'] = "Đã thao tác hủy đơn hàng loạt";
                        die(json_encode($res));
                        break;

                    case 'delete':
                        foreach($jzonExplode as $code){
                            if($code != ""){
                                mysqli_query($conn, "DELETE FROM `order` WHERE `code` = '$code' ");
                            }
                        }
                        $res['success'] = "Đã thao tác xóa đơn hàng loạt";
                        die(json_encode($res));
                        break;

                    case 'message':
                        $message = xss($_POST['message']);
                        foreach($jzonExplode as $code){
                            if($code != ""){
                                mysqli_query($conn, "UPDATE `order` SET `admin_note` = '$message' WHERE `code` = '$code' ");
                            }
                        }
                        $res['success'] = "Đã thao tác nhắn tin hàng loạt";
                        die(json_encode($res));
                        break;
                    default:
                        die('???');
                        break;
                }
                break;
            default:
                die("???");
                break;
        }
            
    }
?>