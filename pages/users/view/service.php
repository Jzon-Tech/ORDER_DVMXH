<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");
	

	if(isset($_GET['slug'])){
		$slug = xss($_GET['slug']);

		$ext = explode("/", $slug)[1];

		$slug = str_replace("/manage", "", $slug);

		$info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `slug` = '$slug' "));
		$infoFather = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service` WHERE `key` = '".$info['father']."' "));


		if($info){

			$title = $info['name']." - Dịch vụ ".$infoFather['name'];

			require_once($_SERVER['DOCUMENT_ROOT']."/layout/head.php");
			require_once($_SERVER['DOCUMENT_ROOT']."/layout/navbar.php");


			if(!isset($_SESSION['username'])){
				header("Location: /auth/login");
				exit;
			}

?>
<script>
	let infoService = {
		"slug": "<?= $info['slug']; ?>"
	}
</script>
<div class="content-body">
	<!-- row -->
	<div class="container-fluid">
		<div class="row">
			<div class="col-lg-8">
				<div class="card">
					<div class="card-body">
						<div class="row" style="margin-bottom: 30px;">
							<div class="col-lg-6">
								<a class="btn btn-dark btn-block jzonBtn" data-tab="#createOrder" onclick="jzonTab(this)">Tạo Tiến Trình</a>
							</div>
							<div class="col-lg-6">
								<a class="btn btn-outline-dark btn-block jzonBtn jzon_m" data-tab="#manageOrder" onclick="jzonTab(this)">Quản Lý Order</a>
							</div>
						</div>

						<div class="jzonTab" id="createOrder">
							<?php
								if(filter_var($info['autoExtractID'], FILTER_VALIDATE_BOOLEAN) === true){
									$attr = "oninput='extractIdFb(this)'";
									$placeholder = "Hệ thống tự động lấy ID từ liên kết";
								}else{
									$placeholder = "Nhập link/id Seeding hợp lệ";
								}
							?>
							<div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Link/ID Seeding:</label>
                                <div class="col-sm-10">
                                    <input type="text" class="form-control jzon" <?= $attr; ?> placeholder="<?= $placeholder; ?>" id="object_id">
                                    <span id="successMsg" style="color: green; font-style: italic; display: none;">Get ID từ liên kết thành công</span>
                                </div>	
                            </div>
                            <?php 
                            	if(filter_var($info['comment_field'], FILTER_VALIDATE_BOOLEAN) === true && $info['reactions'] == "") { 
                            		$amount = "text";
                            ?>
                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Nội dung bình luận: <b style="color: red;" id="object_amount"></b></label>
                                <div class="col-sm-10">
                                    <textarea rows="7" data-type="comment" onkeyup="amountComment(this); calculatePrice(this);" class="form-control jzon" placeholder="Mỗi bình luận 1 dòng (1 Enter = 1 Bình luận = 1 Số lượng)" id="list_comment" style="margin-top: 0px; margin-bottom: 0px; height: 155px;"></textarea>
                                </div>	
                            </div>
                        	<?php 
                        		}else{ 
	                        		$amount = "val";
                        	?>
                    		<div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Số lượng:</label>
                                <div class="col-sm-10">
                                    <input type="number" class="form-control jzon" placeholder="Số lượng thực thi" value="<?= $info['amount_minimum']; ?>" id="object_amount" data-type="val" onkeyup="calculatePrice(this)">
                                    <span style="font-style: italic; color: red;">*Tối thiểu <?= $info['amount_minimum']; ?> lượt / Tối đa <?= $info['amount_maximum']; ?> lượt</span>
                                </div>	
                            </div>
                        	<?php } ?>
                        	

                        	<?php 
	                        	if($info['reactions'] != "" && filter_var($info['comment_field'], FILTER_VALIDATE_BOOLEAN) !== true) { 
                        	?>	
                        	<div class="mb-3 row">
                        		<input type="hidden" id="main_reaction">
                                <label class="col-sm-2 col-form-label">Cảm xúc:</label>
                                <div class="col-sm-10">
                                	<?php 
		                        		$reactions_arr = json_decode($info['reactions'], true);
		                        		foreach ($reactions_arr as $data_reactions) {
		                        			$reaction = explode('|', $data_reactions)[0];
		                        			$rate = explode('|', $data_reactions)[1];
		                        	?>
		                        	<label style="padding:0px 10px">
                                        <input type="radio" id="reaction" name="reaction" data-reaction="<?= $data_reactions; ?>" onclick="chooseReaction(this); calculatePrice(this)">
                                        <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/images/jzonReactions/<?= $reaction; ?>.png" style="width:30px">
                                    </label>
		                        	<?php
		                        		}
		                        	?>	
                                </div>
                            </div>
                        	<?php } ?>

                        	<div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Chọn server:</label>
                                <div class="col-sm-10">
                                    <select class="js-example-theme-single" id="server" style="color: black;" data-type="key" onchange="calculatePrice(this)">
			                        	<option value="">-- Vui lòng chọn server --</option>
		                                <?php 
		                                	$i = 1;
			                        		$server_query = mysqli_query($conn, "SELECT * FROM `list_server` WHERE `slug` = '".$info['slug']."' AND `display` = 'show' ORDER BY `id` DESC ");
			                        		while($server = mysqli_fetch_assoc($server_query)) { 
			                        	?>
			                        	<option value="<?= $server['key']; ?>">[ SERVER <?= $i++; ?> ] ▶️ <?= $server['note']; ?> 💰 Giá: <?= number_format($server['price']); ?> VNĐ</option>
			                        	<?php } ?>
		                            </select>
                                </div>	
                            </div>

                            <div class="mb-3 row">
                                <label class="col-sm-2 col-form-label">Ghi chú:</label>
                                <div class="col-sm-10">
                                    <textarea rows="7" class="form-control jzon" placeholder="Nhập ghi chú nếu cần thiết" id="note" style="margin-top: 0px; margin-bottom: 0px; height: 155px;"></textarea>
                                </div>	
                            </div>

                            <div class="alert alert-primary" style="text-align: center;">
                            	<h3>Tổng tiền: <b id="total_cash" style="color: red;">0</b> VNĐ</h3>
                            </div>
                            <a class="btn btn-primary btn-block" data-amount="<?= $amount; ?>" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG TẠO TIẾN TRÌNH' onclick="createOrder(this)">
                            	TẠO TIẾN TRÌNH
                            </a>
						</div>
						<div class="jzonTab" id="manageOrder" style="display: none;">
							<div class="table-responsive">
							    <table id="example4" class="table table-bordered table-striped">
							        <thead>
							            <tr>
							                <th>Mã đơn</th>
							                <th>Dịch vụ</th>
							                <th>Server</th>
							                <th>ID Seeding</th>
							                <?php 
							                	if(filter_var($info['comment_field'], FILTER_VALIDATE_BOOLEAN) === true) { 
							                		echo "<th>Bình luận</th>";
							                	}

							                	if($info['reactions'] != "" && filter_var($info['comment_field'], FILTER_VALIDATE_BOOLEAN) !== true) { 
							                		echo "<th>Cảm xúc</th>";
							                	}
							                ?>
							                <th>Số lượng</th>
							                <th>Tổng tiền</th>
							                <th>Ghi chú</th>
							                <th>Tin nhắn Admin</th>
							                <th>Ngày tạo</th>
							                <th>Trạng thái</th>
							            </tr>
							        </thead>
								        <?php 
								        	$order_query = mysqli_query($conn, "SELECT * FROM `order` WHERE `buyer` = '".$_SESSION['username']."' AND `childSlug` = '".$info['slug']."' ORDER BY `id` DESC ");
								        	while($order = mysqli_fetch_assoc($order_query)){ 
								        		$infoChild = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `slug` = '".$order['childSlug']."' "));
								        		$infoServer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_server` WHERE `key` = '".$order['server']."' "));
								        ?>
							        	<tr>
							        		<td><?= $order['code']; ?></td>
							        		<td><?= $infoChild['name']; ?></td>
							        		<td><?= $infoServer['note']; ?></td>
							        		<td><?= $order['object_id']; ?></td>

							        		<?php if($order['list_comment'] != NULL && $order['reactions'] == NULL) { ?>
							        		<td>
						        				<textarea class="form-control" rows="3" readonly=""><?= $order['list_comment']; ?></textarea>
							        		</td>
							        		<?php 
							        			}else if($order['list_comment'] == NULL && $order['reactions'] != NULL){ 
							        				$reaction = explode("|", $order['reactions'])[0];
							        		?> 
							        		<td style="text-align: center;">
							        			<img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/images/jzonReactions/<?= $reaction; ?>.png" style="width:30px">
							        		</td>
							        		<?php } ?>

							        		<td><?= number_format($order['amount']); ?></td>
							        		<td><?= number_format($order['total_cash']); ?> VNĐ</td>
							        		<td>
						        				<textarea class="form-control" rows="3" readonly=""><?= $order['note']; ?></textarea>
							        		</td>
							        		<td>
						        				<textarea class="form-control" rows="3" readonly=""><?= $order['admin_note']; ?></textarea>
							        		</td>
							        		<td><?= formatDate($order['created_time']); ?></td>
							        		<td style="text-align: center;"><?= showStatusOrder($order['status']); ?></td>
							        	</tr>
								        <?php } ?>
							        </tbody>
							    </table>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-lg-4">
				<div class="card">
					<div class="card-body">
						<div class="alert alert-danger" style="color: black;">
							<h3 style="text-align: center; color: #f86262!important;">LƯU Ý NÊN ĐỌC TRƯỚC KHI MUA </h3>
							<div style="margin-top: 20px;">
								<?= $info['warn_msg']; ?>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<script>
	$(document).ready(function () {
		<?php if(!jzonMobile()) { ?>
	    $.noConflict();
		<?php } ?>
	    var table = $("#example4").DataTable({
			language: {
				paginate: {
				  next: '<i class="fa fa-angle-double-right" aria-hidden="true"></i>',
				  previous: '<i class="fa fa-angle-double-left" aria-hidden="true"></i>' 
				}
		  	},
		  	"ordering": false
		});
	});

	<?php if($ext == 'manage') { ?>
		function manageTab(){
			var full_path = window.location.pathname
			var cre = full_path.replace("/manage", "")
			history.pushState({}, null, cre);

			$('.jzon_m').click();
		}

		$(function(){
			manageTab()
		})
	<?php } ?>

	function jzonTab(data){
        var id_tab = $(data).attr('data-tab')
		
		var full_path = window.location.pathname

		if(id_tab == '#createOrder'){
			var cre = full_path.replace("/manage", "")
			history.pushState({}, null, cre);
		}else if(id_tab == '#manageOrder'){
			var uk = full_path + "/manage"
			history.pushState({}, null, uk);
		}

        $(".jzonBtn").removeClass('btn-dark').addClass('btn-outline-dark')
        $(data).removeClass('btn-outline-dark').addClass('btn-dark')

        $('.jzonTab').hide()
        $(id_tab).show()
    }

    function calculatePrice(data){

		var key = $("#server").val()
		<?php 
			if($info['reactions'] != "" && filter_var($info['comment_field'], FILTER_VALIDATE_BOOLEAN) !== true) { 
		?>
		var amount = $("#object_amount").val()
		var reaction = $("#main_reaction").val()
		if(!key || !amount || amount <= 0 || !reaction){
			console.log(reaction + " - " + amount + " - " + key)
			return;
		}

		$.ajax({
	        type: "POST",
	        url: "/ajaxs/users/calculatePrice.php",
	        data: {
	            key,
	            amount,
	            reaction,
	            jzon: true
	        },
	        dataType: "json",
	        success: function (res) {
	            if(res.success){
	                $("#total_cash").html(res.total_cash)
	            }else{
	                jzonAlert(res.error, "error")
	            }
	        }
	    });
		<?php }else if($info['reactions'] == "" && filter_var($info['comment_field'], FILTER_VALIDATE_BOOLEAN) === true) { ?>
			
		var amount = $("#object_amount").text()
		if(!key || !amount || amount <= 0){
			console.log(key + " - " + amount)
			return;
		}

		
		$.ajax({
	        type: "POST",
	        url: "/ajaxs/users/calculatePrice.php",
	        data: {
	            key,
	            amount,
	            jzon: true
	        },
	        dataType: "json",
	        success: function (res) {
	            if(res.success){
	                $("#total_cash").html(res.total_cash)
	            }else{
	                jzonAlert(res.error, "error")
	            }
	        }
	    });

		<?php }else{ ?>
			
		var amount = $("#object_amount").val()
		if(!key || !amount || amount <= 0){
			// console.log(reaction + " - " + amount + " - " + key)
			return;
		}

		

		$.ajax({
	        type: "POST",
	        url: "/ajaxs/users/calculatePrice.php",
	        data: {
	            key,
	            amount,
	            jzon: true
	        },
	        dataType: "json",
	        success: function (res) {
	            if(res.success){
	                $("#total_cash").html(res.total_cash)
	            }else{
	                jzonAlert(res.error, "error")
	            }
	        }
	    });

		<?php } ?>

		
	}

	function chooseReaction(data){
		var reaction = $(data).attr('data-reaction')
		$("#main_reaction").val(reaction)
	}



    	
</script>
<?php 
		}else{
			header('Location: /home');
			exit;
		}
	}else{
		header('Location: /home');
		exit;
	}

	require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot.php");
?>