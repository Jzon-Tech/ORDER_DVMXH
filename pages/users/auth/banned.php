<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	$title = "Tài khoản đã bị khóa";

	require_once($_SERVER['DOCUMENT_ROOT']."/layout/head.php");

	if(!isset($_SESSION['username'])){
		header('Location: /auth/login');
		exit;
	}

	if(infoMe('banned') != 1){ 
		header('Location: /home');
		exit;
	}

?>
<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-6">
                    <div class="authincation-content">
                        <div class="row no-gutters">
                            <div class="col-xl-12">
                                <div class="auth-form">
                                    <h4 class="text-center mb-4">Tài khoản đã bị khóa</h4>
                                    <div class="mb-3">
                                        <p>Có vẻ như tài khoản của bạn đã bị khóa bởi Quản trị viên, vui lòng liên hệ Quản trị viên để biết thêm chi tiết.</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>


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