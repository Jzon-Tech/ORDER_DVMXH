<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	$title = "403 Truy cập bị cấm";

	require_once($_SERVER['DOCUMENT_ROOT']."/layout/head.php");

?>
<body class="vh-100">
    <div class="authincation h-100">
        <div class="container h-100">
            <div class="row justify-content-center h-100 align-items-center">
                <div class="col-md-5">
                    <div class="form-input-content text-center error-page">
                        <h1 class="error-text  fw-bold">403</h1>
                        <h4><i class="fa fa-times-circle text-danger"></i> Truy cập bị cấm</h4>
                        <p>Bạn không có quyền xem tài nguyên này.</p>
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