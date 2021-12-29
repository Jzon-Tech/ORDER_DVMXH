<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Lịch sử nạp thẻ cào tự động";

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
                    Lịch sử nạp thẻ cào tự động
                </h5>
            </div>

            <div class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0">
                <div class="table-responsive">
                    <table id="jzonTable1" class="table table-bordered table-striped">
                        <thead class="text-center">
                            <tr>
                                <th>STT</th>
                                <th>User</th>
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
                                $card_query = mysqli_query($conn, "SELECT * FROM `auto-card` ORDER BY `id` DESC");
                                while($card = mysqli_fetch_assoc($card_query)){ 
                            ?>
                            <tr class="text-center">
                                <td><?= $jzon++; ?></td>
                                <td style="font-weight: bold; color: brown;"><?= $card['username']; ?></td>
                                <td style="font-weight: bold; color: black;"><?= $card['telco']; ?></td>
                                <td style="font-weight: bold; color: blue;"><?= number_format($card['amount_origin']); ?>đ</td>
                                <td style="font-weight: bold; color: red;"><?= number_format($card['amount_recieve']); ?>đ</td>
                                <td style="font-weight: bold; color: green;"><?= $card['pin']; ?></td>
                                <td style="font-weight: bold; color: green;"><?= $card['serial']; ?></td>
                                <td style="font-weight: bold; color: black;"><?= formatDate($card['created_time']); ?></td>
                                <td><?= showStatusCard($card['status']); ?></td>
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