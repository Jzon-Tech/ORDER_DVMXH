<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Cài đặt trang đích";

    require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/sidebar_admin.php");

    if(!isset($_SESSION['admin'])){
        header("Location: /admin/login");
        exit;
    }
?>
<div class="row">
    <div class="col-lg-12" style="margin-bottom: 10px;">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title"><?= $title; ?></h4>
            </div>
            <div class="card-body">

                <div class="row">
                    <div class="col-lg-3">
                        <label>Mô tả dịch vụ (<b style="color: red;">Hiển thị ở đầu trang đích</b>):</label>
                    </div>
                    <div class="col-lg-9">
                        <input class="form-control" id="landing_describe" placeholder="Nhập mô tả dịch vụ" value="<?= setting('landing_describe'); ?>">
                    </div>
                </div>

                <div class="row" style="margin-top: 10px;">
                    <div class="col-lg-3">
                        <label>Chọn trang đích có sẵn:</label>
                    </div>
                    <div class="col-lg-9">
                        <select class="form-control" id="landing_page" onchange="showDemoLandingPage(this)">
                            <option value="" <?php if(setting('landing_page') == '') {echo 'selected'; } ?>>Không hiển thị trang đích</option>
                            <option value="landing_1" <?php if(setting('landing_page') == 'landing_1') {echo 'selected'; } ?>>Mẫu 1</option>
                            <option value="landing_2" <?php if(setting('landing_page') == 'landing_2') {echo 'selected'; } ?>>Mẫu 2</option>
                            <option value="landing_3" <?php if(setting('landing_page') == 'landing_3') {echo 'selected'; } ?>>Mẫu 3</option>
                            <option value="landing_4" <?php if(setting('landing_page') == 'landing_4') {echo 'selected'; } ?>>Mẫu 4</option>
                            <option value="landing_5" <?php if(setting('landing_page') == 'landing_5') {echo 'selected'; } ?>>Mẫu 5</option>
                            <option value="landing_6" <?php if(setting('landing_page') == 'landing_6') {echo 'selected'; } ?>>Mẫu 6</option>
                        </select>
                    </div>
                </div>
                

                <?php
                    if(setting('landing_page') == '') {
                        echo 'display: none;';
                    }
                ?>

                <div class="row" style="margin-top: 10px; <?php if(setting('landing_page') == '') { echo 'display: none;'; } ?>" id="demo">
                    <div class="col-lg-3">
                        <label>Hình ảnh mẫu:</label>
                    </div>
                    <div class="col-lg-9">
                        <a class="jzon_demo" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/demo/landing_1.jpg" target="_blank" id="demo_landing_1" style="<?php if(setting('landing_page') != 'landing_1') { echo 'display: none;'; } ?>">
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/demo/landing_1.jpg" width="70%">
                        </a>
                        <a class="jzon_demo" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/demo/landing_2.jpg" target="_blank" id="demo_landing_2" style="<?php if(setting('landing_page') != 'landing_2') { echo 'display: none;'; } ?>">
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/demo/landing_2.jpg" width="70%">
                        </a>
                        <a class="jzon_demo" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/demo/landing_3.jpg" target="_blank" id="demo_landing_3" style="<?php if(setting('landing_page') != 'landing_3') { echo 'display: none;'; } ?>">
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/demo/landing_3.jpg" width="70%">
                        </a>
                        <a class="jzon_demo" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/demo/landing_4.jpg" target="_blank" id="demo_landing_4" style="<?php if(setting('landing_page') != 'landing_4') { echo 'display: none;'; } ?>">
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/demo/landing_4.jpg" width="70%">
                        </a>
                        <a class="jzon_demo" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/demo/landing_5.jpg" target="_blank" id="demo_landing_5" style="<?php if(setting('landing_page') != 'landing_5') { echo 'display: none;'; } ?>">
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/demo/landing_5.jpg" width="70%">
                        </a>
                        <a class="jzon_demo" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/demo/landing_6.jpg" target="_blank" id="demo_landing_6" style="<?php if(setting('landing_page') != 'landing_6') { echo 'display: none;'; } ?>">
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/demo/landing_6.jpg" width="70%">
                        </a>
                    </div>
                </div>


                <div class="form-group" style="margin-top: 20px;">
                    <button class="btn btn-primary btn-block" data-type="landing_page" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveSetting(this)" >
                        <i class="fas fa-save"></i> LƯU THAY ĐỔI
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function showDemoLandingPage(data){
        var page = $(data).val()

        if(page == ''){
            $("#demo").hide()
        }else{
            $("#demo").show()
            $(".jzon_demo").hide()
            $("#demo_" + page).show()
        }
        
    }
</script>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot_admin.php");
    
?>