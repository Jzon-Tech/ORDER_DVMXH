<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Thêm vấn đề hỗ trợ";

    require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/sidebar_admin.php");

    if(!isset($_SESSION['admin'])){
        header("Location: /admin/login");
        exit;
    }
?>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thêm vấn đề hỗ trợ</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Loại hỗ trợ:</label>
                    <input class="form-control" id="prob_name" placeholder="Ex: Nạp tiền, Dịch vụ,...">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG THÊM VẤN ĐỀ HỖ TRỢ' onclick="addSupportProblem(this)"><i class="fas fa-plus"></i> THÊM NGAY</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 mt-3 mt-sm-0 cards-container" id="card-container-2">
        <div class="card border-0 shadow-sm radius-0 mb-3" id="card-2" draggable="false">
            <div class="card-header bgc-primary-d1">
                <h5 class="card-title text-white">
                    <i class="fa fa-table mr-2px"></i>
                    Danh sách vấn đề hỗ trợ đã thêm
                </h5>
            </div>

            <div class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="jzonTable1">
                        <thead class="text-dark-l2 text-95">
                            <tr>
                                <th>STT</th>
                                <th>Tên vấn đề</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $jzon = 0;
                                $sg_query = mysqli_query($conn, "SELECT * FROM `support_problem` ORDER BY `id` DESC");
                                while($sg = mysqli_fetch_assoc($sg_query)){ 
                            ?>
                            <tr id="sg_<?= $sg['id']; ?>">
                                <td class="text-dark-m2"><?= $jzon++; ?></td>
                                <td class="text-dark-m2" style="font-weight: bold;"><?= $sg['name']; ?></td>
                                <td class="text-dark-m2">
                                    <button class="btn btn-danger" data-loading='<i class="fas fa-spinner fa-pulse"></i>' data-id="<?= $sg['id']; ?>" onclick="deleteSupportProblem(this)"><i class="fas fa-trash-alt"></i></button>
                                </td>
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