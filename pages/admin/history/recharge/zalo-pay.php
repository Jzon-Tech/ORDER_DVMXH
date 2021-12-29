<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Lịch sử nạp ví Zalo Pay";

    require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/sidebar_admin.php");

    if(!isset($_SESSION['admin'])){
        header("Location: /admin/login");
        exit;
    }
?>
<div class="row">
    <div class="col-12 col-sm-12 mt-3 mt-sm-0 cards-container" id="card-container-2">
        <div class="card border-0 shadow-sm radius-0 mb-3" id="card-2" draggable="false" style="">
            <div class="card-header bgc-primary-d1">
                <h5 class="card-title text-white">
                    <i class="fa fa-table mr-2px"></i>
                    Lịch sử nạp ví Zalo Pay
                </h5>
            </div>

            <div class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0">
                <div class="table-responsive">
                    <table id="jzonTable1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th>STT</th>
                                <th>Chế độ</th>
                                <th>User</th>
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
                                $zalo_pay_query = mysqli_query($conn, "SELECT * FROM `auto-zalo-pay` ORDER BY `id` DESC");
                                while($zalo_pay = mysqli_fetch_assoc($zalo_pay_query)){ 
                            ?>
                            <tr class="text-center">
                                <td><?= $jzon++; ?></td>
                                <td style="color: black;"><?= $zalo_pay['mode']; ?></td>
                                <td style="font-weight: bold; color: brown;"><?= $zalo_pay['username']; ?></td>
                                <td style="font-weight: bold; color: red;"><?= $zalo_pay['transid']; ?></td>
                                <td style="font-weight: bold; color: blue;"><?= $zalo_pay['owner']; ?></td>
                                <td style="font-weight: bold; color: green;"><?= number_format($zalo_pay['amount']); ?> VNĐ</td>
                                <td style="font-weight: bold; color: black;"><?= $zalo_pay['comment']; ?></td>
                                <td style="font-weight: bold; color: black;"><?= formatDate($zalo_pay['created_time']); ?></td>
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
        $("#jzonTable1").DataTable()
    })
</script>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot_admin.php");
    
?>