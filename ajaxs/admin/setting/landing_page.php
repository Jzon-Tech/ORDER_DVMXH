<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");


    if(isset($_POST["jzon"]) && isset($_SESSION["admin"])){
        foreach ($_POST as $key => $value) {
            if($key != "type"){
                mysqli_query($conn, "UPDATE `setting` SET `value` = '$value' WHERE `name` = '$key' ");
            }
        }

        $res['success'] = "Đã lưu thay đổi cài đặt trang đích";
        die(json_encode($res));
    }