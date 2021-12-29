<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Lịch sử nạp ví MOMO";

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
                    Lịch sử nạp ví MOMO
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
                                $momo_query = mysqli_query($conn, "SELECT * FROM `auto-momo` ORDER BY `id` DESC");
                                while($momo = mysqli_fetch_assoc($momo_query)){ 
                            ?>
                            <tr class="text-center">
                                <td><?= $jzon++; ?></td>
                                <td style="color: black;"><?= $momo['mode']; ?></td>
                                <td style="font-weight: bold; color: brown;"><?= $momo['username']; ?></td>
                                <td style="font-weight: bold; color: red;"><?= $momo['tranId']; ?></td>
                                <td style="font-weight: bold; color: blue;"><?= $momo['partnerId']; ?></td>
                                <td style="font-weight: bold; color: blue;"><?= $momo['partnerName']; ?></td>
                                <td style="font-weight: bold; color: green;"><?= number_format($momo['amount']); ?> VNĐ</td>
                                <td style="font-weight: bold; color: black;"><?= $momo['comment']; ?></td>
                                <td style="font-weight: bold; color: black;"><?= formatDate($momo['created_time']); ?></td>
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