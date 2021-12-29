<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	$title = "Nhật kí hoạt động";

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
            <div class="col-12">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Nhật kí hoạt động</h4>
                    </div>
                    <div class="card-body">
                        <div class="table-responsive">
                            <table id="example4" class="display table table-bordered table-striped" style="min-width: 845px">
                                <thead>
                                    <tr>
                                        <th>STT</th>
                                        <th>Nội đung</th>
                                        <th>Thời gian tạo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $jzon = 0;
                                        $log_query = mysqli_query($conn, "SELECT * FROM `log_system` WHERE `username` = '".$_SESSION['username']."' ORDER BY `id` DESC");
                                        while($log = mysqli_fetch_assoc($log_query)){ 
                                    ?>
                                    <tr>
                                        <td><?= $jzon++; ?></td>
                                        <td><?= $log['content']; ?></td>
                                        <td><?= formatDate($log['created_time']); ?></td>
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