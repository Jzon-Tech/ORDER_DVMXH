<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");


    if(isset($_POST["jzon"]) && isset($_SESSION["admin"])){

        $maintenance_mode = xss($_POST['maintenance_mode']);
        
        $m = mysqli_query($conn, "UPDATE `setting` SET `value` = '$maintenance_mode' WHERE `name` = 'maintenance_mode' ");

        if($m) { 
            if($maintenance_mode == 'off'){
                $res['success'] = "Đã bật website hoạt động bình thường";
                die(json_encode($res));
            }

            if($maintenance_mode == 'on'){
                $res['success'] = "Đã chuyển trạng thái bảo trì website thành công";
                die(json_encode($res));
            }
        }

    }