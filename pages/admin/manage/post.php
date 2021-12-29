<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Quản lí bài đăng";

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
                <h4 class="card-title">Tạo bài viết</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Nội dung bài viết:</label>
                    <textarea id="jzonPostContent" name="jzonPostEditor"></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG ĐĂNG BÀI' onclick="createPost(this)">
                        <i class="fas fa-plus"></i> ĐĂNG BÀI NGAY
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 mt-3 mt-sm-0 cards-container" id="card-container-2" style="margin-top: 10px;">
        <div class="card border-0 shadow-sm radius-0 mb-3" id="card-2" draggable="false" style="">
            <div class="card-header bgc-primary-d1">
                <h5 class="card-title text-white">
                    <i class="fa fa-table mr-2px"></i>
                    Quản lí bài viết
                </h5>
            </div>

            <div class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="jzonTable1">
                        <thead class="text-dark-l2 text-95">
                            <tr>
                                <th>Key bài viết</th>
                                <th>Lượt like</th>
                                <th>Ngày đăng</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $newsfeed_query = mysqli_query($conn, "SELECT * FROM `newsfeed` ORDER BY `id` DESC");
                                while($news = mysqli_fetch_assoc($newsfeed_query)){ 
                            ?>
                            <tr id="post_<?= $news['id']; ?>">
                                <td class="text-dark-m2" style="font-weight: bold;"><?= $news['key']; ?></td>
                                <td class="text-dark-m2" style="font-weight: bold; color: red!important;"><?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `like_post` WHERE `post_key` = '".$news['key']."' ")); ?></td>
                                <td class="text-dark-m2" style="font-weight: bold; color: green!important;"><?= formatDate($news['created_time']); ?></td>
                                <td class="text-dark-m2">
                                    <button class="btn btn-danger" data-loading='<i class="fas fa-spinner fa-pulse"></i>' data-id="<?= $news['id']; ?>" onclick="deletePost(this)"><i class="fas fa-trash-alt"></i></button>
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
        $("#jzonTable1").DataTable({
            "ordering": false
        })
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

        $("#jzonPostContent").summernote({
            height: 250,
            minHeight: 150,
            maxHeight: 400,
        });
    })

</script>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot_admin.php");
    
?>