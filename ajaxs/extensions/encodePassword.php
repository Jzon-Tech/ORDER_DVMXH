<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");


    if(isset($_POST["jzon"])){
        $password = xss($_POST['password']);

        if(!$password){
            $res['error'] = "Vui lòng nhập mật khẩu";
            die(json_encode($res));
        }else{
            $res['success'] = true;
            $res['encode'] = typePassword($password);
            die(json_encode($res));
        }
    }