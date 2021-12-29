<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	if(isset($_POST['jzon']) && !isset($_SESSION['username'])){
		$username = xss($_POST['username']);
		$password = xss($_POST['password']);

		if(!filter_var($username, FILTER_VALIDATE_EMAIL)){
			$res['error'] = "Email không hợp lệ";
			die(json_encode($res));
		}

		if(!$password){
			$res['error'] = "Vui lòng nhập mật khẩu";
			die(json_encode($res));
		}

		$info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `users` WHERE `username` = '$username' LIMIT 1"));

		if($info){
			if(typePassword($password) == $info['password']){
				$_SESSION['username'] = $username;
				$setIP = mysqli_query($conn, "UPDATE `users` SET `ip` = '".myIP()."' WHERE `username` = '$username' ");
                if($setIP){
                    if(setting('nofication_login_member') == 'yes'){
                        sendTele(genContent("$username vừa đăng nhập thành công"));
                    }
                    $res['success'] = "Đăng nhập thành công, đang chuyển hướng...";
                    die(json_encode($res));
                }    
            }else{
				$res['error'] = "Mật khẩu đăng nhập không đúng";
				die(json_encode($res));
			}
		}else{
			$res['error'] = "Tài khoản này chưa được tạo";
			die(json_encode($res));
		}
	}

	$title = "Đăng nhập";

	require_once($_SERVER['DOCUMENT_ROOT']."/layout/head.php");

	if(isset($_SESSION['username'])){
		header('Location: /home');
		exit;
	}

?>
<body class="vh-100" onload="googleTranslateElementInit()">
    <div class="h-100 jzonAuthBackground">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
									<div class="text-center mb-3">
										<a href="/"><img src="<?= setting('logo'); ?>" alt=""></a>
									</div>
                                    <h4 class="text-center mb-4">Đăng nhập vào tài khoản</h4>
                                    <div class="mb-3" id="result" style="display: none;">
                                        
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Email</strong></label>
                                        <input type="tex" class="form-control" id="username" placeholder="Nhập địa chỉ email">
                                    </div>
                                    <div class="mb-3">
                                        <label class="mb-1"><strong>Password</strong></label>
                                        <input type="password" class="form-control" id="password" placeholder="Nhập mật khẩu">
                                    </div>
                                    <div class="text-center">
                                        <button type="submit" class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG ĐĂNG NHẬP' onclick="moduleLogin(this)"><i class="fas fa-sign-in-alt"></i> ĐĂNG NHẬP NGAY</button>
                                    </div>
                                    <div class="new-account mt-3">
                                        <p>Chưa có tài khoản? <a class="text-primary" href="/auth/create">Tạo tài khoản ngay</a></p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
    
    <?php 
        $req = file_get_contents("http://www.geoplugin.net/json.gp");
        $json = json_decode($req, true);
        $country_code = $json['geoplugin_countryCode'];
        
    ?>
    <?php if($country_code != "VN") { ?>

    function googleTranslateElementInit() {
        var ckDomain;
        for (var ckDomain = window.location.hostname.split("."); 2 < ckDomain.length;){
            ckDomain.shift();
        }
        ckDomain = ";domain=" + ckDomain.join(".");
        // domain cookie
        document.cookie = "googtrans=/vi/<?= country_code_to_locale($country_code); ?>; expires=Thu, 07-Mar-2047 20:22:40 GMT; path=/" + ckDomain;
        // host-only cookie (with no domain name definition)
        document.cookie = "googtrans=/vi/<?= country_code_to_locale($country_code); ?>; expires=Thu, 07-Mar-2047 20:22:40 GMT; path=/";
        new google.translate.TranslateElement({
            pageLanguage: 'vi',
            autoDisplay: false,
            layout: google.translate.TranslateElement
        }, 'google_translate_element');
    }
    
    $(function(){
        setTimeout(() => {
            $(".skiptranslate").remove()
        }, 2500);
    })
    <?php } ?>
</script>

    <!--**********************************
        Scripts
    ***********************************-->
    <!-- Required vendors -->
	<script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/js/app.js?<?= time(); ?>"></script>
	<script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/js/module.js?<?= time(); ?>"></script>
	<script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/js/dashboard/dashboard-1.js"></script>
    <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/js/custom.min.js"></script>
    <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/js/deznav-init.js"></script>
    <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/js/demo.js"></script>
    <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/js/styleSwitcher.js"></script>
</body>