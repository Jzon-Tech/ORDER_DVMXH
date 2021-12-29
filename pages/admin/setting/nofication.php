<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Cài đặt thông báo";

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
                <h4 class="card-title">Cài đặt thông báo</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="alert alert-danger">
                                - Hướng dẫn cách lấy Telegram Token & Chat ID => <a href="https://www.youtube.com/watch?v=TBoCKTAXE00" target="_blank">TẠI ĐÂY</a>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Telegram Token:</label>
                            <input class="form-control" id="tele_token" value="<?= setting('tele_token'); ?>">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Telegram Chat ID:</label>
                            <input class="form-control" id="tele_chatid" value="<?= setting('tele_chatid'); ?>">
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveNofication(this)">
                        <i class="fas fa-save"></i> LƯU THAY ĐỔI
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12" style="margin-top: 10px;">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Áp dụng thông báo</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="form-group">
                            <div class="alert alert-warning">
                                - Hệ thống sẽ gửi thông báo qua Telegram với những trang đã được tích áp dụng. <br>
                                - Những trường có dấu (<b style="color: red;">*</b>) là những trường khuyến khích bật.
                            </div>
                        </div>
                    </div>


                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Thành viên mới:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_new_member" class="ace-switch" <?php if(setting('nofication_new_member') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>



                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Thành viên đăng nhập:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_login_member" class="ace-switch" <?php if(setting('nofication_login_member') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>



                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Khi có người like bài viết:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_like_post" class="ace-switch" <?php if(setting('nofication_like_post') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>



                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Khi có người tạo đơn (<b style="color: red;">*</b>):</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_new_order" class="ace-switch" <?php if(setting('nofication_new_order') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>



                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Khi có người nạp thẻ cào thành công:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_success_card" class="ace-switch" <?php if(setting('nofication_success_card') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>



                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Khi có người nạp qua ví MOMO:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_momo" class="ace-switch" <?php if(setting('nofication_momo') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>



                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Khi có người nạp qua Zalo Pay:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_zalopay" class="ace-switch" <?php if(setting('nofication_zalopay') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>

                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Khi có người nạp qua Vietcombank:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_vcb" class="ace-switch" <?php if(setting('nofication_vcb') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>


                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Yêu cầu hỗ trợ mới (<b style="color: red;">*</b>):</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_new_support" class="ace-switch" <?php if(setting('nofication_new_support') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>



                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Khi thành viên trả lời hỗ trợ (<b style="color: red;">*</b>):</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_reply_support" class="ace-switch" <?php if(setting('nofication_reply_support') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>



                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Thao tác (HỖ TRỢ) thành viên:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_action_support" class="ace-switch" <?php if(setting('nofication_action_support') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>



                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Khi thành viên thay đổi MK:</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_changepass_member" class="ace-switch" <?php if(setting('nofication_changepass_member') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>



                    <div class="col-6 text-right">
                        <div class="form-group">
                            <label>Phát hiện BOT (<b style="color: red;">*</b>):</label>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="form-group">
                            <input type="checkbox" id="nofication_detect_bot" class="ace-switch" <?php if(setting('nofication_detect_bot') == 'yes') { echo 'checked'; } ?>>
                        </div>
                    </div>


                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveJzonNofication(this)">
                        <i class="fas fa-save"></i> LƯU THAY ĐỔI
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot_admin.php");
    
?>