<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	$title = "404 Không tìm thấy trang bạn đang tìm!";

	require_once($_SERVER['DOCUMENT_ROOT']."/layout/head.php");

?>
<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-7">
                    <div class="form-input-content text-center error-page">
                        <h1 class="error-text fw-bold">404</h1>
                        <h4><i class="fa fa-exclamation-triangle text-warning"></i> Không tìm thấy trang bạn đang tìm!</h4>
                        <p>Bạn có thể đã nhập sai địa chỉ hoặc trang có thể đã bị di chuyển.</p>
						<div>
                            <a class="btn btn-primary" href="/home">Quay về trang chủ</a>
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