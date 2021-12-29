<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");
	
	if(isset($_POST['jzon'])){
		if(isset($_SESSION['username'])){
			$slug = xss($_POST['slug']);
			$object_id = xss($_POST['object_id']);
			$list_comment = xss($_POST['list_comment']);
			$amount = intval($_POST['amount']);
			$reactions = xss($_POST['reactions']);
			$server = xss($_POST['server']);
			$note = xss($_POST['note']);
			$info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `slug` = '$slug' "));
			$infoServer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_server` WHERE `key` = '$server' AND `display` = 'show' "));
			$infoFather = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service` WHERE `key` = '".$info['father']."' "));

			if($info){
				if(!$object_id){
					$res['error'] = "Trường object id không được bỏ trống.";
					die(json_encode($res));
				}

				if($amount < $info['amount_minimum']){
					$res['error'] = "Tối thiểu ".$info['amount_minimum']." lượt";
					die(json_encode($res));
				}

				if($amount > $info['amount_maximum']){
					$res['error'] = "Tối đa ".$info['amount_maximum']." lượt";
					die(json_encode($res));
				}

				if($info['reactions'] != "" && filter_var($info['comment_field'], FILTER_VALIDATE_BOOLEAN) !== true) { 
					if(!$reactions){
						$res['error'] = "Trường reactions không được để trống.";
						die(json_encode($res));
					}

					$reactions_arr = json_decode($info['reactions'], true);


					if(!in_array($reactions, $reactions_arr)){
						$res['error'] = HACKER_MSG;
						die(json_encode($res));
					}

					$rate_reactions = explode("|", $reactions)[1];
				}else if(filter_var($info['comment_field'], FILTER_VALIDATE_BOOLEAN) === true){
					//is coment
					if(!$list_comment){
						$res['error'] = "Trường list_comment không được để trống.";
						die(json_encode($res));
					}

					if(countLineText($list_comment) != $amount){
						$res['error'] = "Vui lòng kiểm tra lại thao tác.";
						die(json_encode($res));
					}
				}

				if(!$server){
					$res['error'] = "Trường server không được để trống.";
					die(json_encode($res));
				}

				if($infoServer){

					$total_cash = calculatePrice($infoServer['price'], $amount, $rate_reactions, intval(setting('discount_'.infoMe('level'))));

					if($total_cash > infoMe('cash')){
						$cash_recharge = $total_cash - infoMe('cash');
						$res['error'] = "Số dư không đủ để giao dịch (cần nạp thêm ".number_format($cash_recharge)." VNĐ)";
						die(json_encode($res));
					}

					$checkId = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `order` WHERE `object_id` = '$object_id' AND `status` = 'running' LIMIT 1"));

					if($checkId) {
						$res['error'] = "object id này đang trong quá trình chạy, vui lòng chờ hoàn tất rồi thao tác lại.";
						die(json_encode($res));
					}

					$total_runing = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE `server` = '".$infoServer['key']."' AND `status` = 'running' "));

					if($total_runing >= $infoServer['max_order']){
						$res['error'] = "Máy chủ này hiện đang quá tải, bạn hãy tạo đơn qua máy chủ khác. Rất xin lỗi quý khách hàng!";
						die(json_encode($res));
					}

					$update_cash = mysqli_query($conn, "UPDATE `users` SET `cash` = `cash` - '$total_cash', `used_cash` = `used_cash` + '$total_cash' WHERE `username` = '".$_SESSION['username']."' ");

					$orderCode = randomString(8);

					if($list_comment == "" && $reactions != ""){ 
						$insert_order = mysqli_query($conn, "INSERT INTO `order` SET
						`object_id` = '$object_id',
						`code` = '$orderCode',
						`buyer` = '".$_SESSION['username']."',
						`fatherKey` = '".$infoFather['key']."',
						`childSlug` = '".$info['slug']."',
						`amount` = '$amount',
						`reactions` = '$reactions',
						`server` = '$server',
						`note` = '$note',
						`status` = 'running',
						`total_cash` = '$total_cash',
						`created_time` = '".time()."',
						`day` = '".date('d')."',
						`month` = '".date('m')."',
						`year` = '".date('Y')."'
						");
					} else if($reactions == "" && $list_comment != ""){
						$insert_order = mysqli_query($conn, "INSERT INTO `order` SET 
						`object_id` = '$object_id',
						`code` = '$orderCode',
						`buyer` = '".$_SESSION['username']."',
						`fatherKey` = '".$infoFather['key']."',
						`childSlug` = '".$info['slug']."',
						`list_comment` = '$list_comment',
						`amount` = '$amount',
						`server` = '$server',
						`note` = '$note',
						`status` = 'running',
						`total_cash` = '$total_cash',
						`created_time` = '".time()."',
						`day` = '".date('d')."',
						`month` = '".date('m')."',
						`year` = '".date('Y')."'
						");
					}else{
						$insert_order = mysqli_query($conn, "INSERT INTO `order` SET 
						`object_id` = '$object_id',
						`code` = '$orderCode',
						`buyer` = '".$_SESSION['username']."',
						`fatherKey` = '".$infoFather['key']."',
						`childSlug` = '".$info['slug']."',
						`amount` = '$amount',
						`server` = '$server',
						`note` = '$note',
						`status` = 'running',
						`total_cash` = '$total_cash',
						`created_time` = '".time()."',
						`day` = '".date('d')."',
						`month` = '".date('m')."',
						`year` = '".date('Y')."'
						");
					}

					if($update_cash && $insert_order){
						
						if(setting('nofication_new_order') == 'yes'){
							sendTele(genContent($_SESSION['username']." vừa tạo đơn với số tiền ".number_format($total_cash)." VNĐ. Chi tiết vui lòng vào trang quản trị", false, $orderCode, $info['name']." (".$infoFather['name'].")", $infoServer['note']));
						}

						addLog('Đặt dịch vụ <i><b style="color: green;">'.$infoFather['name'].' - '.$info['name'].'</b></i>, Server: <i><b style="color: blue;">'.$infoServer['note'].'</b></i>, Tổng tiền: <i><b style="color: red;">'.number_format($total_cash).' VNĐ</b></i>', $_SESSION['username']);
						$res['success'] = "Tạo đơn thành công";
						die(json_encode($res));
					}else{
						$res['error'] = ERROR_MSG;
						die(json_encode($res));
					}

				}else{
					$res['error'] = "Server này không tồn tại hoặc đã được ẩn đi.";
					die(json_encode($res));
				}

			}else{
				$res['error'] = HACKER_MSG;
				die(json_encode($res));
			}

		}else{
			$res['error'] = "Đăng nhập để tiếp tục...";
			die(json_encode($res));
		}
	}

?>