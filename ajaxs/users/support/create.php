<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	if(isset($_POST['jzon'])){
		if(isset($_SESSION['username'])){
			$title = xss($_POST['title']);
			$problem = xss($_POST['problem']);
			$service = xss($_POST['service']);
			$describe = xss($_POST['describe']);
			$fileJzon = xss($_POST['file']);

			$infoProblem = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `support_problem` WHERE `key` = '$problem' "));
			$infoOrder = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `order` WHERE `code` = '$service' AND `buyer` = '".$_SESSION['username']."' "));


			if(!$title){
				$res['error'] = "Trường title không được để trống";
				die(json_encode($res));
			}

			if(!$problem){
				$res['error'] = "Trường problem không được để trống";
				die(json_encode($res));
			}

			if(!$infoProblem){
				$res['error'] = HACKER_MSG;
				die(json_encode($res));
			}

			if(!$service){
				$res['error'] = "Trường service không được để trống";
				die(json_encode($res));
			}

			if($service != "noService"){

				if(!$infoOrder){
					$res['error'] = HACKER_MSG;
					die(json_encode($res));
				}
			}

			if(!$describe){
				$res['error'] = "Trường describe không được để trống";
				die(json_encode($res));
			}

			if($fileJzon == ""){
				if (isset($_FILES['file']['name'])) {
	            	$filename = $_FILES['file']['name'];
	            	
	            	if(validIMG('file') === true){
	            		$uploads_dir = '../../../frontend/public/images/support';
				        $tmp_name = $_FILES['file']['tmp_name'];
				        $ext = pathinfo($filename, PATHINFO_EXTENSION);
				        $url_img = "/jzon_".sha1(md5(time())).".".$ext;
				        $jzonMove = move_uploaded_file($tmp_name, $uploads_dir.$url_img);
				        $jzonFullUrl = "https://".$_SERVER['SERVER_NAME']."/frontend/public/images/support".$url_img;
	            	}else{
	            		$res['error'] = "Các tập tin trong trường hình ảnh phải là định dạng hình ảnh.";
						die(json_encode($res));
	            	}

				}
			}

			$support_code = randomString(8);
	        $insert = mysqli_query($conn, "INSERT INTO `support_list` SET
	        `code` = '$support_code',
	        `username` = '".$_SESSION['username']."',
	        `title` = '$title',
	        `problem` = '".$infoProblem['name']."',
	        `service` = '$service',
	        `describe` = '$describe',
	        `img_url` = '$jzonFullUrl',
	        `status` = 'wait',
	        `created_time` = '".time()."'
	        ");
	        $message = "Tôi muốn hỗ trợ: $title";
	        $insert_message = mysqli_query($conn, "INSERT INTO `support_message` (`code`, `sender`, `message`, `created_time`) VALUES ('$support_code', '".$_SESSION['username']."', '".base64_encode($message)."', '".time()."') ");

	        if($jzonFullUrl != ""){
	        	$insert_image = mysqli_query($conn, "INSERT INTO `support_message` (`code`, `sender`, `image`, `created_time`) VALUES ('$support_code', '".$_SESSION['username']."', '$jzonFullUrl', '".time()."') ");
	        }

	        if($insert){
				if(setting('nofication_new_support') == 'yes') {
					sendTele(genContent($_SESSION['username']." gửi yêu cầu hỗ trợ ($title)"));
				}
	        	addLog($_SESSION['username']." tạo yêu cầu hỗ trợ với tiêu đề: <b style='color: red;'>$title</b>", $_SESSION['username']);
	        	$res['success'] = "Tạo yêu cầu hỗ trợ thành công";
	        	$res['code'] = $support_code;
	        	die(json_encode($res));
	        }else{
	        	$res['error'] = ERROR_MSG;
	        	die(json_encode($res));
	        }


		}else{
			$res['error'] = "Đăng nhập để tiếp tục...";
			die(json_encode($res));
		}
	}
?>