<?php
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon']) && isset($_SESSION['admin'])){
        switch (xss($_POST['type'])) {
            case 'saveRecharge':
                foreach ($_POST as $key => $value) {
                    if($key != "type"){
                        mysqli_query($conn, "UPDATE `setting` SET `value` = '$value' WHERE `name` = '$key' ");
                    }
                }
                $res['success'] = "Đã lưu thay đổi";
                die(json_encode($res));
                break;
            case 'addBank':
                $logo_bank = xss($_POST['logo_bank']);
                $owner = xss($_POST['owner']);
                $number_account = xss($_POST['number_account']);
                $branch = xss($_POST['branch']);
                $note = xss($_POST['note']);

                if(!$logo_bank || !$owner || !$number_account || !$branch){
                    $res['error'] = "Vui lòng điền đầy đủ thông tin";
                    die(json_encode($res));
                }

                $insert = mysqli_query($conn, "INSERT INTO `list_bank` SET
                `logo_bank` = '$logo_bank',
                `owner` = '$owner',
                `number_account` = '$number_account',
                `branch` = '$branch',
                `note` = '$note'
                ");

                if($insert){
                    $res['success'] = "Thêm ngân hàng thành công";
                    die(json_encode($res));
                }

                break;
            case 'infoBank':
                $id = intval($_POST['id']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_bank` WHERE `id` = '$id' "));
                if($info){
                    $res['success'] = true;
                    $res['id'] = $info['id'];
                    $res['logo_bank'] = $info['logo_bank'];
                    $res['owner'] = $info['owner'];
                    $res['number_account'] = $info['number_account'];
                    $res['branch'] = $info['branch'];
                    $res['note'] = $info['note'];
                    die(json_encode($res));
                }else{
                    $res['error'] = "Ngân hàng/ví điện tử này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            case 'saveBank':
                $id = intval($_POST['id']);
                $logo_bank = xss($_POST['logo_bank']);
                $owner = xss($_POST['owner']);
                $number_account = xss($_POST['number_account']);
                $branch = xss($_POST['branch']);
                $note = xss($_POST['note']);

                if(!$logo_bank || !$owner || !$number_account || !$branch){
                    $res['error'] = "Vui lòng điền đầy đủ thông tin";
                    die(json_encode($res));
                }

                $save = mysqli_query($conn, "UPDATE `list_bank` SET
                `logo_bank` = '$logo_bank',
                `owner` = '$owner',
                `number_account` = '$number_account',
                `branch` = '$branch',
                `note` = '$note'
                WHERE `id` = '$id'
                ");

                if($save){
                    $res['success'] = "Đã lưu thay đổi ngân hàng/ví điện tử";
                    die(json_encode($res));
                }

                break;
            case 'deleteBank':
                $id = intval($_POST['id']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_bank` WHERE `id` = '$id' "));
                if($info){
                    $delete = mysqli_query($conn, "DELETE FROM `list_bank` WHERE `id` = '$id' ");
                    if($delete){
                        $res['success'] = true;
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Ngân hàng/ví điện tử này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            default:
                // code...
                break;
        }
        	
    }