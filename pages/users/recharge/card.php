<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	$title = "Thẻ cào tự động";

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
                <div class="alert alert-warning" style="<?= $mode; ?>">
                    <?= setting('card_note'); ?>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="font-weight: bold;">Thẻ cào tự động</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Nhà mạng:</label>
                                    <select class="form-control jzon" id="telco" style="border-color: black!important;">
                                        <option value="">
                                            -- CHỌN NHÀ MẠNG --
                                        </option>
                                        <option value="VIETTEL">
                                            Viettel (TỰ ĐỘNG)
                                        </option>
                                        <option value="VINAPHONE">
                                            Vinaphone (TỰ ĐỘNG)
                                        </option>
                                        <option value="MOBIFONE">
                                            Mobifone (TỰ ĐỘNG)
                                        </option>
                                        <option value="ZING">
                                            Zing (TỰ ĐỘNG)
                                        </option>
                                        <option value="VNMOBI">
                                            VietnamMobile (TỰ ĐỘNG)
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Mệnh giá:</label>
                                    <select class="form-control jzon" id="amount" style="border-color: black!important;">
                                        <option value="">
                                            -- CHỌN MỆNH GIÁ --
                                        </option>
                                        <option value="10000">
                                            10,000đ
                                        </option>
                                        <option value="20000">
                                            20,000đ
                                        </option>
                                        <option value="30000">
                                            30,000đ
                                        </option>
                                        <option value="50000">
                                            50,000đ
                                        </option>
                                        <option value="100000">
                                            100,000đ
                                        </option>
                                        <option value="200000">
                                            200,000đ
                                        </option>
                                        <option value="300000">
                                            300,000đ
                                        </option>
                                        <option value="500000">
                                            500,000đ
                                        </option>
                                        <option value="1000000">
                                            1,000,000đ
                                        </option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Mã thẻ:</label>
                                    <input class="form-control jzon" id="pin" placeholder="Nhập mã thẻ" style="border-color: black!important; color: green;">
                                </div>
                            </div>
                            <div class="col-lg-3">
                                <div class="form-group">
                                    <label>Số seri:</label>
                                    <input class="form-control jzon" id="serial" placeholder="Nhập số seri" style="border-color: black!important; color: green;">
                                </div>
                            </div>

                            <div class="col-lg-12 text-center">
                                <a class="btn btn-primary" style="padding-right: 30px; padding-left: 30px;" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG NẠP THẺ' onclick="requestCard(this)">
                                    <i class="fas fa-paper-plane"></i>&nbsp;&nbsp;NẠP THẺ NGAY
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="font-weight: bold;">Lịch sử nạp thẻ</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="display table table-bordered table-striped" style="min-width: 845px">
                                <thead class="text-center">
                                    <tr>
                                        <th>STT</th>
                                        <th>Nhà mạng</th>
                                        <th>Mệnh giá</th>
                                        <th>Thực nhận</th>
                                        <th>Mã thẻ</th>
                                        <th>Số seri</th>
                                        <th>Thời gian tạo</th>
                                        <th>Trạng thái</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $jzon = 0;
                                        $card_query = mysqli_query($conn, "SELECT * FROM `auto-card` WHERE `username` = '".$_SESSION['username']."' ORDER BY `id` DESC");
                                        while($card = mysqli_fetch_assoc($card_query)){ 
                                    ?>
                                    <tr class="text-center">
                                        <td><?= $jzon++; ?></td>
                                        <td style="font-weight: bold;"><?= $card['telco']; ?></td>
                                        <td style="font-weight: bold; color: blue;"><?= number_format($card['amount_origin']); ?>đ</td>
                                        <td style="font-weight: bold; color: red;"><?= number_format($card['amount_recieve']); ?>đ</td>
                                        <td style="font-weight: bold; color: green;"><?= $card['pin']; ?></td>
                                        <td style="font-weight: bold; color: green;"><?= $card['serial']; ?></td>
                                        <td style="<?= $mode; ?>"><?= formatDate($card['created_time']); ?></td>
                                        <td><?= showStatusCard($card['status']); ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
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
		  	}
		});
	});
</script>
<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot.php");
?>