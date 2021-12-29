<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Quản lí dịch vụ";

    require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/sidebar_admin.php");

    if(!isset($_SESSION['admin'])){
        header("Location: /admin/login");
        exit;
    }
?>
<div class="modal fade" id="editService_modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">
                    Chỉnh sửa dịch vụ
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="jzon_key">
                <div class="form-group">
                    <label>Tên dịch vụ:</label>
                    <input class="form-control" id="jzon_name">
                </div>
                <div class="form-group">
                    <label>Font icon (<a href="https://fontawesome.com/v5.15/icons?d=" target="_blank">Fontawesome</a>):</label>
                    <input class="form-control" id="jzon_icon">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveService(this)" ><i class="fas fa-save"></i> LƯU THAY ĐỔI</button>
                </div>
            </div>

            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">
                    Đóng
                </button>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thêm dịch vụ</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Tên dịch vụ:</label>
                    <input class="form-control" id="name" placeholder="ex: Facebook Buff">
                </div>
                <div class="form-group">
                    <label>Font icon (<a href="https://fontawesome.com/v5.15/icons?d=" target="_blank">Fontawesome</a>):</label>
                    <input class="form-control" id="icon" placeholder="ex: fas fa-air-freshener (chỉ lấy bên trong class, không lấy cả tag)">
                </div>
                <div class="form-group">
                    <button class="btn btn-success" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG THÊM DỊCH VỤ' onclick="addService(this)"><i class="fas fa-plus"></i> THÊM NGAY</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 mt-3 mt-sm-0 cards-container" id="card-container-2">
        <div class="card border-0 shadow-sm radius-0 mb-3" id="card-2" draggable="false" style="">
            <div class="card-header bgc-primary-d1">
                <h5 class="card-title text-white">
                    <i class="fa fa-table mr-2px"></i>
                    Danh sách dịch vụ
                </h5>
            </div>

            <div class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="jzonTable1">
                        <thead class="text-dark-l2 text-95">
                            <tr>
                                <th>STT</th>
                                <th>Tên dịch vụ</th>
                                <th>Icon</th>
                                <th>Dịch vụ con</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $jzon = 0;
                                $service_query = mysqli_query($conn, "SELECT * FROM `list_service` ORDER BY `id` DESC");
                                while($service = mysqli_fetch_assoc($service_query)){ 
                            ?>
                            <tr id="service_<?= $service['id']; ?>">
                                <td class="text-dark-m2"><?= $jzon++; ?></td>
                                <td class="text-dark-m2" style="font-weight: bold;"><?= $service['name']; ?></td>
                                <td class="text-dark-m2"><?= $service['icon']; ?></td>
                                <td class="text-dark-m2" style="font-weight: bold; color: red!important;"><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `father` = '".$service['key']."' ")); ?></td>
                                <td class="text-dark-m2">
                                    <button class="btn btn-info" data-loading='<i class="fas fa-spinner fa-pulse"></i>' data-id="<?= $service['id']; ?>" onclick="infoService(this)"><i class="fas fa-pen"></i></button>
                                    <button class="btn btn-danger" data-loading='<i class="fas fa-spinner fa-pulse"></i>' data-id="<?= $service['id']; ?>" onclick="deleteService(this)"><i class="fas fa-trash-alt"></i></button>
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