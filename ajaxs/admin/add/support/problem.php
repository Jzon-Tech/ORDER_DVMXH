<?php
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon']) && isset($_SESSION['admin'])){
        switch (xss($_POST['type'])) {
            case 'addSupportProblem':
                $prob = xss($_POST['prob']);

                if(!$prob){
                    $res['error'] = "Trường prob không được để trống.";
                    die(json_encode($res));
                }else{
                    $create = mysqli_query($conn, "INSERT INTO `support_problem` (`key`, `name`) VALUES ('".sha1(time())."', '$prob') ");
                    if($create){
                        $res['success'] = "Thêm vấn đề hỗ trợ thành công";
                        die(json_encode($res));
                    }
                }
                break;
            case 'deleteSupportProblem':
                $id = intval($_POST['id']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `support_problem` WHERE `id` = '$id' "));
                if($info){
                    $delete = mysqli_query($conn, "DELETE FROM `support_problem` WHERE `id` = '$id' ");
                    if($delete){
                        $res['success'] = true;
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Vấn đề này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            default:
                // code...
                break;
        }
        	
    }