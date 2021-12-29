<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	$title = "Tạo yêu cầu hỗ trợ";

	require_once($_SERVER['DOCUMENT_ROOT']."/layout/head.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/layout/navbar.php");

	if(!isset($_SESSION['username'])){
		header("Location: /auth/login");
		exit;
	}
?>
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-12">
				<div class="alert alert-success" style="<?= $mode; ?>">
					<?= setting('support_caution'); ?>
				</div>
			</div>
			
			<div class="col-lg-12">
				<div class="card">
					<div class="card-body">
						<div class="row">
						    <div class="mb-3 col-md-12">
						        <label class="form-label">Tiêu đề:</label>
						        <input type="text" class="form-control jzon" id="title__" placeholder="Nhập tiêu đề cần hỗ trợ" />
						    </div>
						    <div class="mb-3 col-md-6">
						        <label class="form-label">Vấn đề:</label>
						        <select class="js-example-theme-single" id="problem" style="color: black;">
		                        	<option value="">-- Vui lòng vấn đề hỗ trợ --</option>
	                                <?php 
		                        		$support_problem_query = mysqli_query($conn, "SELECT * FROM `support_problem` ");
		                        		while($support = mysqli_fetch_assoc($support_problem_query)) { 
		                        	?>
		                        	<option value="<?= $support['key']; ?>"><?= $support['name']; ?></option>
		                        	<?php } ?>
	                            </select>
						    </div>
						    <div class="mb-3 col-md-6">
						        <label class="form-label">Dịch vụ liên quan:</label>
						        <select class="js-example-theme-single" id="service" style="color: black;">
		                        	<option value="noService">Không có</option>
	                                <?php 
		                        		$support_order_query = mysqli_query($conn, "SELECT * FROM `order` WHERE `buyer` = '".$_SESSION['username']."' ORDER BY `id` DESC ");
		                        		while($order = mysqli_fetch_assoc($support_order_query)) { 
		                        			$infoChild = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `slug` = '".$order['childSlug']."' "));
		                        	?>
		                        	<option value="<?= $order['code']; ?>"><?= $infoChild['name']; ?> - ID: <?= $order['object_id']; ?> - Thời gian: <?= formatDate($order['created_time']); ?> - Tổng tiền: <?= number_format($order['total_cash']); ?> VNĐ</option>
		                        	<?php } ?>
	                            </select>
						    </div>
						    <div class="mb-3 col-md-12">
						        <label>Mô tả chi tiết:</label>
						        <textarea rows="7" class="form-control jzon" placeholder="Bạn đang cần hỗ trợ gì ạ ?" id="describe" style="margin-top: 0px; margin-bottom: 0px; height: 155px;"></textarea>
						        <div style="text-align: right!important; margin-top: 10px;">
						        	<input type="file" id="upfile" name="picture" style="display: none;" accept="image/*">
						        	<button id="jzonUpFile" class="btn btn-danger" style="padding: 5px; padding-left: 20px; padding-right: 20px; font-size: 17px; border-radius: 7px;"><i class="far fa-images"></i> Tải hình ảnh</button>
						    	</div>
						    </div>
						    <div class="col-md-6 mr-auto ml-auto" style="text-align: center;"><img id="jzonOutput" /></div>
						    <div class="md-3 col-md-12">
						    	<a class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG TẠO TIẾN TRÌNH' onclick="createSupport(this)">
						    		<i class="fas fa-paper-plane"></i> GỬI YÊU CẦU NGAY
						    	</a>
						    </div>
						</div>

					</div>
				</div>
			</div>
		</div>	
	</div>
</div>
<script>
	$('#jzonUpFile').click(function(e) {
        e.preventDefault();
        $('#upfile').click();
    });
    $('#upfile').change(function(e) {
        e.preventDefault();
        let output = $('#jzonOutput');
        output.css('max-width', '300px');
        output.addClass('pt-3');
        output.addClass('mb-3');
        let reader = new FileReader();
        reader.onload = function() {
            output.attr('src', reader.result);
        };
        reader.readAsDataURL(event.target.files[0]);
    });

    
</script>
<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot.php");
?>