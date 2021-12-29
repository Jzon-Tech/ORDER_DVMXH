<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Quản lí yêu cầu hỗ trợ";

    require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/sidebar_admin.php");

    if(!isset($_SESSION['admin'])){
        header("Location: /admin/login");
        exit;
    }
    $support_wait = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `status` = 'wait' "));
    $support_process = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `status` = 'process' "));
    $support_done = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `status` = 'done' "));
?>
<div class="modal fade" id="modalSupportCaution" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">
                    Chỉnh sửa lưu ý hỗ trợ
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <div class="form-group">
                    <label>Nội dung lưu ý hỗ trợ:</label>
                    <textarea id="support_caution" name="support_caution"><?= setting('support_caution'); ?></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveSupportCaution(this)" ><i class="fas fa-save"></i> LƯU THAY ĐỔI</button>
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
            <div class="card-body">
                <div class="row font-sans-serif">

                    <div class="col-md-4 col-12 form-group mb-3" style="color: #ff9f24;">
                        <div class="card h-100" style="background-color: #fff8eb!important;">
                            <div class="card-body py-2" style="font-size: 22px; padding-bottom: 1.5rem!important;">
                                <div class="row align-items-center" style="margin-bottom: -14px;">
                                    <div class="col-auto pr-0">
                                        <i class="far fa-clock" style="font-size: 40px;"></i>
                                    </div>
                                    <div class="col text-right pl-0" >
                                        <strong class="mb-0">Chờ hỗ trợ</strong>
                                        <h3 class="mb-0">
                                            <span style="color: #ff9f24;"><?= number_format($support_wait); ?></span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12 form-group mb-3" style="color: #6f93ff;">
                        <div class="card h-100" style="background-color: #e1e9ff!important;">
                            <div class="card-body py-2" style="font-size: 22px; padding-bottom: 1.5rem!important;">
                                <div class="row align-items-center" style="margin-bottom: -14px;">
                                    <div class="col-auto pr-0">
                                        <i class="far fa-question-circle" style="font-size: 40px;"></i>
                                    </div>
                                    <div class="col text-right pl-0">
                                        <strong class="mb-0">Đang hỗ trợ</strong>
                                        <h3 class="mb-0">
                                            <span style="color: #6f93ff;"><?= number_format($support_process); ?></span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-12 form-group mb-3" style="color: #54bfad;">
                        <div class="card h-100" style="background-color: #c9f7f5!important;">
                            <div class="card-body py-2" style="font-size: 22px; padding-bottom: 1.5rem!important;">
                                <div class="row align-items-center" style="margin-bottom: -14px;">
                                    <div class="col-auto pr-0">
                                        <i class="far fa-check-circle" style="font-size: 40px;"></i>
                                    </div>
                                    <div class="col text-right pl-0">
                                        <strong class="mb-0">Đã hỗ trợ</strong>
                                        <h3 class="mb-0">
                                            <span style="color: #54bfad;"><?= number_format($support_done); ?></span>
                                        </h3>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-body">
                <h4>DANH SÁCH HỖ TRỢ</h4>
                <hr>
                <div class="row">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <select id="filterStatus" class="form-control">
                                <option value="">-- LỌC TRẠNG THÁI --</option>
                                <option value="wait">Chờ duyệt</option>
                                <option value="process">Đang hỗ trợ</option>
                                <option value="done">Đã hỗ trợ</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-success btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LỌC' onclick="filterSupport(this)"><i class="fas fa-filter"></i> LỌC NGAY</button>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-secondary btn-block" data-all="jzon" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LỌC' onclick="filterSupport(this)">TẤT CẢ</button>
                    </div>
                    <div class="col-lg-2">
                        <button class="btn btn-warning btn-block" onclick="modalSupportCaution()">LƯU Ý HỖ TRỢ</button>
                    </div>
                </div>
                <hr>
                <style>
                    .bg-gray {
                        background-color: #f5f7fa!important;
                    }
                    .mb-4, .my-4 {
                        margin-bottom: 1.5rem!important;
                    }
                    .mt-4, .my-4 {
                        margin-top: 1.5rem!important;
                    }
                    .p-2 {
                        padding: .5rem!important;
                    }
                    .col-auto {
                        -ms-flex: 0 0 auto;
                        flex: 0 0 auto;
                        width: auto;
                        max-width: 100%;
                    }
                    .avatar-home {
                        max-height: 79px;
                        max-width: 79px;
                        border-radius: 4px;
                    }
                    .pl-0, .px-0 {
                        padding-left: 0!important;
                    }
                    .cl-red {
                        color: #f64e60!important;
                    }

                    .cl-green {
                        color: #1fab89!important;
                    }
                    .font-13 {
                        font-size: 80%;
                    }
                    .cl-gray-2 {
                        color: #b5b5c3!important;
                    }
                    .hand {
                        cursor: pointer;
                    }
                    .float-right {
                        float: right!important;
                    }
                    .align-items-center {
                        -ms-flex-align: center!important;
                        align-items: center!important;
                    }
                    .d-flex {
                        display: -ms-flexbox!important;
                        display: flex!important;
                    }
                    .mr-2, .mx-2 {
                        margin-right: .5rem!important;
                    }
                    .bg-green-3 {
                        background-color: #c9f7f5!important;
                    }
                    a:hover, a:visited, a:focus {
                        text-decoration: none !important;
                    }
                </style>


                <div id="support_list">
                    <?php 
                        $support_list_query = mysqli_query($conn, "SELECT * FROM `support_list` ORDER BY `id` DESC ");
                        while($list = mysqli_fetch_assoc($support_list_query)) { 
                    ?>
                    <a href="/admin/manage/support/<?= $list['code']; ?>" class="card bg-gray my-4">
                        <div class="card-body jzon_card" style="padding: 1.5rem!important;">
                            <div class="row">
                                <div class="col-auto">
                                    <img src="<?= avatarUser(); ?>" width="50" alt="user" class="active avatar-home" />
                                </div>
                                <div class="col pl-0">
                                    <div class="row">
                                        <div class="col">
                                            <h6>
                                                <span class="cl-red mr-1" style="font-weight: bold;">#<?= $list['code']; ?>:</span>
                                                <span class="cl-green" style="font-weight: bold;"><?= $list['title']; ?></span>
                                            </h6>
                                        </div>
                                        <div class="col-auto">
                                            <span class="float-right d-flex align-items-center hand cl-gray-2" style="font-size: 14px;">
                                                Chi tiết&nbsp;<i class="fas fa-arrow-right"></i>
                                            </span>
                                        </div>
                                    </div>
                                    <div class="d-md-block d-none">
                                        <div class="row">
                                            <div class="col-auto">
                                                <?= showStatusSupport($list['status']); ?>
                                                <span class="badge text-white mr-2 badge-info"><?= $list['problem']; ?></span>
                                            </div>
                                            <div class="col text-right">
                                                <?php 
                                                    $numReply = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_message` WHERE `isReply` = '0' AND `code` = '".$list['code']."' ")); 
                                                    if($numReply > 20){
                                                        $numReply = "20+";
                                                    }
                                                ?>
                                                <span class="badge badge-danger"><i class="fas fa-reply"></i>&nbsp;<?= $numReply; ?></span>
                                                <span class="badge badge-primary"><i class="far fa-comment-dots"></i>&nbsp;<?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_message` WHERE `code` = '".$list['code']."' ")); ?></span>
                                                <span class="badge badge-dark"><i class="far fa-clock"></i>&nbsp;<?= timeAgo($list['created_time']); ?></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <h6 class="mb-0 align-items-center justify-content-between d-block d-md-none mt-2">
                                <div class="row align-items-center">
                                    <div class="col">
                                        <span class="badge bg-green-3 font-bold text-dark"><?= $list['username']; ?></span>
                                    </div>
                                    <div class="col-auto">
                                        <span class="d-flex align-items-center cl-gray-2 font-13"><i class="far fa-clock"></i> <?= timeAgo($list['created_time']); ?></span>
                                    </div>
                                </div>
                                <div class="row align-items-center mt-2">
                                    <div class="col-auto">
                                        <?= showStatusSupport($list['status']); ?>
                                        <span class="badge text-white mr-2 badge-info"><?= $list['problem']; ?></span>
                                    </div>
                                    <div class="col text-right">
                                        <span class="badge badge-primary">
                                            <i class="far fa-comment-dots"></i>&nbsp;<?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_message` WHERE `code` = '".$list['code']."' ")); ?>
                                        </span>
                                    </div>
                                </div>
                            </h6>
                        </div>
                    </a>
                    <?php } ?>
                </div>
            </div>
        </div>
    </div>
</div>
<script>
    function modalSupportCaution(){
        $("#modalSupportCaution").modal('show')
    }

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

        $("#support_caution").summernote({
            height: 250,
            minHeight: 150,
            maxHeight: 400,
        });
    })
</script>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot_admin.php");
    
?>