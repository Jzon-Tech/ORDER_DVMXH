<?php 

    $admin_page = true;

    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");


    if(isset($_POST["jzon"]) && isset($_SESSION["admin"])){
        $type = xss($_POST["type"]);
        
        switch($type){
            case 'nofication':
                foreach ($_POST as $key => $value) {
                    mysqli_query($conn, "UPDATE `setting` SET `value` = '$value' WHERE `name` = '$key' ");
                }
    
                $res['success'] = "Đã lưu thay đổi cài đặt thông báo";
                die(json_encode($res));
                break;

            case 'jzonNofication':
                foreach ($_POST as $key => $value) {

                    $value = filter_var($value, FILTER_VALIDATE_BOOLEAN);

                    if($value){
                        $value = "yes";
                    }else{
                        $value = "no";
                    }

                    mysqli_query($conn, "UPDATE `setting` SET `value` = '$value' WHERE `name` = '$key' ");
                }
    
                $res['success'] = "Đã lưu thay đổi những nơi áp dụng thông báo";
                die(json_encode($res));
                break;
        }
            
    }