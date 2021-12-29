<?php 
    
    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA
    
    define("HACKER_MSG", "Bad action have been blocked");
    define("SPAM_MSG", "Thao tác chậm thôi, NO SPAM !");
    define("ERROR_MSG", "Lỗi server");
    $ip_host = getHostByName(getHostName());

    
    function setting($data){
        global $conn;
        return mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `setting` WHERE `name` = '$data' LIMIT 1"))['value'];
    }




    if(!antiBot()){
        if(!isset($no_bot)) {
            if(setting('nofication_detect_bot') == 'yes'){
                sendTele(genContent('Phát hiện BOT đang cố truy cập vào hệ thống (PATH: '.$_SERVER['REQUEST_URI'].')'));
            }
            http_response_code(301);
            die('Thao tác của bạn đã bị chặn do nghi ngờ là BOT !');
        }
    }
    

    function get_http_response_code($domain1) {
        $headers = get_headers($domain1);
        return substr($headers[0], 9, 3);
    }

    function getUser($username, $value){
        global $conn;
        return mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username' "))[$value];
    }


    function infoMe($value){
        if(isset($_SESSION['username'])){
            return getUser($_SESSION['username'], $value);
        }
    }

    function showName(){
        if(!isset($_SESSION['username'])){
            return "Khách";
        }else{
            return $_SESSION['username'];
        }
    }

    function rankImg($top){
        switch($top){
            case 1:
                return "https://".$_SERVER['SERVER_NAME']."/frontend/main/images/rank/top1.png";
                break;
            case 2:
                return "https://".$_SERVER['SERVER_NAME']."/frontend/main/images/rank/top2.png";
                break;
            case 3:
                return "https://".$_SERVER['SERVER_NAME']."/frontend/main/images/rank/top3.png";
                break;
            case 4:
                return "https://".$_SERVER['SERVER_NAME']."/frontend/main/images/rank/top4.png";
                break;
            case 5:
                return "https://".$_SERVER['SERVER_NAME']."/frontend/main/images/rank/top5.png";
                break;
        }
    }

    function jzonMobile(){
        $useragent = $_SERVER['HTTP_USER_AGENT'];

        if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4))){
            return true;
        }else{
            return false;
        }

    }

    function addTop($username, $cash){
        global $conn;
        // RESET TOP KHI HẾT THÁNG
        mysqli_query($conn, "DELETE FROM `top-recharge` WHERE `month` != '".date('m')."' OR `year` != '".date('Y')."' ");

        $check = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `top-recharge` WHERE `username` = '$username' "));

        if($check){
            // NẾU ĐÃ TỒN TẠI TRONG SQL
            mysqli_query($conn, "UPDATE `top-recharge` SET `cash` = `cash` + '$cash' WHERE `username` = '$username' ");
        }else{
            // NẾU CHƯA TỒN TẠI TRONG SQL
            mysqli_query($conn, "INSERT INTO `top-recharge` (`username`, `cash`, `month`, `year`) VALUES ('$username', '$cash', '".date('m')."', '".date('Y')."') ");
        }
    }

    function avatarUser($name = NULL){
        if($name == NULL){
            return "https://ui-avatars.com/api/?background=random&name=".showName();
        }else{
            return "https://ui-avatars.com/api/?background=random&name=".$name;
        }
    }

    function randomString($length = 10) {
        $characters = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $charactersLength = strlen($characters);
        $randomString = '';
        for ($i = 0; $i < $length; $i++) {
            $randomString .= $characters[rand(0, $charactersLength - 1)];
        }
        return $randomString;
    }

    function card1s($telco, $amount, $pin, $serial, $request_id) {

        $partner_id = explode('|', setting('api_card1s'))[0];
        $partner_key = explode('|', setting('api_card1s'))[1];

        $domain = "https://card1s.vn";
        $curl = curl_init();
        curl_setopt_array($curl, [
            CURLOPT_URL => $domain.'/api/send-card?request_id='.$request_id.'&telco='.$telco.'&pin='.$pin.'&serial='.$serial.'&amount='.$amount,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_HTTPHEADER => [
                'partner_id: '.$partner_id,
                'partner_key: '.$partner_key
            ],
        ]);

        $response = curl_exec($curl);

        curl_close($curl);
        return json_decode($response, true);
    }

    function timeAgo($time_ago) {
        $time_ago = date('Y-m-d H:i:s', $time_ago);
        $time_ago = strtotime($time_ago);
        $cur_time   = time();
        $time_elapsed   = $cur_time - $time_ago;
        $seconds    = $time_elapsed ;
        $minutes    = round($time_elapsed / 60 );
        $hours      = round($time_elapsed / 3600);
        $days       = round($time_elapsed / 86400 );
        $weeks      = round($time_elapsed / 604800);
        $months     = round($time_elapsed / 2600640 );
        $years      = round($time_elapsed / 31207680 );
        // Seconds
        if($seconds <= 60){
            return "Vừa xong";
        }
        //Minutes
        else if($minutes <=60){
            if($minutes==1){
                return "1 phút trước";
            }
            else{
                return "$minutes phút trước";
            }
        }
        //Hours
        else if($hours <=24){
            if($hours==1){
                return "1 tiếng trước";
            }else{
                return "$hours tiếng trước";
            }
        }
        //Days
        else if($days <= 7){
            if($days==1){
                return "Hôm qua";
            }else{
                return "$days ngày trước";
            }
        }
        //Weeks
        else if($weeks <= 4.3){
            if($weeks==1){
                return "1 tuần trước";
            }else{
                return "$weeks tuần trước";
            }
        }
        //Months
        else if($months <=12){
            if($months==1){
                return "1 tháng trước";
            }else{
                return "$months tháng trước";
            }
        }
        //Years
        else{
            if($years==1){
                return "1 năm trước";
            }else{
                return "$years năm trước";
            }
        }
    }

    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA

    function showStatusServer($data){
        switch($data){
            case 'show':
                return "<span class='badge badge-rounded badge-success'>Hiện</span>";
                break;
            case 'hide':
                return "<span class='badge badge-rounded badge-danger'>Ẩn</span>";
                break;
            default:
                return "<span class='badge badge-rounded badge-dark'>undefinded</span>";
                break;
        }
    }
    

    function jzonCurl($url){
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);

        $data = curl_exec($ch);
        
        curl_close($ch);
        return $data;
    }


    function showStatusCard($data){
        switch($data){
            case 'wait':
                return "<span class='badge badge-warning'>Chờ duyệt</span>";
                break;
            case 'success':
                return "<span class='badge badge-success'>Thành công</span>";
                break;
            case 'error':
                return "<span class='badge badge-danger'>Thẻ sai</span>";
                break;
            default:
                return "<span class='badge badge-dark'>undefinded</span>";
                break;
        }
    }

    function countLineText($text){
        $num = 0;
        $line = explode("\n", $text);
        $jzon = count($line);


        for ($i=0; $i < $jzon; $i++) { 
            if($line[$i] != "" && $line[$i] != " "){
                $num++;
            }
        }

        return $num;
    }

    function antiBot(){
        if(!empty($_SERVER['HTTP_USER_AGENT']) and preg_match('~(bot|crawl)~i', $_SERVER['HTTP_USER_AGENT'])){
            // Là bot
            return false;
        }else{
            if (preg_match("/^(Mozilla|Opera|PSP|Bunjalloo|wii)/i", $_SERVER['HTTP_USER_AGENT']) && !preg_match("/bot|crawl|crawler|slurp|spider|link|checker|script|robot|discovery|preview/i", $_SERVER['HTTP_USER_AGENT'])) {
                return true;
            } else {
                return false;
            }
        }
    }

    function memoMode($type){
        $mode = setting('memo_mode');

        switch($type){
            case 'page':
                if(isset($_SESSION['username'])) { 
                    if($mode == 'uid'){
                        return setting('memo_name').infoMe('id');      
                    }

                    if($mode == 'user'){
                        return setting('memo_name').infoMe('username');      
                    }
                }
                break;
        }
    }

    function calculatePrice($price, $amount, $rate_reactions = 0, $discount){
        $total_cash = $amount * ($price + $rate_reactions);
        return $total_cash - $total_cash * $discount / 100;
    }

    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA
    
    function jzonFindArr($arr, $findme){
        $arr = json_encode($arr);
        if(strpos($arr, $findme) === false){
            return false;
        }else{
            return true;
        }
    }

    function jzonExtractPriceReaction($arr, $reaction){
        $arr = strval($arr);
        $arr = json_decode($arr);
        foreach($arr as $reaction_data){
            if(strpos($reaction_data, $reaction) !== false){
                return explode('|', $reaction_data)[1];
            }
        }
    }

    function jzonParseContent($str){
        preg_match('/'.setting('memo_name').'(.*[^\s])/', $str, $matches);
        return $matches[1];
    }

    function xss($data) {
        // Fix &entity\n;
        $data = str_replace(array('&amp;','&lt;','&gt;'), array('&amp;amp;','&amp;lt;','&amp;gt;'), $data);
        $data = preg_replace('/(&#*\w+)[\x00-\x20]+;/u', '$1;', $data);
        $data = preg_replace('/(&#x*[0-9A-F]+);*/iu', '$1;', $data);
        $data = html_entity_decode($data, ENT_COMPAT, 'UTF-8');
        
        // Remove any attribute starting with "on" or xmlns
        $data = preg_replace('#(<[^>]+?[\x00-\x20"\'])(?:on|xmlns)[^>]*+>#iu', '$1>', $data);
        
        // Remove javascript: and vbscript: protocols
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=[\x00-\x20]*([`\'"]*)[\x00-\x20]*j[\x00-\x20]*a[\x00-\x20]*v[\x00-\x20]*a[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2nojavascript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*v[\x00-\x20]*b[\x00-\x20]*s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:#iu', '$1=$2novbscript...', $data);
        $data = preg_replace('#([a-z]*)[\x00-\x20]*=([\'"]*)[\x00-\x20]*-moz-binding[\x00-\x20]*:#u', '$1=$2nomozbinding...', $data);
        
        // Only works in IE: <span style="width: expression(alert('Ping!'));"></span>
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?expression[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?behaviour[\x00-\x20]*\([^>]*+>#i', '$1>', $data);
        $data = preg_replace('#(<[^>]+?)style[\x00-\x20]*=[\x00-\x20]*[`\'"]*.*?s[\x00-\x20]*c[\x00-\x20]*r[\x00-\x20]*i[\x00-\x20]*p[\x00-\x20]*t[\x00-\x20]*:*[^>]*+>#iu', '$1>', $data);
        
        // Remove namespaced elements (we do not need them)
        $data = preg_replace('#</*\w+:\w[^>]*+>#i', '', $data);
        
        do {
            // Remove really unwanted tags
            $old_data = $data;
            $data = preg_replace('#</*(?:applet|b(?:ase|gsound|link)|embed|frame(?:set)?|i(?:frame|layer)|l(?:ayer|ink)|meta|object|s(?:cript|tyle)|title|xml)[^>]*+>#i', '', $data);
        }
        while ($old_data !== $data);
        
        // we are done...
        $ducthanhit = htmlspecialchars(addslashes(trim($data)));

        return $ducthanhit;
    }

    function escapeUnicode($str) {
        $str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
        $str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
        $str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
        $str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
        $str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
        $str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
        $str = preg_replace("/(đ)/", 'd', $str);

        $str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
        $str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
        $str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
        $str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
        $str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
        $str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
        $str = preg_replace("/(Đ)/", 'D', $str);
        return $str;
    }

    function genSlug($str, $service){
        $str = strtolower($str);
        $str = str_replace(' ', '-', $str);
        $str = escapeUnicode($str);

        $service = strtolower($service);
        $service = str_replace(' ', '-', $service);
        $service = escapeUnicode($service);
        
        return $service."-".$str;
    }

    function showTypeAccount($data){
        switch ($data) {
            case 'admin':
                return "Quản trị viên";
                break;
            case 'ctv':
                return "Cộng tác viên";
                return;
            case 'agency':
                return "Đại Lý";
                break;
            default:
                return "Khách Hàng";
                break;
        }
    }

    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA

    function extractDate($time, $type){
        switch($type){
            case 'day':
                return date('d', $time);
                break;
            case 'month':
                return date('m', $time);
                break;
            case 'year':
                return date('Y', $time);
                break;
        }
    }

    function typePassword($data){
        //SHA1 ENCODING STRING PASSWORD
        return sha1($data);
    }

    function validUsername($data) {
        if (preg_match('/^[a-zA-Z0-9_-]{3,16}$/', $data, $matches)) {
            return True;
        } else {
            return False;
        }
    }

    function myIP() {
        if (!empty($_SERVER['HTTP_CLIENT_IP'])) {  
            $ip_address = $_SERVER['HTTP_CLIENT_IP'];  
        } else if (!empty($_SERVER['HTTP_X_FORWARDED_FOR'])) {  
            $ip_address = $_SERVER['HTTP_X_FORWARDED_FOR'];  
        } else {  
            $ip_address = $_SERVER['REMOTE_ADDR'];  
        }
        return $ip_address;
    }

    function formatDate($time){
        return date('d/m/Y H:i:s', $time);
    }

    function addLog($content, $user, $time = NULL){
        global $conn;
        if(is_null($time)){
            $time = time();
        }
        mysqli_query($conn, "INSERT INTO `log_system` (`username`, `content`, `created_time`) VALUES ('$user', '$content', '$time') ");
    }

    function showStatusOrder($data){
        switch($data){
            case 'done':
                return "<span class='badge badge-rounded badge-success'>Hoàn tất</span>";
                break;
            case 'running':
                return "<span class='badge badge-rounded badge-warning'>Đang chạy</span>";
                break;
            case 'fail':
                return "<span class='badge badge-rounded badge-danger'>Hủy</span>";
                break;
            default:
                return "<span class='badge badge-rounded badge-dark'>undefinded</span>";
                break;
        }
    }

    function showStatusSupport($data){
        switch($data){
            case 'done':
                return '<span class="badge mr-2 text-white badge-success"> Đã hỗ trợ </span>';
                break;
            case 'wait':
                return '<span class="badge mr-2 text-white badge-warning"> Chờ hỗ trợ </span>';
                break;
            case 'process':
                return '<span class="badge mr-2 text-white badge-primary"> Đang hỗ trợ </span>';
                break;
        }
    }

    function validIMG($data){
        $filename = $_FILES[$data]['name'];
        $ext = explode(".", $filename);
        $ext = end($ext);
        $valid_ext = array("png","jpeg","jpg","PNG","JPEG","JPG","gif","GIF");
        if(in_array($ext, $valid_ext)) {
            return true;
        }
    }


    function genContent($message, $time = false, $orderCode = false, $serviceName = false, $serverName = false){

        if(!$time){
            $time = date('d/m/Y H:i:s');
        }

        if(!$orderCode){
            $contentTele = "🔔 THÔNG BÁO HỆ THỐNG 

📝 Nội dung: $message 
⏱️ Thời gian: $time
🌐 Địa chỉ IP: ".myIP();

        }else{
            $contentTele = "🔔 THÔNG BÁO HỆ THỐNG 

📝 Nội dung: $message
🛒 Mã đơn: $orderCode
⏱️ Thời gian: $time
🌐 Địa chỉ IP: ".myIP();
        }

        if($orderCode && $serviceName && $serverName){
            $contentTele = "🔔 THÔNG BÁO HỆ THỐNG 

📝 Nội dung: $message
🛎️ Dịch vụ: $serviceName
⚡ Máy chủ: $serverName
🛒 Mã đơn: $orderCode
⏱️ Thời gian: $time
🌐 Địa chỉ IP: ".myIP();
        }

        return $contentTele;

    }


    function sendTele($message){

        // $message = urlencode($message);

        $tele_token = setting('tele_token');
        $tele_chatid = setting('tele_chatid');
        
        $data = http_build_query([
            'chat_id' => $tele_chatid,
            'text' => $message,
        ]);
        
        JzonCurl2('https://api.telegram.org/bot'.$tele_token.'/sendMessage', $data);
    }
    
    function JzonCurl2($url, $data = null) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $url);
        curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true);
        curl_setopt($ch, CURLOPT_REFERER, $url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_USERAGENT, 'Mozilla/5.0 (Win) AppleWebKit/1000.0 (KHTML, like Gecko) Chrome/65.663 Safari/1000.01');
        curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
        curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, false);
        if($data){
            curl_setopt($ch, CURLOPT_POST, true);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        }
        $result = curl_exec($ch);
        curl_close($ch);
        return $result;
    }

    function country_code_to_locale($country_code, $language_code = '')
    {
        $locales = [
            'ZA' => 'af',
            'ET' => 'am',
            'AE' => 'ar',
            'BH' => 'ar',
            'DZ' => 'ar',
            'EG' => 'ar',
            'IQ' => 'ar',
            'JO' => 'ar',
            'KW' => 'ar',
            'LB' => 'ar',
            'LY' => 'ar',
            'MA' => 'ar',
            'CL' => 'arn',
            'OM' => 'ar',
            'QA' => 'ar',
            'SA' => 'ar',
            'SY' => 'ar',
            'TN' => 'ar',
            'YE' => 'ar',
            'IN' => 'as',
            'RU' => 'ba',
            'BY' => 'be',
            'BG' => 'bg',
            'BD' => 'bn',
            'IN' => 'bn',
            'CN' => 'bo',
            'FR' => 'br',
            'ES' => 'ca',
            'FR' => 'co',
            'CZ' => 'cs',
            'GB' => 'cy',
            'DK' => 'da',
            'AT' => 'de',
            'CH' => 'de',
            'DE' => 'de',
            'LI' => 'de',
            'LU' => 'de',
            'DE' => 'dsb',
            'MV' => 'dv',
            'GR' => 'el',
            '029' => 'en',
            'AU' => 'en',
            'BZ' => 'en',
            'CA' => 'en',
            'GB' => 'en',
            'IE' => 'en',
            'IN' => 'en',
            'JM' => 'en',
            'MY' => 'en',
            'NZ' => 'en',
            'PH' => 'en',
            'SG' => 'en',
            'TT' => 'en',
            'US' => 'en',
            'ZA' => 'en',
            'ZW' => 'en',
            'AR' => 'es',
            'BO' => 'es',
            'CL' => 'es',
            'CO' => 'es',
            'CR' => 'es',
            'DO' => 'es',
            'EC' => 'es',
            'ES' => 'es',
            'GT' => 'es',
            'HN' => 'es',
            'MX' => 'es',
            'NI' => 'es',
            'PA' => 'es',
            'PE' => 'es',
            'PR' => 'es',
            'PY' => 'es',
            'SV' => 'es',
            'US' => 'es',
            'UY' => 'es',
            'VE' => 'es',
            'EE' => 'et',
            'ES' => 'eu',
            'IR' => 'fa',
            'FI' => 'fi',
            'PH' => 'fil',
            'FO' => 'fo',
            'BE' => 'fr',
            'CA' => 'fr',
            'CH' => 'fr',
            'FR' => 'fr',
            'LU' => 'fr',
            'MC' => 'fr',
            'NL' => 'fy',
            'IE' => 'ga',
            'GB' => 'gd',
            'ES' => 'gl',
            'FR' => 'gsw',
            'IN' => 'gu',
            'IL' => 'he',
            'IN' => 'hi',
            'BA' => 'hr',
            'HR' => 'hr',
            'DE' => 'hsb',
            'HU' => 'hu',
            'AM' => 'hy',
            'ID' => 'id',
            'NG' => 'ig',
            'CN' => 'ii',
            'IS' => 'is',
            'CH' => 'it',
            'IT' => 'it',
            'JP' => 'ja',
            'GE' => 'ka',
            'KZ' => 'kk',
            'GL' => 'kl',
            'KH' => 'km',
            'IN' => 'kn',
            'IN' => 'kok',
            'KR' => 'ko',
            'KG' => 'ky',
            'LU' => 'lb',
            'LA' => 'lo',
            'LT' => 'lt',
            'LV' => 'lv',
            'NZ' => 'mi',
            'MK' => 'mk',
            'IN' => 'ml',
            'MN' => 'mn',
            'CA' => 'moh',
            'IN' => 'mr',
            'BN' => 'ms',
            'MY' => 'ms',
            'MT' => 'mt',
            'NO' => 'nb',
            'NP' => 'ne',
            'BE' => 'nl',
            'NL' => 'nl',
            'NO' => 'nn',
            'ZA' => 'nso',
            'FR' => 'oc',
            'IN' => 'or',
            'IN' => 'pa',
            'PL' => 'pl',
            'AF' => 'prs',
            'AF' => 'ps',
            'BR' => 'pt',
            'PT' => 'pt',
            'GT' => 'qut',
            'BO' => 'quz',
            'EC' => 'quz',
            'PE' => 'quz',
            'CH' => 'rm',
            'RO' => 'ro',
            'RU' => 'ru',
            'RW' => 'rw',
            'RU' => 'sah',
            'IN' => 'sa',
            'FI' => 'se',
            'NO' => 'se',
            'SE' => 'se',
            'LK' => 'si',
            'SK' => 'sk',
            'SI' => 'sl',
            'NO' => 'sma',
            'SE' => 'sma',
            'NO' => 'smj',
            'SE' => 'smj',
            'FI' => 'smn',
            'FI' => 'sms',
            'AL' => 'sq',
            'FI' => 'sv',
            'SE' => 'sv',
            'KE' => 'sw',
            'SY' => 'syr',
            'IN' => 'ta',
            'IN' => 'te',
            'TH' => 'th',
            'TM' => 'tk',
            'ZA' => 'tn',
            'TR' => 'tr',
            'RU' => 'tt',
            'CN' => 'ug',
            'UA' => 'uk',
            'PK' => 'ur',
            'VN' => 'vi',
            'SN' => 'wo',
            'ZA' => 'xh',
            'NG' => 'yo',
            'CN' => 'zh',
            'HK' => 'zh',
            'MO' => 'zh',
            'SG' => 'zh',
            'TW' => 'zh',
            'ZA' => 'zu',
        ];

        return $locales[$country_code];
    }


    if(setting('maintenance_mode') == 'on') {
        if(!isset($err_docs)){
            if(!isset($admin_page)) { 
                header('Location: /maintenance');
                exit;
            }
        }
    }
    
    // XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA