<?php
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon']) && isset($_SESSION['admin'])){
        switch (xss($_POST['type'])) {
            case 'createPost':
                $content = $_POST['content'];
                $content = str_replace('<p><br></p>', '', $content);

                $poster = "Quản trị viên";


                if(!$content){
                    $res['error'] = "Trường content không được để trống.";
                    die(json_encode($res));
                }else{
                    $create = mysqli_query($conn, "INSERT INTO `newsfeed` (`key`, `poster`, `content`, `created_time`) VALUES ('".md5(time())."', '$poster', '$content', '".time()."') ");
                    if($create){
                        $res['success'] = "Đăng bài thành công";
                        die(json_encode($res));
                    }
                }
                break;
            case 'deletePost':
                $id = intval($_POST['id']);
                $info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `newsfeed` WHERE `id` = '$id' "));
                if($info){
                    $delete = mysqli_query($conn, "DELETE FROM `newsfeed` WHERE `id` = '$id' ");
                    if($delete){
                        $res['success'] = true;
                        die(json_encode($res));
                    }
                }else{
                    $res['error'] = "Bài viết này không tồn tại hoặc đã bị xóa";
                    die(json_encode($res));
                }
                break;
            default:
                // code...
                break;
        }
        	
    }