<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	$title = "Hỗ trợ của bạn";

	require_once($_SERVER['DOCUMENT_ROOT']."/layout/head.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/layout/navbar.php");

	if(!isset($_SESSION['username'])){
		header("Location: /auth/login");
		exit;
	}

	$support_wait = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `status` = 'wait' AND `username` = '".$_SESSION['username']."' "));
	$support_process = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `status` = 'process' AND `username` = '".$_SESSION['username']."' "));
	$support_done = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `status` = 'done' AND `username` = '".$_SESSION['username']."' "));
?>
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="row font-sans-serif">

						    <div class="col-md-4 col-12 form-group mb-3" style="color: #ff9f24;">
						        <div class="card h-100" style="background-color: #fff8eb!important;">
						            <div class="card-body py-2" style="font-size: 22px;">
						                <div class="row align-items-center" style="margin-bottom: -14px;">
						                    <div class="col-auto pr-0">
						                        <i class="far fa-clock" style="font-size: 40px;"></i>
						                    </div>
						                    <div class="col text-right pl-0" >
						                        <strong class="mb-0">Chờ hỗ trợ</strong>
						                        <h3 class="mb-0">
						                        	<span style="color: #ff9f24;"><?= number_format($support_wait); ?></span>
						                        </h3>
						                    </div>
						                </div>
						            </div>
						        </div>
						    </div>

						    <div class="col-md-4 col-12 form-group mb-3" style="color: #6f93ff;">
						        <div class="card h-100" style="background-color: #e1e9ff!important;">
						            <div class="card-body py-2" style="font-size: 22px;">
						                <div class="row align-items-center" style="margin-bottom: -14px;">
						                    <div class="col-auto pr-0">
						                        <i class="far fa-question-circle" style="font-size: 40px;"></i>
						                    </div>
						                    <div class="col text-right pl-0">
						                        <strong class="mb-0">Đang hỗ trợ</strong>
						                        <h3 class="mb-0">
						                        	<span style="color: #6f93ff;"><?= number_format($support_process); ?></span>
						                        </h3>
						                    </div>
						                </div>
						            </div>
						        </div>
						    </div>

						    <div class="col-md-4 col-12 form-group mb-3" style="color: #54bfad;">
						        <div class="card h-100" style="background-color: #c9f7f5!important;">
						            <div class="card-body py-2" style="font-size: 22px;">
						                <div class="row align-items-center" style="margin-bottom: -14px;">
						                    <div class="col-auto pr-0">
						                        <i class="far fa-check-circle" style="font-size: 40px;"></i>
						                    </div>
						                    <div class="col text-right pl-0">
						                        <strong class="mb-0">Đã hỗ trợ</strong>
						                        <h3 class="mb-0">
						                        	<span style="color: #54bfad;"><?= number_format($support_done); ?></span>
						                        </h3>
						                    </div>
						                </div>
						            </div>
						        </div>
						    </div>


						</div>

					</div>
				</div>
			</div>

			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">

						<div class="row align-items-center" margi>
						    <div class="col-6 form-group">
						    	<h3 class="mb-0" style="font-weight: bold;">Hỗ trợ của bạn</h3>
						    </div>	
						    <div class="col-6 form-group text-right">
						        <a href="/support/create" class="btn btn-primary">
						            <i class="fas fa-plus"></i> Tạo hỗ trợ mới
						        </a>
						    </div>
						</div>

						<style>
							.bg-gray {
							    background-color: #f5f7fa!important;
							}
							.mb-4, .my-4 {
							    margin-bottom: 1.5rem!important;
							}
							.mt-4, .my-4 {
							    margin-top: 1.5rem!important;
							}
							.p-2 {
							    padding: .5rem!important;
							}
							.col-auto {
							    -ms-flex: 0 0 auto;
							    flex: 0 0 auto;
							    width: auto;
							    max-width: 100%;
							}
							.avatar-home {
							    max-height: 79px;
							    max-width: 79px;
							    border-radius: 4px;
							}
							.pl-0, .px-0 {
							    padding-left: 0!important;
							}
							.cl-red {
							    color: #f64e60!important;
							}

							.cl-green {
							    color: #1fab89!important;
							}
							.font-13 {
							    font-size: 80%;
							}
							.cl-gray-2 {
							    color: #b5b5c3!important;
							}
							.hand {
							    cursor: pointer;
							}
							.float-right {
							    float: right!important;
							}
							.align-items-center {
							    -ms-flex-align: center!important;
							    align-items: center!important;
							}
							.d-flex {
							    display: -ms-flexbox!important;
							    display: flex!important;
							}
							.mr-2, .mx-2 {
							    margin-right: .5rem!important;
							}
							.bg-green-3 {
							    background-color: #c9f7f5!important;
							}
						</style>


						<?php 
							$support_list_query = mysqli_query($conn, "SELECT * FROM `support_list` WHERE `username` = '".$_SESSION['username']."' ORDER BY `id` DESC ");
							while($list = mysqli_fetch_assoc($support_list_query)) { 
						?>
						<a href="/support/<?= $list['code']; ?>" class="card bg-gray my-4">
						    <div class="card-body jzon_card" style="padding: 1.5rem!important;">
						        <div class="row">
						            <div class="col-auto">
						            	<img src="<?= avatarUser(); ?>" width="50" alt="user" class="active avatar-home" />
						            </div>
						            <div class="col pl-0">
						                <div class="row">
						                    <div class="col">
						                        <h6>
						                        	<span class="cl-red mr-1" style="font-weight: bold;">#<?= $list['code']; ?>:</span>
						                        	<span class="cl-green" style="font-weight: bold;"><?= $list['title']; ?></span>
						                        </h6>
						                    </div>
						                    <div class="col-auto">
						                        <span class="float-right d-flex align-items-center hand cl-gray-2" style="font-size: 14px;">
						                        	Chi tiết&nbsp;<i class="fas fa-arrow-right"></i>
						                        </span>
						                    </div>
						                </div>
						                <div class="d-md-block d-none">
						                    <div class="row">
						                        <div class="col-auto">
						                            <?= showStatusSupport($list['status']); ?>
						                            <span class="badge text-white mr-2 badge-info"><?= $list['problem']; ?></span>
						                        </div>
						                        <div class="col text-right">
						                            <span class="badge badge-primary"><i class="far fa-comment-dots"></i>&nbsp;<?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_message` WHERE `code` = '".$list['code']."' ")); ?></span>
						                            <span class="badge badge-dark"><i class="far fa-clock"></i>&nbsp;<?= timeAgo($list['created_time']); ?></span>
						                        </div>
						                    </div>
						                </div>
						            </div>
						        </div>
						        <h6 class="mb-0 align-items-center justify-content-between d-block d-md-none mt-2">
						            <div class="row align-items-center">
						                <div class="col">
						                	<span class="badge bg-green-3 font-bold text-dark"><?= $list['username']; ?></span>
						                </div>
						                <div class="col-auto">
						                    <span class="d-flex align-items-center cl-gray-2 font-13"><i class="far fa-clock"></i> <?= timeAgo($list['created_time']); ?></span>
						                </div>
						            </div>
						            <div class="row align-items-center mt-2">
						                <div class="col-auto">
				                            <?= showStatusSupport($list['status']); ?>
				                            <span class="badge text-white mr-2 badge-info"><?= $list['problem']; ?></span>
				                        </div>
						                <div class="col text-right">
						                    <span class="badge badge-primary">
						                    	<i class="far fa-comment-dots"></i>&nbsp;<?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_message` WHERE `code` = '".$list['code']."' ")); ?>
						                    </span>
						                </div>
						            </div>
						        </h6>
						    </div>
						</a>
						<?php } ?>

					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot.php");
?>