<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	$title = "Ngân hàng/Ví điện tử";

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
                    <?= setting('banking_note'); ?>
                </div>
            </div>
            <?php 
                if(setting('momo_token') != "") {
            ?>
            <div class="col-lg-4">
                <div class="card" style="height: calc(100% - 1.875rem);">
                    <div class="card-body">
                        <div style="text-align: center;">
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/images/banking/momo3.png" height="45px">
                        </div>
                        <div style="margin-top: 15px;">
                            <ul style="<?= $mode; ?>">
                                <li>
                                    <div class="row">
                                        <div style="flex: 0 0 auto; width: 37.333333%;">
                                            <span style="font-weight: bold;">
                                                Chủ tài khoản:
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; width: 62.666667%;">
                                            <span style="font-style: italic;">
                                                <?= setting('momo_owner'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li style="margin-top: 10px;">
                                    <div class="row">
                                        <div style="flex: 0 0 auto; width: 37.333333%;">
                                            <span style="font-weight: bold;">
                                                Số điện thoại:
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; width: 62.666667%;">
                                            <span style="font-style: italic;">
                                                <?= setting('momo_phone'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li style="margin-top: 10px;">
                                    <div class="row">
                                        <div style="flex: 0 0 auto; width: 37.333333%;">
                                            <span style="font-weight: bold;">
                                                Thời gian:
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; width: 62.666667%;">
                                            <span style="font-style: italic; color: red; font-weight: bold;">
                                                TỰ ĐỘNG
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div style="margin-top: 15px; text-align: center; display: none;" id="success_msg_momo">
                                <a style="font-style: italic; color: green;">Sao chép nội dung thành công</a>
                            </div>
                            <div style="margin-top: 10px;">
                                <a class="btn light btn-primary btn-block jzon" onclick="jzonCopy('<?= memoMode('page'); ?>', '#success_msg_momo')">
                                    <?= memoMode('page'); ?>&nbsp;&nbsp;<i class="fas fa-copy"></i>
                                </a>
                            </div>
                            <div style="margin-top: 10px; text-align: center;">
                                <span class="text-muted"><?= setting('momo_note'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>



            <?php 
                if(setting('zalo_token') != "") {
            ?>
            <div class="col-lg-4">
                <div class="card" style="height: calc(100% - 1.875rem);">
                    <div class="card-body">
                        <div style="text-align: center;">
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/images/banking/zalo-pay.png" height="45px">
                        </div>
                        <div style="margin-top: 15px;">
                            <ul style="<?= $mode; ?>">
                                <li>
                                    <div class="row">
                                        <div style="flex: 0 0 auto; width: 37.333333%;">
                                            <span style="font-weight: bold;">
                                                Chủ tài khoản:
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; width: 62.666667%;">
                                            <span style="font-style: italic;">
                                                <?= setting('zalo_owner'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li style="margin-top: 10px;">
                                    <div class="row">
                                        <div style="flex: 0 0 auto; width: 37.333333%;">
                                            <span style="font-weight: bold;">
                                                Số điện thoại:
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; width: 62.666667%;">
                                            <span style="font-style: italic;">
                                                <?= setting('zalo_phone'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li style="margin-top: 10px;">
                                    <div class="row">
                                        <div style="flex: 0 0 auto; width: 37.333333%;">
                                            <span style="font-weight: bold;">
                                                Thời gian:
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; width: 62.666667%;">
                                            <span style="font-style: italic; color: red; font-weight: bold;">
                                                TỰ ĐỘNG
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div style="margin-top: 15px; text-align: center; display: none;" id="success_msg_zalo">
                                <a style="font-style: italic; color: green;">Sao chép nội dung thành công</a>
                            </div>
                            <div style="margin-top: 10px;">
                                <a class="btn light btn-primary btn-block jzon" onclick="jzonCopy('<?= memoMode('page'); ?>', '#success_msg_zalo')">
                                    <?= memoMode('page'); ?>&nbsp;&nbsp;<i class="fas fa-copy"></i>
                                </a>
                            </div>
                            <div style="margin-top: 10px; text-align: center;">
                                <span class="text-muted"><?= setting('zalo_note'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>
            
            <?php 
                if(setting('vcb_token') != "") {
            ?>
            <div class="col-lg-4">
                <div class="card" style="height: calc(100% - 1.875rem);">
                    <div class="card-body">
                        <div style="text-align: center;">
                            <img src="https://upload.wikimedia.org/wikipedia/en/thumb/c/c1/Vietcombank_logo.svg/1200px-Vietcombank_logo.svg.png" height="45px">
                        </div>
                        <div style="margin-top: 15px;">
                            <ul style="<?= $mode; ?>">
                                <li>
                                    <div class="row">
                                        <div style="flex: 0 0 auto; width: 37.333333%;">
                                            <span style="font-weight: bold;">
                                                Chủ tài khoản:
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; width: 62.666667%;">
                                            <span style="font-style: italic;">
                                                <?= setting('vcb_owner'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li style="margin-top: 10px;">
                                    <div class="row">
                                        <div style="flex: 0 0 auto; width: 37.333333%;">
                                            <span style="font-weight: bold;">
                                                Số điện thoại:
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; width: 62.666667%;">
                                            <span style="font-style: italic;">
                                                <?= setting('vcb_stk'); ?>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li style="margin-top: 10px;">
                                    <div class="row">
                                        <div style="flex: 0 0 auto; width: 37.333333%;">
                                            <span style="font-weight: bold;">
                                                Thời gian:
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; width: 62.666667%;">
                                            <span style="font-style: italic; color: red; font-weight: bold;">
                                                TỰ ĐỘNG
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div style="margin-top: 15px; text-align: center; display: none;" id="success_msg_vcb">
                                <a style="font-style: italic; color: green;">Sao chép nội dung thành công</a>
                            </div>
                            <div style="margin-top: 10px;">
                                <a class="btn light btn-primary btn-block jzon" onclick="jzonCopy('<?= memoMode('page'); ?>', '#success_msg_vcb')">
                                    <?= memoMode('page'); ?>&nbsp;&nbsp;<i class="fas fa-copy"></i>
                                </a>
                            </div>
                            <div style="margin-top: 10px; text-align: center;">
                                <span class="text-muted"><?= setting('vcb_note'); ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <?php 
                $bank_query = mysqli_query($conn, "SELECT * FROM `list_bank` ");
                while($bank = mysqli_fetch_assoc($bank_query)) { 
            ?>
            <div class="col-lg-4">
                <div class="card" style="height: calc(100% - 1.875rem);">
                    <div class="card-body">
                        <div style="text-align: center;">
                            <img src="<?= $bank['logo_bank']; ?>" height="45px">
                        </div>
                        <div style="margin-top: 15px;">
                            <ul style="<?= $mode; ?>">
                                <li>
                                    <div class="row">
                                        <div style="flex: 0 0 auto; width: 37.333333%;">
                                            <span style="font-weight: bold;">
                                                Chủ tài khoản:
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; width: 62.666667%;">
                                            <span style="font-style: italic;">
                                                <?= $bank['owner']; ?>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li style="margin-top: 10px;">
                                    <div class="row">
                                        <div style="flex: 0 0 auto; width: 37.333333%;">
                                            <span style="font-weight: bold;">
                                                Số tài khoản:
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; width: 62.666667%;">
                                            <span style="font-style: italic;">
                                                <?= $bank['number_account']; ?>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                                <li style="margin-top: 10px;">
                                    <div class="row">
                                        <div style="flex: 0 0 auto; width: 37.333333%;">
                                            <span style="font-weight: bold;">
                                                Chi nhánh:
                                            </span>
                                        </div>
                                        <div style="flex: 0 0 auto; width: 62.666667%;">
                                            <span style="font-style: italic;">
                                                <?= $bank['branch']; ?>
                                            </span>
                                        </div>
                                    </div>
                                </li>
                            </ul>
                            <div style="margin-top: 15px; text-align: center; display: none;" id="success_msg_<?= $bank['id']; ?>">
                                <a style="font-style: italic; color: green;">Sao chép nội dung thành công</a>
                            </div>
                            <div style="margin-top: 10px;">
                                <a class="btn light btn-primary btn-block jzon" onclick="jzonCopy('<?= memoMode('page'); ?>', '#success_msg_<?= $bank['id']; ?>')">
                                    <?= memoMode('page'); ?>&nbsp;&nbsp;<i class="fas fa-copy"></i>
                                </a>
                            </div>
                            <div style="margin-top: 10px; text-align: center;">
                                <span class="text-muted"><?= $bank['note']; ?></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php } ?>

            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="font-weight: bold;">Lịch sử nạp ví MOMO</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="display table table-bordered table-striped" style="min-width: 845px">
                                <thead class="text-center">
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã GD</th>
                                        <th>Số điện thoại</th>
                                        <th>Chủ TK</th>
                                        <th>Số tiền</th>
                                        <th>Nội dung</th>
                                        <th>Thời gian tạo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $jzon = 0;
                                        $momo_query = mysqli_query($conn, "SELECT * FROM `auto-momo` WHERE `username` = '".$_SESSION['username']."' ORDER BY `id` DESC");
                                        while($momo = mysqli_fetch_assoc($momo_query)){ 
                                    ?>
                                    <tr class="text-center">
                                        <td><?= $jzon++; ?></td>
                                        <td style="font-weight: bold; color: red;"><?= $momo['tranId']; ?></td>
                                        <td style="font-weight: bold; color: blue;"><?= $momo['partnerId']; ?></td>
                                        <td style="font-weight: bold; color: blue;"><?= $momo['partnerName']; ?></td>
                                        <td style="font-weight: bold; color: green;"><?= number_format($momo['amount']); ?> VNĐ</td>
                                        <td style="font-weight: bold; <?= $mode; ?>"><?= $momo['comment']; ?></td>
                                        <td style="font-weight: bold; <?= $mode; ?>"><?= formatDate($momo['created_time']); ?></td>
                                    </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title" style="font-weight: bold;">Lịch sử nạp Zalo Pay</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example5" class="display table table-bordered table-striped" style="min-width: 845px">
                                <thead class="text-center">
                                    <tr>
                                        <th>STT</th>
                                        <th>Mã GD</th>
                                        <th>Chủ TK</th>
                                        <th>Số tiền</th>
                                        <th>Nội dung</th>
                                        <th>Thời gian tạo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $jzon = 0;
                                        $zalo_pay_query = mysqli_query($conn, "SELECT * FROM `auto-zalo-pay` WHERE `username` = '".$_SESSION['username']."' ORDER BY `id` DESC");
                                        while($zalo_pay = mysqli_fetch_assoc($zalo_pay_query)){ 
                                    ?>
                                    <tr class="text-center">
                                        <td><?= $jzon++; ?></td>
                                        <td style="font-weight: bold; color: red;"><?= $zalo_pay['transid']; ?></td>
                                        <td style="font-weight: bold; color: blue;"><?= $zalo_pay['owner']; ?></td>
                                        <td style="font-weight: bold; color: green;"><?= number_format($zalo_pay['amount']); ?> VNĐ</td>
                                        <td style="font-weight: bold; <?= $mode; ?>"><?= $zalo_pay['comment']; ?></td>
                                        <td style="font-weight: bold; <?= $mode; ?>"><?= formatDate($zalo_pay['created_time']); ?></td>
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
        var table = $("#example5").DataTable({
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