<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	$title = "Trang chủ";

	require_once($_SERVER['DOCUMENT_ROOT']."/layout/head.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/layout/navbar.php");

	if(!isset($_SESSION['username'])){
		header("Location: /auth/login");
		exit;
	}
?>
<div class="modal fade bd-example-modal-lg" tabindex="-1" role="dialog" aria-hidden="true" id="jzonNofication">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title"><i class="fas fa-bell"></i> THÔNG BÁO HỆ THỐNG</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal">
                </button>
            </div>
            <div class="modal-body">
            	<?= setting('nofication'); ?>
            </div>
            <div class="modal-footer">
                <a type="button" class="btn btn-danger light" onclick="closeJzonNofication()">Đã đọc</a>
            </div>
        </div>
    </div>
</div>
<script>
	let numPost = 10
	let totalPost = <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `newsfeed` ")); ?>
</script>
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="row" style="flex-direction: row-reverse!important; position: relative;">
			<div class="col-lg-4 col-md-5 col-12 jzonInfoSticky">
				<div class="card">
					<div class="card-header">
				    	<h3 class="card-title" style="font-weight: bold;">Báo cáo</h3>
					</div>
					<div class="card-body jzon_sticky">
					    <div class="row align-items-center">
					        <div class="col-6">
					            <div class="row align-items-center">
					                <div class="col-auto">
					                    <div class="card_jzon bg-violet-2">
					                        <div class="card-body p-3 text-center"><i class="font-24 icon-report fas fa-wallet cl-violet"></i></div>
					                    </div>
					                </div>
					                <div class="col pl-0">
					                    <div class="bold font-18"><?= number_format(infoMe('cash')); ?> VNĐ</div>
					                    <div class="text-muted font-14">Số tiền hiện có</div>
					                </div>
					            </div>
					        </div>
					        <div class="col-6">
					            <div class="row align-items-center">
					                <div class="col-auto">
					                    <div class="card_jzon bg-red-2">
					                        <div class="card-body p-3 text-center"><i class="fas fa-coins font-24 icon-report cl-red"></i></div>
					                    </div>
					                </div>
					                <div class="col pl-0">
					                    <div class="bold font-18"><?= number_format(infoMe('total_cash')); ?> VNĐ</div>
					                    <div class="text-muted font-14">Số tiền đã nạp</div>
					                </div>
					            </div>
					        </div>
					    </div>
					    <div class="row align-items-center mt-3">
					        <div class="col-6">
					            <div class="row align-items-center">
					                <div class="col-auto">
					                    <div class="card_jzon bg-green-3">
					                        <div class="card-body p-3 text-center"><i class="fas fa-university font-24 icon-report cl-green"></i></div>
					                    </div>
					                </div>
					                <div class="col pl-0">
					                    <div class="bold font-18"><?= number_format(infoMe('used_cash')); ?> VNĐ</div>
					                    <div class="text-muted font-14">Số tiền đã tiêu</div>
					                </div>
					            </div>
					        </div>
					        <div class="col-6">
					            <div class="row align-items-center">
					                <div class="col-auto">
					                    <div class="card_jzon bg-violet-3">
					                        <div class="card-body p-3 text-center"><i class="fas fa-percentage font-24 icon-report cl-violet"></i></div>
					                    </div>
					                </div>
					                <div class="col pl-0">
					                    <div class="bold font-18"><?= showTypeAccount(infoMe('level')); ?></div>
					                    <div class="text-muted font-14">Giảm <?= number_format(setting('discount_'.infoMe('level'))); ?>%</div>
					                </div>
					            </div>
					        </div>
					    </div>

						<?php if(jzonMobile()) { ?>
							<hr>
							<h3 class="text-center" style="font-weight: bold;">TOP NẠP TIỀN THÁNG <?= date('m'); ?></h3>
								<div class="topRechargeMonth">

								<?php if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `top-recharge` WHERE `cash` > 0 AND `month` = '".date('m')."' AND `year` = '".date('Y')."' ")) <= 0) { ?>
									<div class="text-center">
										<span class="text-danger" style="font-weight: bold;">
											Chưa có ai đứng top
										</span>
									</div>
								<?php } else { ?>
									<?php
										$topMax = 5; // TỐI ĐA 5 THỨ HẠNG
										$top = 1;
										$rank_data = mysqli_query($conn, "SELECT * FROM `top-recharge` WHERE `cash` > 0 AND `month` = '".date('m')."' AND `year` = '".date('Y')."' ORDER BY `cash` DESC LIMIT 0, $topMax");
										while($rank = mysqli_fetch_assoc($rank_data)) {
									
									?>
										<?php if($top == 1) { ?>
											<div class="row">
												<div class="col-3 text-center">
													<img src="<?= rankImg($top); ?>" width="100%">
												</div>
												<div class="col-9">
													<span style="color: orange; font-weight: bold;"><i class="fas fa-crown"></i> <?= $rank['username']; ?></span> <br>
													<span>Tổng nạp: <b class="text-danger" style="font-style: italic"><?= number_format($rank['cash']); ?> VNĐ</b></span>
												</div>
											</div>
										<?php }else if($top == 2){ ?>
											<div class="row">
												<div class="col-3 text-center">
													<img src="<?= rankImg($top); ?>" width="100%">
												</div>
												<div class="col-9">
													<span style="font-weight: bold;"><i class="fas fa-chess-queen"></i> <?= $rank['username']; ?></span> <br>
													<span>Tổng nạp: <b class="text-danger" style="font-style: italic"><?= number_format($rank['cash']); ?> VNĐ</b></span>
												</div>
											</div>
										<?php }else if($top == 3){ ?>
											<div class="row">
												<div class="col-3 text-center">
													<img src="<?= rankImg($top); ?>" width="100%">
												</div>
												<div class="col-9">
													<span style="color: #CD7F32; font-weight: bold;"><i class="fas fa-award"></i> <?= $rank['username']; ?></span> <br>
													<span>Tổng nạp: <b class="text-danger" style="font-style: italic"><?= number_format($rank['cash']); ?> VNĐ</b></span>
												</div>
											</div>
										<?php } else { ?>
											<div class="row">
												<div class="col-3 text-center">
													<img src="<?= rankImg($top); ?>" width="100%">
												</div>
												<div class="col-9">
													<span><?= $rank['username']; ?></span> <br>
													<span>Tổng nạp: <b class="text-danger" style="font-style: italic"><?= number_format($rank['cash']); ?> VNĐ</b></span>
												</div>
											</div>
										<?php } ?>
										<?php $top++; ?>
									<?php } ?>
								<?php } ?>
							</div>
						<?php } ?>
					</div>

				</div>
			</div>
			<div class="col-lg-5 col-md-7 col-12 jzonNewsfeedSticky jzonFixPcNews">
				<div style="" id="jzonNewsfeed">
					<?php 
						if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `newsfeed` ")) <= 0){
					?>
					<div class="card">
						<div class="card-body p-4 text-center">
							<b style="color: red;">Không có bài viết để hiển thị</b>
						</div>
					</div>
					<?php
						}else{
					?>
					<?php 
						$newsfeed_query = mysqli_query($conn, "SELECT * FROM `newsfeed` ORDER BY `id` DESC LIMIT 10");
						while($news = mysqli_fetch_assoc($newsfeed_query)){
					?>
					<div class="card">
						<div class="card-body p-4">
						    <div class="row align-items-center">
						        <div class="col-auto"><img src="https://i.ibb.co/M1rVWtS/Untitled-design-5.png" width="44" alt="user" class="active avatar-home" /></div>
						        <div class="col pl-0">
						            <h6 class="mb-0 bold"><?= $news['poster']; ?></h6>
						            <h6 class="mb-0 cl-gray-2"><?= timeAgo($news['created_time']); ?></h6>
						        </div>
						    </div>
						    <div class="content mt-3">
						        <?= $news['content']; ?>
						    </div>
						    <div>
						        <div class="row mt-3">
						            <div class="col-auto text-center">
						            	<?php 
						            		$check_like = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `like_post` WHERE `username` = '".$_SESSION['username']."' AND `post_key` = '".$news['key']."' "));

						            		if($check_like){
						            			$attr = "cl-red";
						            			$onclick = "onclick='unlikePost(this)'";
						            		}else{
						            			$attr = "cl-gray-2";
						            			$onclick = "onclick='likePost(this)'";
						            		}
						            	?>
						                <h5 id="jzonPost_<?= $news['key']; ?>" class="hand cl-gray-2" data-key="<?= $news['key']; ?>" <?= $onclick; ?>>
						                	<i id="icon_<?= $news['key']; ?>" class="fas <?= $attr; ?> fa-heart mr-1"></i>
						                	<span id="like_<?= $news['key']; ?>">
						                		<?= number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `like_post` WHERE `post_key` = '".$news['key']."' "))); ?>
						                	</span>
						                </h5>
						            </div>
						        </div>
						    </div>
						</div>
					</div>
					<?php } } ?>
				</div>
				<div class="alert alert-danger" id="jzonPostLoader" style="text-align: center; display: none;">
					Đang tải thêm bài viết...
				</div>
			</div>

			<div class="col-lg-3 col-12 d-lg-block d-none jzonReportSticky">
				<div class="card ">
					<div class="card-body jzon_sticky">
						<h3 class="text-center" style="font-weight: bold;">TOP NẠP TIỀN THÁNG <?= date('m'); ?></h3>
						<div class="topRechargeMonth">

							<?php if(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `top-recharge` WHERE `cash` > 0 AND `month` = '".date('m')."' AND `year` = '".date('Y')."' ")) <= 0) { ?>
								<div class="text-center">
									<span class="text-danger" style="font-weight: bold;">
										Chưa có ai đứng top
									</span>
								</div>
							<?php } else { ?>
								<?php
									$topMax = 5; // TỐI ĐA 5 THỨ HẠNG
									$top = 1;
									$rank_data = mysqli_query($conn, "SELECT * FROM `top-recharge` WHERE `cash` > 0 AND `month` = '".date('m')."' AND `year` = '".date('Y')."' ORDER BY `cash` DESC LIMIT 0, $topMax");
									while($rank = mysqli_fetch_assoc($rank_data)) {
								
								?>
									<?php if($top == 1) { ?>
										<div class="row">
											<div class="col-3 text-center">
												<img src="<?= rankImg($top); ?>" width="100%">
											</div>
											<div class="col-9">
												<span style="color: orange; font-weight: bold;"><i class="fas fa-crown"></i> <?= $rank['username']; ?></span> <br>
												<span>Tổng nạp: <b class="text-danger" style="font-style: italic"><?= number_format($rank['cash']); ?> VNĐ</b></span>
											</div>
										</div>
									<?php }else if($top == 2){ ?>
										<div class="row">
											<div class="col-3 text-center">
												<img src="<?= rankImg($top); ?>" width="100%">
											</div>
											<div class="col-9">
												<span style="font-weight: bold;"><i class="fas fa-chess-queen"></i> <?= $rank['username']; ?></span> <br>
												<span>Tổng nạp: <b class="text-danger" style="font-style: italic"><?= number_format($rank['cash']); ?> VNĐ</b></span>
											</div>
										</div>
									<?php }else if($top == 3){ ?>
										<div class="row">
											<div class="col-3 text-center">
												<img src="<?= rankImg($top); ?>" width="100%">
											</div>
											<div class="col-9">
												<span style="color: #CD7F32; font-weight: bold;"><i class="fas fa-award"></i> <?= $rank['username']; ?></span> <br>
												<span>Tổng nạp: <b class="text-danger" style="font-style: italic"><?= number_format($rank['cash']); ?> VNĐ</b></span>
											</div>
										</div>
									<?php } else { ?>
										<div class="row">
											<div class="col-3 text-center">
												<img src="<?= rankImg($top); ?>" width="100%">
											</div>
											<div class="col-9">
												<span><?= $rank['username']; ?></span> <br>
												<span>Tổng nạp: <b class="text-danger" style="font-style: italic"><?= number_format($rank['cash']); ?> VNĐ</b></span>
											</div>
										</div>
									<?php } ?>
									<?php $top++; ?>
								<?php } ?>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	window.onscroll = function(ev) {
	    if ((window.innerHeight + window.scrollY) >= document.body.offsetHeight) {

	    	if(numPost >= totalPost){
	    		console.log('bạn đã đi đến cuối trang')
	    		return
	    	}

	    	$.ajax({
		        type: "POST",
		        url: "/ajaxs/server/loadPost.php",
		        data: {
		            numPost,
		            jzon: true
		        },
		        dataType: "text",
		        beforeSend: function(){
		        	$("#jzonPostLoader").show()
		        },
		        complete: function(){
		        	$("#jzonPostLoader").hide()
		        },
		        success: function (res) {
		            $("#jzonNewsfeed").html(res)
		            numPost += 10
		            console.log("success load " + numPost + " post")
		        }
		    });
	    }
	};

	$(document).ready(function() {
        if (!getCookie('jzonNofication')) {
            $('#jzonNofication').modal('show');
        }
    });

    function closeJzonNofication() {
        setCookie('jzonNofication', true, 1);
        $('#jzonNofication').modal('hide');
    }

</script>
<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot.php");
?>