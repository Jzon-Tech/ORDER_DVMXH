<?php 
    $admin_page = true;


    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Quản lí thành viên";

    require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/sidebar_admin.php");

    if(!isset($_SESSION['admin'])){
        header("Location: /admin/login");
        exit;
    }
?>
<div class="modal fade" id="editAccountModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">
                    Chỉnh sửa thành viên
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="jzon_id">
                <div class="form-group">
                    <label>Tên đăng nhập:</label>
                    <input class="form-control" id="jzon_username">
                </div>
                <div class="form-group">
                    <label>Số dư HT:</label>
                    <input class="form-control" id="jzon_cash">
                </div>
                <div class="form-group">
                    <label>Chức vụ</label>
                    <select class="form-control" id="jzon_level">
                        <option value="" id="jzon_level_now"></option>
                        <option value="member">Khách hàng</option>
                        <option value="ctv">Cộng tác viên</option>
                        <option value="agency">Đại lý</option>
                        <option value="admin">Quản trị viên</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Khóa tài khoản (Set <b style="color: red;">1</b> để khóa, set <b style="color: red;">0</b> để trở về bình thường)</label>
                    <input class="form-control" id="jzon_banned">
                </div>
                <hr>
                <div class="form-group">
                    <label>Cộng tiền nhanh:</label>
                    <div class="input-group input-group-fade">
                        <input type="number" class="form-control" id="jzon_cash_plus">
                        <div class="input-group-append">
                            <button class="btn btn-success btn-bold" type="button" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG CỘNG TIỀN' onclick="plusCashUser(this)">CỘNG TIỀN</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label>Trừ tiền nhanh:</label>
                    <div class="input-group input-group-fade">
                        <input type="number" class="form-control" id="jzon_cash_minus">
                        <div class="input-group-append">
                            <button class="btn btn-danger btn-bold" type="button" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG TRỪ TIỀN' onclick="minusCashUser(this)">TRỪ TIỀN</button>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveUser(this)" ><i class="fas fa-save"></i> LƯU THAY ĐỔI</button>
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
    <div class="col-12 col-sm-12 mt-3 mt-sm-0 cards-container" id="card-container-2">
        <div class="card border-0 shadow-sm radius-0 mb-3" id="card-2" draggable="false" style="">
            <div class="card-header bgc-primary-d1">
                <h5 class="card-title text-white">
                    <i class="fa fa-table mr-2px"></i>
                    Quản lí thành viên
                </h5>
            </div>

            <div class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="jzonTable1">
                        <thead class="text-dark-l2 text-95">
                            <tr>
                                <th>UID</th>
                                <th>Username</th>
                                <th>Số dư HT</th>
                                <th>Tổng nạp</th>
                                <th>Tổng tiêu</th>
                                <th>IP Address</th>
                                <th>Chức vụ</th>
                                <th>Trạng thái</th>
                                <th>Ngày tạo</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $user_query = mysqli_query($conn, "SELECT * FROM `users` ORDER BY `id` DESC");
                                while($user = mysqli_fetch_assoc($user_query)){ 
                            ?>
                            <tr id="user_<?= $user['id']; ?>">
                                <td class="text-dark-m2"><?= $user['id']; ?></td>
                                <td class="text-dark-m2" style="font-weight: bold; font-style: italic;"><?= $user['username']; ?></td>
                                <td class="text-dark-m2" style="font-weight: bold; color: red!important;"><?= number_format($user['cash']); ?> VNĐ</td>
                                <td class="text-dark-m2" style="font-weight: bold; color: blue!important;"><?= number_format($user['total_cash']); ?> VNĐ</td>
                                <td class="text-dark-m2" style="font-weight: bold; color: green!important;"><?= number_format($user['used_cash']); ?> VNĐ</td>
                                <td class="text-dark-m2" style="font-weight: bold;"><?= $user['ip']; ?></td>
                                <td class="text-dark-m2" style="font-weight: bold; color: brown!important;"><?= showTypeAccount($user['level']); ?></td>
                                <?php if($user['banned'] == 1){ ?>
                                <td>
                                    <span class="badge badge-danger">
                                        Đã khóa
                                    </span>
                                </td>
                                <?php }else{ ?>
                                <td>
                                    <span class="badge badge-success">
                                        Hoạt động
                                    </span>
                                </td>
                                <?php } ?>
                                <td class="text-dark-m2" style="font-weight: bold;"><?= formatDate($user['created_time']); ?></td>
                                <td class="text-dark-m2">
                                    <button class="btn btn-info" data-loading='<i class="fas fa-spinner fa-pulse"></i>' data-id="<?= $user['id']; ?>" onclick="showUserModal(this)"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger" data-loading='<i class="fas fa-spinner fa-pulse"></i>' data-id="<?= $user['id']; ?>" onclick="deleteUser(this)"><i class="fas fa-trash-alt"></i></button>
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
    $(function() {
        $("#jzonTable1").DataTable({
            'ordering': false
        })
    })
</script>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot_admin.php");
    
?>