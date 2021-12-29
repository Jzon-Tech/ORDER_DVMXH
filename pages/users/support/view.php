<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");
	

	if(isset($_GET['code'])){
		$code = xss($_GET['code']);

		$info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `code` = '$code' "));

		if($info) {
			if($info['username'] == $_SESSION['username'] || infoMe('level') == 'admin'){

				$title = "Chi tiết hỗ trợ #$code";

				require_once($_SERVER['DOCUMENT_ROOT']."/layout/head.php");
				require_once($_SERVER['DOCUMENT_ROOT']."/layout/navbar.php");


				if(!isset($_SESSION['username'])){
					header("Location: /auth/login");
					exit;
				}

?>
<style>
.message {
    display: flex;
    flex-direction: column;
    clear: both;
    margin-bottom: 3px;
}
.message.me {
    float: right;
    max-width: 90%;
    align-items: flex-end;
    margin-right: 16px;
}
.message.you {
    float: left;
    width: 100%;
    align-items: flex-start;
}
.message.you .bubble:not(.has-previous) {
    border-top-left-radius: 15px;
}
.message.you .bubble:not(.has-next) {
    border-bottom-left-radius: 15px;
}
.message.you .bubble {
    max-width: 80%;
    color: #1a1a1a;
    background-color: #eceff1;
    align-self: flex-start;
    border-top-right-radius: 15px;
    border-bottom-right-radius: 15px;
}
.message.you .bubble:before {
    left: -3px;
    background-color: #eceff1;
}
.message .bubble:not(.has-previous):before {
    position: absolute;
    top: 11px;
    display: block;
    width: 8px;
    height: 6px;
    content: "\00a0";
    -webkit-transform: rotate(29deg) skew(-35deg);
    transform: rotate(29deg) skew(-35deg);
}
.message.me .bubble:not(.has-previous) {
    border-top-right-radius: 15px;
}
.message.me .bubble:not(.has-next) {
    border-bottom-right-radius: 15px;
}
.message.me .bubble {
    color: #fff;
    background-color: #0b93f6;
    align-self: flex-end;
    border-top-left-radius: 15px;
    border-bottom-left-radius: 15px;
}
.message .bubble {
    font-size: 16px;
    position: relative;
    display: inline-block;
    padding: 5px 10px;
    vertical-align: top;
    word-wrap: break-word;
    word-break: break-word;
}
.message.me .bubble:before {
    right: -3px;
    background-color: #0b93f6;
}
.message .bubble:not(.has-previous):before {
    position: absolute;
    top: 11px;
    display: block;
    width: 8px;
    height: 6px;
    content: "\00a0";
    -webkit-transform: rotate(29deg) skew(-35deg);
    transform: rotate(29deg) skew(-35deg);
}
#support_data::-webkit-scrollbar {
  width:5px;
}
#support_data::-webkit-scrollbar-track {
  -webkit-box-shadow:inset 0 0 6px rgba(0,0,0,0.3); 
  border-radius:5px;
}
#support_data::-webkit-scrollbar-thumb {
  border-radius:5px;
  -webkit-box-shadow: inset 0 0 6px red; 
}

</style>
<div class="content-body">
	<!-- row -->
	<div class="container-fluid jzonFluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="row mb-2">
						    <div class="col-auto"><img src="<?= avatarUser($info['username']); ?>" width="52" alt="user" class="rounded-circle" /></div>
						    <div class="col pl-0">
						        <h6 class="fs-0" style="margin-bottom: 8px;"><?= $info['title']; ?></h6>
						        <h6 class="badge badge-primary mr-2"><?= $info['problem']; ?></h6>
						    </div>
						    <div class="col-auto text-right">
						        <h6 class="mb-0">
						            <i class="far fa-comment-alt"></i>
						            <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_message` WHERE `code` = '".$info['code']."' ")); ?>
						        </h6>
						        <p class="text-success" style="font-weight: bold"><?= timeAgo($info['created_time']); ?></p>
						    </div>
						</div>
						<hr>
						<div id="support_data" style="height: 400px; overflow-y: scroll;">
							<?php 
								$ms_query = mysqli_query($conn, "SELECT * FROM `support_message` WHERE `code` = '".$info['code']."' ");
								while($ms = mysqli_fetch_assoc($ms_query)) { 
									if($ms['sender'] == $_SESSION['username']) {
										$attr = 'me';
									}else{
										$attr = 'you';
									}
							?>
								<?php if($ms['image'] != "") { ?>
									<div class="message <?= $attr; ?>">
										<span class="bubble">
											<a data-fancybox="gallery" href="<?= $ms['image']; ?>">
												<img src="<?= $ms['image']; ?>" width="100px">
											</a>
										</span>
									</div>
								<?php }else{ ?>
									<div class="message <?= $attr; ?>">
										<span class="bubble">
											<?= base64_decode($ms['message']); ?>
										</span>
									</div>
								<?php } ?>
							<?php } ?>
						</div>
						<?php if($info['status'] == 'process' || $info['status'] == 'wait') { ?>
						<div style="margin-top: 10px;">
							<div class="input-group">
                                <input type="text" class="form-control jzon" id="message" style="border-color: black!important;" placeholder="Gửi tin nhắn đến hỗ trợ viên">
								<button class="btn btn-primary" data-code="<?= $info['code']; ?>" data-loading='<i class="fas fa-spinner fa-pulse"></i>' onclick="sendSupportMessage1(this)"><i class="fas fa-paper-plane"></i></button>
                            </div>
						</div>
						<?php } ?>
						<div style="margin-top: 10px; text-align: center;">
							<?php if($info['status'] == 'process' || $info['status'] == 'wait') { ?>
							<button class="btn btn-danger btn-sm jzon" style="padding-right: 30px;padding-left: 30px;" data-code="<?= $info['code']; ?>" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG ĐÓNG HỖ TRỢ' onclick="closeSupport(this)"><i class="fas fa-times-circle"></i> Đóng hỗ trợ</button>
							<?php }else{ ?>
							
							<button class="btn btn-success btn-sm jzon" style="padding-right: 30px;padding-left: 30px;" data-code="<?= $info['code']; ?>" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG MỞ HỖ TRỢ' onclick="openSupport(this)">Mở hỗ trợ</button>
							<?php } ?>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	window.onload=function () {
	     var objDiv = document.getElementById("support_data");
	     obj          message,
	      Div.scrollTop = objDiv.scrollHeight;
	}
</script>
<?php 
			}else{
				header('Location: /support/list');
				exit;
			}
		}else{
			header('Location: /support/list');
			exit;
		}
	}else{
		header('Location: /support/list');
		exit;
	}

	require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot.php");
?>