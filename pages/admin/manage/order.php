<?php 

    $admin_page = true;

	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");
	

	if(isset($_GET['slug'])){
		$slug = xss($_GET['slug']);

		$info = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `slug` = '$slug' "));
		$infoFather = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service` WHERE `key` = '".$info['father']."' "));


		if($info){

			$title = "Đơn hàng ".$info['name']." - Dịch vụ ".$infoFather['name'];

			require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
            require_once($_SERVER['DOCUMENT_ROOT']."/layout/sidebar_admin.php");


			if(!isset($_SESSION['admin'])){
                header("Location: /admin/login");
                exit;
            }
?>
<div class="row">
    <div class="col-lg-12" id="jzonAction" style="display: none; margin-bottom: 10px;">
        <div class="card">
            <div class="card-body">
                <div class="text-center">
                    <h4 class="">THAO TÁC HÀNG LOẠT</h4>
                    <span class="text-muted">Bạn đang thao tác <span id="totalOrder" style="color: red; font-weight: bold;">0</span> đơn</span>

                    <div class="form-group" style="margin-top: 10px;">
                        <button class="btn btn-success" data-action="done" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG DUYỆT' onclick="actionOrder(this)"><i class="fas fa-check-square"></i> Hoàn tất</button>
                        <button class="btn btn-warning" data-action="running" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG CHUYỂN' onclick="actionOrder(this)"><i class="fas fa-running"></i> Đang chạy</button>
                        <button class="btn btn-danger" data-action="fail" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG HỦY' onclick="actionOrder(this)"><i class="fas fa-times-circle"></i> Hủy</button>
                        <button class="btn btn-primary" data-action="message" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG GỬI' onclick="actionOrder(this)"><i class="fas fa-comment-alt"></i> Gửi tin</button>
                        <button class="btn btn-secondary" data-action="delete" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG XÓA' onclick="actionOrder(this)"><i class="fas fa-trash-alt"></i> Xóa</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 mt-3 mt-sm-0 cards-container" id="card-container-2">
        <div class="card border-0 shadow-sm radius-0 mb-3" id="card-2" draggable="false" style="">
            <div class="card-header bgc-primary-d1">
                <h5 class="card-title text-white">
                    <i class="fa fa-table mr-2px"></i>
                    Quản lí đơn hàng - <?= $info['name']; ?> - <?= $infoFather['name']; ?>
                </h5>
            </div>

            <div class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="jzonTable1">
                        <thead>
                            <tr>
                                <th></th>
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
                                $order_query = mysqli_query($conn, "SELECT * FROM `order` WHERE `childSlug` = '".$info['slug']."' ORDER BY `id` DESC ");
                                while($order = mysqli_fetch_assoc($order_query)){ 
                                    $infoChild = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `slug` = '".$order['childSlug']."' "));
                                    $infoServer = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_server` WHERE `key` = '".$order['server']."' "));
                            ?>
                            <tr>
                                <td>
                                    <label>
                                        <input type="checkbox" data-code="<?= $order['code']; ?>" onclick="jzonOrder(this)" name="jzonhihi" class="mr-1">
                                    </label>
                                </td>
                                <td style="color: red; font-weight: bold;"><?= $order['code']; ?></td>
                                <td style="color: blue; font-weight: bold;"><?= $infoChild['name']; ?></td>
                                <td style="color: black; font-weight: bold;font-style: italic"><?= $infoServer['note']; ?></td>
                                <td style="color: black; font-weight: bold;"><?= $order['object_id']; ?></td>

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

                                <td style="color: red; font-weight: bold;"><?= number_format($order['amount']); ?></td>
                                <td style="color: orange; font-weight: bold;"><?= number_format($order['total_cash']); ?> VNĐ</td>
                                <td>
                                    <textarea class="form-control" rows="3" readonly=""><?= $order['note']; ?></textarea>
                                </td>
                                <td>
                                    <textarea class="form-control" rows="3" readonly=""><?= $order['admin_note']; ?></textarea>
                                </td>
                                <td style="color: brown; font-weight: bold;"><?= formatDate($order['created_time']); ?></td>
                                <td style="text-align: center;"><?= showStatusOrder($order['status']); ?></td>
                            </tr>
                            <?php } ?>
                        </tbody>
                    </table>
                </div>
            </div>
            <!-- /.card-body -->
        </div>
        <!-- /.card -->
    </div>
</div>
<script>
    $(function(){
        $("#jzonTable1").DataTable({
            "ordering": false
        })
    })

    let orderCode = ""
    let totalCode = 0

    function jzonOrder(data) {
        var code = $(data).attr('data-code')
        
        if($(data).is(':checked')) { 
            if(!orderCode.includes(code)) {
                orderCode += code + ","
                totalCode++
            }else{
                jzonAlert('Mã đơn này chưa được thêm vào danh sách', 'error')
            }
        } else {
            if(orderCode.includes(code)) {
                orderCode = orderCode.replace(code + ",", "")
                totalCode--
            }else{
                jzonAlert('Mã đơn này đã được thêm vào danh sách', 'error')
            }
        }

        if(totalCode > 0){
            $("#totalOrder").html(totalCode)
            $("#jzonAction").show()
        }else{
            $("#totalOrder").html(0)
            $("#jzonAction").hide()
        }

        console.log(orderCode + " - " + totalCode)

    }   
</script>
<?php 
		}else{
			die("Service not found");
			exit;
		}
	}else{
        die("Service not found");
		exit;
	}

    require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot_admin.php");
?>