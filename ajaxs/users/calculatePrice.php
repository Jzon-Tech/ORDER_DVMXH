<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");
	
	if(isset($_POST['jzon']) && isset($_SESSION['username'])){
		$key = xss($_POST['key']);
		$amount = intval($_POST['amount']);
		$reaction = xss($_POST['reaction']);

		if(!$key || !$amount){
			$res['error'] = HACKER_MSG;
			die(json_encode($res));
		}

		$info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_server` WHERE `key` = '$key' "));
		$get_service = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `slug` = '".$info['slug']."' "));
		$reactions_arr = json_decode($get_service['reactions'], true);
		$index_int = array_search($reaction, $reactions_arr);

		if($info){
			if($get_service['reactions'] != "" && filter_var($get_service['comment_field'], FILTER_VALIDATE_BOOLEAN) !== true){
				if($index_int !== false){
					$rate_reactions = explode("|", $reactions_arr[$index_int])[1];
					$res['success'] = true;
					$res['total_cash'] = number_format(calculatePrice($info['price'], $amount, $rate_reactions, intval(setting('discount_'.infoMe('level')))));
					die(json_encode($res));
				}else{
					$res['error'] = HACKER_MSG;
					die(json_encode($res));
				}
			}else{
				$res['success'] = true;
				$res['total_cash'] = number_format(calculatePrice($info['price'], $amount, $rate_reactions, intval(setting('discount_'.infoMe('level')))));
				die(json_encode($res));
			}
		}else{
			$res['error'] = HACKER_MSG;
			die(json_encode($res));
		}

		

	}
?>