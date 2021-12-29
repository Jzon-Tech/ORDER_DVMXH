<?php
if (isset($_POST['link'])) {
    $profile = $_POST['link'];
    $profile = rtrim($profile, "/");
    $parse = explode('/', $profile);
    if(is_array($parse) && count($parse) >= 2){
        $username = $parse[count($parse) - 1];
        $data = json_encode(['username' => $username]);
        $check = postData('https://api.findids.net/api/get-uid-from-username', $data);
        if($check['status'] == 200){
        	$res['success'] = true;
            $res['uid'] = $check['data']['id'];
            die(json_encode($res));
        }else{
            $res['error'] = "Link không hợp lệ";
            die(json_encode($res));
        }
    }else{
        $res['error'] = "Link không hợp lệ";
        die(json_encode($res));
    }

    exit;

}

function postData($site, $data = null) {
    $ch = curl_init();
    curl_setopt($ch, CURLOPT_URL, $site);
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Win) AppleWebKit/1000.0 (KHTML, like Gecko) Chrome/65.663 Safari/1000.01');
    curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
    curl_setopt($ch, CURLOPT_POST, TRUE);
    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
    return json_decode(curl_exec($ch),true);
}
?>