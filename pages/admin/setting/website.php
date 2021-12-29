<?php 

    $admin_page = true;

    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Cài đặt trang web";
    
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/sidebar_admin.php");

    if(!isset($_SESSION['admin'])){
        header("Location: /admin/login");
        exit;
    }
?>
<div class="modal fade" id="modalGenPass">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Trình mã hóa mật khẩu</h5>
            </div>
            <div class="modal-body">
                <div class="form-group">
                    <label>Nhập mật khẩu cần mã hóa:</label>
                    <input class="form-control" id="password_en" placeholder="Mật khẩu cần mã hóa">
                </div>
                <div class="form-group result" style="display: none;">
                    <label>Kết quả (<b style="color: green;">click để copy</b>):</label>
                    <input style="border-color: green;" class="form-control" id="password_result" readonly>
                    <span class="text-danger">Sử dụng đoạn mã hóa này để thay thế vào mật khẩu admin.</span>
                </div>
                <div class="form-group">
                    <button class="btn btn-success" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG MÃ HÓA' onclick="encodePassword(this)">
                        <i class="fas fa-code"></i> Mã hóa ngay
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="row">
    <div class="col-lg-12" style="margin-bottom: 10px;">
        <div class="card">
            <div class="card-header">
                <div class="card-title">
                    <div class="row" style="width: 100%">
                        <div class="col-10 text-left">
                            <span style="font-weight: 400; font-size: 1.5rem; margin-bottom: .5rem; line-height: 1.2; margin-top: 0;">
                                <?= $title; ?>
                            </span>
                        </div>
                        
                        <div class="col-2 text-right">
                            <button class="btn btn-danger btn-sm power-off" data-mode="on" onclick="maintenanceMode(this)" data-loading='<i class="fas fa-spinner fa-pulse"></i>' id="jzon1" style="<?php if(setting('maintenance_mode') != 'off') { echo 'display: none;'; } ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Bảo trì website">
                                <i class="fas fa-power-off"></i>
                            </button>

                            <button class="btn btn-success btn-sm power-on" data-mode="off" onclick="maintenanceMode(this)" data-loading='<i class="fas fa-spinner fa-pulse"></i>' id="jzon2" style="<?php if(setting('maintenance_mode') != 'on') { echo 'display: none;'; } ?>" data-toggle="tooltip" data-placement="top" title="" data-original-title="Bật website">
                                <i class="fas fa-power-off"></i>
                            </button>
                        </div>
                        <script>
                            $(function(){
                                $('#jzon1').tooltip({ trigger: "hover" })
                                $('#jzon2').tooltip({ trigger: "hover" })
                            })
                        </script>
                    </div>
                </div>
            </div>
            
            <div class="card-body">
                <div class="form-group">
                    <label>Mật khẩu admin (<a href="#" onclick='$("#modalGenPass").modal("show")'>MÃ HÓA TẠI ĐÂY</a>):</label>
                    <input class="form-control" value="<?= setting('password_admin'); ?>" id="password_admin">
                </div>
                <hr>
                <div class="form-group">
                    <label>Tên website:</label>
                    <input class="form-control" value="<?= setting('website_name'); ?>" id="website_name">
                </div>
                <div class="form-group">
                    <label>Từ khóa:</label>
                    <input class="form-control" value="<?= setting('keyword'); ?>" id="keyword">
                </div>
                <div class="form-group">
                    <label>Mô tả:</label>
                    <input class="form-control" value="<?= setting('description'); ?>" id="description">
                </div>
                <div class="form-group">
                    <label>Og Image (<b style="color: red;">thumbnail hiển thị mỗi khi bạn gửi link qua mxh</b>):</label>
                    <input class="form-control" value="<?= setting('og_image'); ?>" id="og_image">
                </div>
                <div class="form-group">
                    <label>Favicon:</label>
                    <input class="form-control" value="<?= setting('favicon'); ?>" id="favicon">
                </div>
                <div class="form-group">
                    <label>Logo website:</label>
                    <input class="form-control" value="<?= setting('logo'); ?>" id="logo">
                </div>
                <div class="form-group">
                    <label>Thông báo website:</label>
                    <textarea id="nofication" name="nofication"><?= setting('nofication'); ?></textarea>
                </div>
                <hr>
                <div class="form-group">
                    <label>Chiết khấu thành viên:</label>
                    <input class="form-control" value="<?= setting('discount_member'); ?>" id="discount_member">
                </div>
                <div class="form-group">
                    <label>Chiết khấu cộng tác viên:</label>
                    <input class="form-control" value="<?= setting('discount_ctv'); ?>" id="discount_ctv">
                </div>
                <div class="form-group">
                    <label>Chiết khấu đại lí:</label>
                    <input class="form-control" value="<?= setting('discount_agency'); ?>" id="discount_agency">
                </div>
                <hr>
                <div class="form-group">
                    <label>Chế độ màu (DARK/LIGHT MODE):</label>
                    <select class="form-control" id="theme_mode">
                        <option value="light" <?php if(setting('theme_mode') == 'light') {echo 'selected'; } ?>>⚪ Chế độ sáng (LIGHT MODE)</option>
                        <option value="dark" <?php if(setting('theme_mode') == 'dark') {echo 'selected'; } ?>>⚫ Chế độ tối (DARK MODE)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Màu tiêu đề (HEADER):</label>
                    <select class="form-control" id="color_header">
                        <option value="color_1" <?php if(setting('color_header') == 'color_1') {echo 'selected'; } ?>>KHÔNG MÀU</option>
                        <option value="color_2" <?php if(setting('color_header') == 'color_2') {echo 'selected'; } ?>>🟣 Màu tím</option>
                        <option value="color_3" <?php if(setting('color_header') == 'color_3') {echo 'selected'; } ?>>🔵 Màu xanh</option>
                        <option value="color_4" <?php if(setting('color_header') == 'color_4') {echo 'selected'; } ?>>🟪 Màu tím đậm</option>
                        <option value="color_5" <?php if(setting('color_header') == 'color_5') {echo 'selected'; } ?>>🔴 Màu đỏ</option>
                        <option value="color_6" <?php if(setting('color_header') == 'color_6') {echo 'selected'; } ?>>🟠 Màu cam</option>
                        <option value="color_7" <?php if(setting('color_header') == 'color_7') {echo 'selected'; } ?>>🟡 Màu vàng</option>
                        <option value="color_8" <?php if(setting('color_header') == 'color_8') {echo 'selected'; } ?>>⚪ Màu trắng</option>
                        <option value="color_9" <?php if(setting('color_header') == 'color_9') {echo 'selected'; } ?>>🟢 Màu xanh lá nhạt</option>
                        <option value="color_15" <?php if(setting('color_header') == 'color_9') {echo 'selected'; } ?>>🟢 Màu xanh lá đậm</option>
                        <option value="color_10" <?php if(setting('color_header') == 'color_10') {echo 'selected'; } ?>>🟦 Màu xanh lá cây biển nhạt</option>
                        <option value="color_12" <?php if(setting('color_header') == 'color_12') {echo 'selected'; } ?>>⚫ Màu đen</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Màu danh mục sản phẩm (NAVBAR):</label>
                    <select class="form-control" id="color_navbar">
                        <option value="color_1" <?php if(setting('color_navbar') == 'color_1') {echo 'selected'; } ?>>KHÔNG MÀU</option>
                        <option value="color_2" <?php if(setting('color_navbar') == 'color_2') {echo 'selected'; } ?>>🟣 Màu tím</option>
                        <option value="color_3" <?php if(setting('color_navbar') == 'color_3') {echo 'selected'; } ?>>🔵 Màu xanh</option>
                        <option value="color_4" <?php if(setting('color_navbar') == 'color_4') {echo 'selected'; } ?>>🟪 Màu tím đậm</option>
                        <option value="color_5" <?php if(setting('color_navbar') == 'color_5') {echo 'selected'; } ?>>🔴 Màu đỏ</option>
                        <option value="color_6" <?php if(setting('color_navbar') == 'color_6') {echo 'selected'; } ?>>🟠 Màu cam</option>
                        <option value="color_7" <?php if(setting('color_navbar') == 'color_7') {echo 'selected'; } ?>>🟡 Màu vàng</option>
                        <option value="color_8" <?php if(setting('color_navbar') == 'color_8') {echo 'selected'; } ?>>⚪ Màu trắng</option>
                        <option value="color_9" <?php if(setting('color_navbar') == 'color_9') {echo 'selected'; } ?>>🟢 Màu xanh lá nhạt</option>
                        <option value="color_15" <?php if(setting('color_navbar') == 'color_9') {echo 'selected'; } ?>>🟢 Màu xanh lá đậm</option>
                        <option value="color_10" <?php if(setting('color_navbar') == 'color_10') {echo 'selected'; } ?>>🟦 Màu xanh lá cây biển nhạt</option>
                        <option value="color_12" <?php if(setting('color_navbar') == 'color_12') {echo 'selected'; } ?>>⚫ Màu đen</option>
                    </select>
                </div>
                
                <div class="form-group">
                    <label>Màu nền logo (LOGO):</label>
                    <select class="form-control" id="color_logo">
                        <option value="color_1" <?php if(setting('color_logo') == 'color_1') {echo 'selected'; } ?>>KHÔNG MÀU</option>
                        <option value="color_2" <?php if(setting('color_logo') == 'color_2') {echo 'selected'; } ?>>🟣 Màu tím</option>
                        <option value="color_3" <?php if(setting('color_logo') == 'color_3') {echo 'selected'; } ?>>🔵 Màu xanh</option>
                        <option value="color_4" <?php if(setting('color_logo') == 'color_4') {echo 'selected'; } ?>>🟪 Màu tím đậm</option>
                        <option value="color_5" <?php if(setting('color_logo') == 'color_5') {echo 'selected'; } ?>>🔴 Màu đỏ</option>
                        <option value="color_6" <?php if(setting('color_logo') == 'color_6') {echo 'selected'; } ?>>🟠 Màu cam</option>
                        <option value="color_7" <?php if(setting('color_logo') == 'color_7') {echo 'selected'; } ?>>🟡 Màu vàng</option>
                        <option value="color_8" <?php if(setting('color_logo') == 'color_8') {echo 'selected'; } ?>>⚪ Màu trắng</option>
                        <option value="color_9" <?php if(setting('color_logo') == 'color_9') {echo 'selected'; } ?>>🟢 Màu xanh lá nhạt</option>
                        <option value="color_15" <?php if(setting('color_logo') == 'color_9') {echo 'selected'; } ?>>🟢 Màu xanh lá đậm</option>
                        <option value="color_10" <?php if(setting('color_logo') == 'color_10') {echo 'selected'; } ?>>🟦 Màu xanh lá cây biển nhạt</option>
                        <option value="color_12" <?php if(setting('color_logo') == 'color_12') {echo 'selected'; } ?>>⚫ Màu đen</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Plugin JS:</label>
                    <textarea id="plugin_js" rows="10" cols="50" class="form-control" style="background-color: #222222;color: #e5b567;"><?= setting('plugin_js'); ?></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-type="website" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveSetting(this)" >
                        <i class="fas fa-save"></i> LƯU THAY ĐỔI
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    $(function(){
        $.extend($.summernote.options.icons, {
            align: "fa fa-align",
            alignCenter: "fa fa-align-center",
            alignJustify: "fa fa-align-justify",
            alignLeft: "fa fa-align-left",
            alignRight: "fa fa-align-right",
            indent: "fa fa-indent",
            outdent: "fa fa-outdent",
            arrowsAlt: "fa fa-arrows-alt",
            bold: "fa fa-bold",
            caret: "fa fa-caret-down text-grey-m2 ml-1",
            circle: "fa fa-circle",
            close: "fa fa fa-close",
            code: "fa fa-code",
            eraser: "fa fa-eraser",
            font: "fa fa-font",
            italic: "fa fa-italic",
            link: "fa fa-link text-success-m1",
            unlink: "fas fa-unlink",
            magic: "fa fa-magic text-brown-m1",
            menuCheck: "fa fa-check",
            minus: "fa fa-minus",
            orderedlist: "fa fa-list-ol text-blue",
            pencil: "fa fa-pencil",
            picture: "far fa-image text-purple-d1",
            question: "fa fa-question",
            redo: "fa fa-repeat",
            square: "fa fa-square",
            strikethrough: "fa fa-strikethrough",
            subscript: "fa fa-subscript",
            superscript: "fa fa-superscript",
            table: "fa fa-table text-danger-m2",
            textHeight: "fa fa-text-height",
            trash: "fa fa-trash",
            underline: "fa fa-underline",
            undo: "fa fa-undo",
            unorderedlist: "fa fa-list-ul text-blue",
            video: "far fa-file-video text-pink-m1",
        });

        $("#nofication").summernote({
            height: 250,
            minHeight: 150,
            maxHeight: 400,
        });
    })

</script>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot_admin.php");
    
?>