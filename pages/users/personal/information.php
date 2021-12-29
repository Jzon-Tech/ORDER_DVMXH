<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	$title = "Thông tin tài khoản";

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
                <div class="profile card card-body px-3 pt-3 pb-0">
                    <div class="profile-head">
                        <div class="photo-content">
                            <div class="cover-photo rounded"></div>
                        </div>
                        <div class="profile-info">
                            <div class="profile-photo">
                                <img src="<?= avatarUser(); ?>" class="img-fluid rounded-circle" alt="">
                            </div>
                            <div class="profile-details">
                                <div class="profile-name px-3 pt-2">
                                    <h4 class="text-primary mb-0" style="font-weight: bold;"><?= $_SESSION['username']; ?></h4>
                                    <p>Số dư hiện tại: <b><?= number_format(infoMe('cash')); ?> VNĐ</b></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Thông tin tài khoản</h4>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Tên đăng nhập</label>
                                    <input class="form-control jzon" value="<?= $_SESSION['username']; ?>" readonly style="border-color: black!important;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Số tiền hiện tại</label>
                                    <input class="form-control jzon" value="<?= number_format(infoMe('cash')); ?> VNĐ" readonly style="border-color: black!important;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>IP Address</label>
                                    <input class="form-control jzon" value="<?= infoMe('ip'); ?>" readonly style="border-color: black!important;">
                                </div>
                            </div>
                            <div class="col-lg-6">
                                <div class="form-group">
                                    <label>Chức vụ</label>
                                    <input class="form-control jzon" value="<?= showTypeAccount(infoMe('level')); ?>" readonly style="border-color: black!important;">
                                </div>
                            </div>
                            <div class="col-lg-12">
                                <div class="form-group">
                                    <label>Thời gian tạo</label>
                                    <input class="form-control jzon" value="<?= formatDate(infoMe('created_time')); ?>" readonly style="border-color: black!important;">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-header">
                        <h4 class="card-title">Đổi mật khẩu</h4>
                    </div>
                    <div class="card-body">
                        <div class="form-group">
                            <label>Mật khẩu cũ</label>
                            <input type="password" class="form-control jzon" id="password" placeholder="**************" style="border-color: black!important;">
                        </div>
                        <div class="form-group">
                            <label>Mật khẩu mới</label>
                            <input type="password" class="form-control jzon" id="newPassword" placeholder="**************" style="border-color: black!important;">
                        </div>
                        <div class="form-group">
                            <label>Nhập lại mật khẩu mới</label>
                            <input type="password" class="form-control jzon" id="renewPassword" placeholder="**************" style="border-color: black!important;">
                        </div>
                        <div class="form-group">
                            <a class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG THAY ĐỔI MẬT KHẨU' onclick="changePassword(this)"><i class="fas fa-lock"></i> ĐỔI MẬT KHẨU</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
	</div>
</div>
<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot.php");
?>