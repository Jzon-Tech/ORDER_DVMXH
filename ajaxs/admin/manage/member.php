<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['type']) && isset($_POST['jzon']) && isset($_SESSION['admin'])){
        $type = xss($_POST['type']);
        switch ($type) {
            case 'infoUser':
                $id = intval($_POST['id']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$id' "));
                if($info){
                    $res['success'] = true;
                    $res['uid'] = $info['id'];
                    $res['username'] = $info['username'];
                    $res['cash'] = $info['cash'];
                    $res['level'] = showTypeAccount($info['level']);
                    $res['banned'] = $info['banned'];
                    die(json_encode($res));
                }else{
                    $res['error'] = "Thành viên này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            case 'saveUser':
                $id = intval($_POST['id']);
                $username = xss($_POST['username']);
                $cash = intval($_POST['cash']);
                $level = xss($_POST['level']);
                $banned = intval($_POST['banned']);
                
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$id' "));

                if($info){
                    if($level == ""){
                        $level = $info['level'];
                    }

                    $save = mysqli_query($conn, "UPDATE `users` SET 
                    `username` = '$username',
                    `cash` = '$cash',
                    `level` = '$level',
                    `banned` = '$banned'
                    WHERE `id` = '$id'
                    ");

                    if($save){
                        $res['success'] = "Đã lưu thay đổi.";
                        die(json_encode($res));
                    }

                }else{
                    $res['error'] = "Thành viên này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }

                break;
            case 'deleteUser':
                $id = intval($_POST['id']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$id' "));
                if($info){
                    $delete = mysqli_query($conn, "DELETE FROM `users` WHERE `id` = '$id' ");
                    if($delete){
                        $res['success'] = true;
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Thành viên này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            case 'plusCashUser':
                $id = intval($_POST['id']);
                $cash = intval($_POST['cash']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$id' "));
                $jzonCash = $info['cash'] + $cash;
                if($info){
                    $plus = mysqli_query($conn, "UPDATE `users` SET `cash` = `cash` + '$cash', `total_cash` = `total_cash` + '$cash' WHERE `id` = '$id' ");
                    if($plus){
                        addTop($info['username'], $cash);
                        addLog('Quản trị viên đã cộng <b style="color: blue;">'.number_format($cash).' VNĐ</b> - Còn lại: <b style="color: red;">'.number_format($jzonCash).' VNĐ</b>', $info['username']);
                        $res['success'] = "Cộng ".number_format($cash)." VNĐ cho ".$info['username']." thành công";
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Thành viên này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            case 'minusCashUser':
                $id = intval($_POST['id']);
                $cash = intval($_POST['cash']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `id` = '$id' "));
                $jzonCash = $info['cash'] - $cash;
                if($info){
                    $minus = mysqli_query($conn, "UPDATE `users` SET `cash` = `cash` - '$cash' WHERE `id` = '$id' ");
                    if($minus){
                        addLog('Quản trị viên đã trừ <b style="color: blue;">'.number_format($cash).' VNĐ</b> - Còn lại: <b style="color: red;">'.number_format($jzonCash).' VNĐ</b>', $info['username']);
                        $res['success'] = "Trừ ".number_format($cash)." VNĐ cho ".$info['username']." thành công";
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Thành viên này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            default:
                die('???');
                break;
        }
    }
?>