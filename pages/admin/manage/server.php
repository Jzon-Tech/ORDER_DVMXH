<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Máy chủ";

    require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/sidebar_admin.php");

    if(!isset($_SESSION['admin'])){
        header("Location: /admin/login");
        exit;
    }
?>
<div class="modal fade" id="editServerModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">
                    Chỉnh sửa máy chủ
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="jzon_key">
                <div class="form-group">
                    <label>Ghi chú:</label>
                    <input class="form-control" id="jzon_note">
                </div>
                <div class="form-group">
                    <label>Giá tiền:</label>
                    <input class="form-control" type="number" id="jzon_price">
                </div>
                <div class="form-group">
                    <label>Tối đa đơn hàng:</label>
                    <input class="form-control" type="number" id="jzon_max_order">
                </div>
                <div class="form-group">
                    <label>Chế độ hiển thị:</label>
                    <select class="form-control" id="jzon_display">
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveServer(this)" ><i class="fas fa-save"></i> LƯU THAY ĐỔI</button>
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
    <div class="col-lg-12" style="margin-bottom: 10px;">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thêm máy chủ</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Chọn dịch vụ cha:</label>
                    <div class="tag-input-style" id="select2-parent">
                        <select id="service" name="service" class="select2 form-control " data-placeholder="Click để chọn dịch vụ cha..." onchange="showMoreServiceChild()">
                            <option value=""></option>
                            <?php 
                                $service_query = mysqli_query($conn, "SELECT * FROM `list_service` ");
                                while($service = mysqli_fetch_assoc($service_query)){
                            ?>
                            <option value="<?= $service['key']; ?>"><?= $service['name']; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Chọn dịch vụ con:</label>
                    <div class="tag-input-style" id="select2-parent">
                        <select id="serviceChild" name="serviceChild" class="select1 form-control " data-placeholder="Click để chọn dịch vụ con...">
                            
                        </select>
                    </div>
                </div>
                <div class="form-group">
                    <label>Ghi chú:</label>
                    <input class="form-control" id="note" placeholder="ex: Like người việt thật">
                </div>
                <div class="form-group">
                    <label>Giá tiền:</label>
                    <input class="form-control" type="number" id="price" placeholder="Nhập giá tiền">
                </div>
                <div class="form-group">
                    <label>Tối đa đơn hàng:</label>
                    <input class="form-control" type="number" id="max_order" placeholder="Nhập tối đa đơn hàng">
                    <span class='text-muted' style="font-style: italic;">Hệ thống sẽ tự động thông báo quá tải ở server này khi đạt đến ngưỡng đơn hàng tối đa! (<b style="color: red;">Chỉ áp dụng cho những đơn ĐANG CHẠY</b>)</span>
                </div>
                <div class="form-group">
                    <label>Chế độ hiển thị:</label>
                    <select class="form-control" id="display">
                        <option value="show">🟢 HIỆN</option>
                        <option value="hide">🔴 ẨN</option>
                    </select>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG THÊM TIN NHẮN' onclick="addServer(this)"><i class="fas fa-plus"></i> THÊM NGAY</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 mt-3 mt-sm-0 cards-container" id="card-container-2">
        <div class="card border-0 shadow-sm radius-0 mb-3" id="card-2" draggable="false">
            <div class="card-header bgc-primary-d1">
                <h5 class="card-title text-white">
                    <i class="fa fa-table mr-2px"></i>
                    Danh sách máy chủ
                </h5>
            </div>

            <div class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="jzonTable1">
                        <thead class="text-dark-l2 text-95">
                            <tr>
                                <th>STT</th>
                                <th>Dịch vụ cha</th>
                                <th>Dịch vụ con</th>
                                <th>Ghi chú</th>
                                <th>Giá tiền</th>
                                <th>Tối đa đơn hàng</th>
                                <th>Chế độ</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $jzon = 0;
                                $sv_query = mysqli_query($conn, "SELECT * FROM `list_server` ORDER BY `id` DESC");
                                while($sv = mysqli_fetch_assoc($sv_query)){ 
                                    $get = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `slug` = '".$sv['slug']."' LIMIT 1 "));
                                    $nameChild = $get['name'];
                                    $nameFather = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service` WHERE `key` = '".$get['father']."' "))['name'];
                            ?>
                            <tr id="sv_<?= $sv['id']; ?>">
                                <td class="text-dark-m2"><?= $jzon++; ?></td>
                                <td class="text-dark-m2" style="font-weight: bold; color: green!important;"><?= $nameFather; ?></td>
                                <td class="text-dark-m2" style="font-weight: bold; color: blue!important;"><?= $nameChild; ?></td>
                                <td class="text-dark-m2"><?= $sv['note']; ?></td>
                                <td class="text-dark-m2"><?= number_format($sv['price']); ?> VNĐ</td>
                                <td class="text-dark-m2"><?= $sv['max_order']; ?></td>
                                <td class="text-dark-m2"><?= showStatusServer($sv['display']); ?></td>
                                <td class="text-dark-m2">
                                    <button class="btn btn-info" data-loading='<i class="fas fa-spinner fa-pulse"></i>' data-id="<?= $sv['id']; ?>" onclick="infoServer(this)"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger" data-loading='<i class="fas fa-spinner fa-pulse"></i>' data-id="<?= $sv['id']; ?>" onclick="deleteServer(this)"><i class="fas fa-trash-alt"></i></button>
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
        $('.select2').select2({
          allowClear: true,
          dropdownParent: $('#select2-parent'),
        })
        $('.select1').select2({
          allowClear: true,
          dropdownParent: $('#select2-parent'),
        })
    })
</script>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot_admin.php");
    
?>