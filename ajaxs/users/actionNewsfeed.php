<?php 

    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA
        
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	if(isset($_POST['jzon'])){
		if(isset($_SESSION['username'])){
			$type = xss($_POST['type']);
			$key = xss($_POST['key']);

			switch ($type) {
				case 'likePost':
					$check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `newsfeed` WHERE `key` = '$key' "));

					if($check){
						$isLike = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `like_post` WHERE `post_key` = '$key' AND `username` = '".$_SESSION['username']."' "));
						if(!$isLike){
							$like = mysqli_query($conn, "INSERT INTO `like_post` (`post_key`, `username`, `created_time`) VALUES ('$key', '".$_SESSION['username']."', '".time()."') ");
							if($like){
								
								if(setting('nofication_like_post') == 'yes'){
									sendTele(genContent($_SESSION['username']." đã like bài viết (Key Post: $key)"));
								}

								$res['success'] = true;
								$res['like_count'] = number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `like_post` WHERE `post_key` = '$key' ")));
								die(json_encode($res));
							}else{
								$res['error'] = ERROR_MSG;
								die(json_encode($res));
							}
						}else{
							$res['error'] = "Bạn đã like bài viết này rồi";
							die(json_encode($res));
						}
					}else{
						$res['error'] = "Bài viết đã được xóa hoặc không tồn tại";
						die(json_encode($res));
					}

					break;
				case 'unlikePost':
					$check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `newsfeed` WHERE `key` = '$key' "));

					if($check){
						$isLike = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `like_post` WHERE `post_key` = '$key' AND `username` = '".$_SESSION['username']."' "));
						if($isLike){
							$unlike = mysqli_query($conn, "DELETE FROM `like_post` WHERE `post_key` = '$key' AND `username` = '".$_SESSION['username']."' ");
							if($unlike){
								$res['success'] = true;
								$res['like_count'] = number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `like_post` WHERE `post_key` = '$key' ")));
								die(json_encode($res));
							}else{
								$res['error'] = ERROR_MSG;
								die(json_encode($res));
							}
						}else{
							$res['error'] = "Bạn chưa like bài viết này";
							die(json_encode($res));
						}
					}else{
						$res['error'] = "Bài viết đã được xóa hoặc không tồn tại";
						die(json_encode($res));
					}

					break;
				default:
					// code...
					break;
			}
		}else{
			$res['error'] = "Đăng nhập để tiếp tục...";
			die(json_encode($res));
		}
	}

?>