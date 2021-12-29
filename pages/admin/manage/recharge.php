<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Quản lí nạp tiền";

    require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/sidebar_admin.php");

    if(!isset($_SESSION['admin'])){
        header("Location: /admin/login");
        exit;
    }
?>
<div class="modal fade" id="editRechargeModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel2">
                    Chỉnh sửa ngân hàng/ví điện tử
                </h5>

                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="modal-body">
                <input type="hidden" id="jzon_id">
                <div class="form-group">
                    <label>Logo ngân hàng/ví điện tử (Khuyến khích size: <b style="color: red;">550×130</b>):</label>
                    <input class="form-control" id="jzon_logo_bank" placeholder="ex: https://hrincjobs-pro.s3.amazonaws.com/media/public/filer_public/66/6b/666b7279-64c1-4d52-b6be-be0b76c7b460/logo-mbbank-cmyk.png">
                </div>
                <div class="form-group">
                    <label>Chủ tài khoản:</label>
                    <input class="form-control" id="jzon_owner" placeholder="Nhập chủ tài khoản">
                </div>
                <div class="form-group">
                    <label>Số tài khoản:</label>
                    <input class="form-control" id="jzon_number_account" placeholder="Nhập số tài khoản">
                </div>
                <div class="form-group">
                    <label>Chi nhánh:</label>
                    <input class="form-control" id="jzon_branch" placeholder="Nhập chi nhánh">
                </div>
                <div class="form-group">
                    <label>Ghi chú:</label>
                    <input class="form-control" id="jzon_note" placeholder="Nhập ghi chú">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveRechargeModal(this)" ><i class="fas fa-save"></i> LƯU THAY ĐỔI</button>
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
        <div class="card" style="height: calc(100% - 1.875rem);">
            <div class="card-header">
                <h5 class="card-title">Cấu hình chung</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Chế độ nội dung:</label>
                    <select class="form-control" id="memo_mode">
                        <option value="uid" <?php if(setting('memo_mode') == 'uid'){ echo 'selected'; } ?>>Lấy theo UID người dùng (NAPTIEN 1)</option>
                        <option value="user" <?php if(setting('memo_mode') == 'user'){ echo 'selected'; } ?>>Lấy tên đăng nhập người dùng (NAPTIEN jzondev2412)</option>
                    </select>
                </div>
                <div class="form-group">
                    <label>Tên MEMO:</label>
                    <input class="form-control" id="memo_name" value="<?= setting('memo_name'); ?>">
                </div>
                
                
                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveRecharge(this)" >
                        <i class="fas fa-save"></i> LƯU THAY ĐỔI
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="margin-bottom: 10px;">
        <div class="card" style="height: calc(100% - 1.875rem);">
            <div class="card-header">
                <h5 class="card-title">Cấu hình Zalo Pay</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Chủ tài khoản:</label>
                    <input class="form-control" id="zalo_owner" value="<?= setting('zalo_owner'); ?>">
                </div>
                <div class="form-group">
                    <label>Số điện thoại:</label>
                    <input class="form-control" id="zalo_phone" value="<?= setting('zalo_phone'); ?>">
                </div>
                <div class="form-group">
                    <label>Token Zalo Pay (<a href="https://api.web2m.com/Register.html?ref=116" target="_blank">API.WEB2M.COM</a>):</label>
                    <input class="form-control" id="zalo_token" value="<?= setting('zalo_token'); ?>" placeholder="Tự động ẩn khi để trống token">
                </div>
                <div class="form-group">
                    <label>Ghi chú:</label>
                    <input class="form-control" id="zalo_note" value="<?= setting('zalo_note'); ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveZaloPayRecharge(this)" >
                        <i class="fas fa-save"></i> LƯU THAY ĐỔI
                    </button>
                </div>
            </div>
        </div>
    </div>
    
    <div class="col-lg-6" style="margin-bottom: 10px;">
        <div class="card" style="height: calc(100% - 1.875rem);">
            <div class="card-header">
                <h5 class="card-title">Cấu hình ví MOMO</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Chủ tài khoản:</label>
                    <input class="form-control" id="momo_owner" value="<?= setting('momo_owner'); ?>">
                </div>
                <div class="form-group">
                    <label>Số điện thoại:</label>
                    <input class="form-control" id="momo_phone" value="<?= setting('momo_phone'); ?>">
                </div>
                <div class="form-group">
                    <label>Token Momo (<a href="https://api.web2m.com/Register.html?ref=116" target="_blank">API.WEB2M.COM</a>):</label>
                    <input class="form-control" id="momo_token" value="<?= setting('momo_token'); ?>" placeholder="Tự động ẩn khi để trống token">
                </div>
                <div class="form-group">
                    <label>Ghi chú:</label>
                    <input class="form-control" id="momo_note" value="<?= setting('momo_note'); ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveMomoRecharge(this)" >
                        <i class="fas fa-save"></i> LƯU THAY ĐỔI
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="margin-bottom: 10px;">
        <div class="card" style="height: calc(100% - 1.875rem);">
            <div class="card-header">
                <h5 class="card-title">Cấu hình Vietcombank</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Chủ tài khoản:</label>
                    <input class="form-control" id="vcb_owner" value="<?= setting('vcb_owner'); ?>">
                </div>
                <div class="form-group">
                    <label>Số điện thoại:</label>
                    <input class="form-control" id="vcb_stk" value="<?= setting('vcb_stk'); ?>">
                </div>
                <div class="form-group">
                    <label>Token Vietcombank (<a href="https://api.web2m.com/Register.html?ref=116" target="_blank">API.WEB2M.COM</a>):</label>
                    <input class="form-control" id="vcb_token" value="<?= setting('vcb_token'); ?>" placeholder="Tự động ẩn khi để trống token">
                    <span class="text-danger">Định dạng: stk_mk|token</span>
                </div>
                <div class="form-group">
                    <label>Ghi chú:</label>
                    <input class="form-control" id="vcb_note" value="<?= setting('vcb_note'); ?>">
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveVCBRecharge(this)" >
                        <i class="fas fa-save"></i> LƯU THAY ĐỔI
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="margin-bottom: 10px;">
        <div class="card" style="height: calc(100% - 1.875rem);">
            <div class="card-header">
                <h5 class="card-title">Cấu hình thẻ cào tự động</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Api Key (<a href="https://card1s.vn" target="_blank">CARD1S.VN</a>):</label>
                    <input class="form-control" id="api_card1s" value="<?= setting('api_card1s'); ?>">
                    <span class="text-danger">Định dạng: partner_id|partner_key</span>
                </div>
                <div class="form-group">
                    <label>Lưu ý khi nạp thẻ cào:</label>
                    <textarea id="card_note" name="card_note"><?= setting('card_note'); ?></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveCardRecharge(this)" >
                        <i class="fas fa-save"></i> LƯU THAY ĐỔI
                    </button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-lg-6" style="margin-bottom: 10px;">
        <div class="card" style="height: calc(100% - 1.875rem);">
            <div class="card-header">
                <h5 class="card-title">Cấu hình ngân hàng/ví điện tử</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Lưu ý khi nạp ngân hàng/ví điện tử:</label>
                    <textarea id="banking_note" name="banking_note"><?= setting('banking_note'); ?></textarea>
                </div>
                <div class="form-group">
                    <button class="btn btn-primary btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG LƯU THAY ĐỔI' onclick="saveBankRecharge(this)" >
                        <i class="fas fa-save"></i> LƯU THAY ĐỔI
                    </button>
                </div>
            </div>
        </div>
    </div>

    <div class="col-lg-12" style="margin-bottom: 10px;">
        <div class="card">
            <div class="card-header">
                <h5 class="card-title">Thêm ngân hàng/ví điện tử</h5>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Logo ngân hàng/ví điện tử (Khuyến khích size: <b style="color: red;">550×130</b>):</label>
                    <input class="form-control" id="logo_bank" placeholder="ex: https://hrincjobs-pro.s3.amazonaws.com/media/public/filer_public/66/6b/666b7279-64c1-4d52-b6be-be0b76c7b460/logo-mbbank-cmyk.png">
                </div>
                <div class="form-group">
                    <label>Chủ tài khoản:</label>
                    <input class="form-control" id="owner" placeholder="Nhập chủ tài khoản">
                </div>
                <div class="form-group">
                    <label>Số tài khoản:</label>
                    <input class="form-control" id="number_account" placeholder="Nhập số tài khoản">
                </div>
                <div class="form-group">
                    <label>Chi nhánh:</label>
                    <input class="form-control" id="branch" placeholder="Nhập chi nhánh">
                </div>
                <div class="form-group">
                    <label>Ghi chú:</label>
                    <input class="form-control" id="note" placeholder="Nhập ghi chú">
                </div>
                <div class="form-group">
                    <button class="btn btn-success btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG THÊM NGÂN HÀNG/VÍ ĐIỆN TỬ' onclick="addBank(this)">
                        <i class="fas fa-plus"></i> THÊM NGÂN HÀNG/VÍ ĐIỆN TỬ
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
                    Quản lí ngân hàng/ví điện tử
                </h5>
            </div>

            <div class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="jzonTable1">
                        <thead class="text-dark-l2 text-95">
                            <tr>
                                <th>Logo</th>
                                <th>CTK</th>
                                <th>STK</th>
                                <th>Chi nhánh</th>
                                <th>Ghi chú</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $bank_query = mysqli_query($conn, "SELECT * FROM `list_bank` ORDER BY `id` DESC");
                                while($bank = mysqli_fetch_assoc($bank_query)){ 
                            ?>
                            <tr id="recharge_<?= $bank['id']; ?>">
                                <td class="text-dark-m2"><img src="<?= $bank['logo_bank']; ?>" height="45px"></td>
                                <td class="text-dark-m2"><?= $bank['owner']; ?></td>
                                <td class="text-dark-m2"><?= $bank['number_account']; ?></td>
                                <td class="text-dark-m2"><?= $bank['branch']; ?></td>
                                <td class="text-dark-m2"><?= $bank['note']; ?></td>
                                <td class="text-dark-m2">
                                    <button class="btn btn-info" data-loading='<i class="fas fa-spinner fa-pulse"></i>' data-id="<?= $bank['id']; ?>" onclick="showRechargeModal(this)"><i class="fas fa-edit"></i></button>
                                    <button class="btn btn-danger" data-loading='<i class="fas fa-spinner fa-pulse"></i>' data-id="<?= $bank['id']; ?>" onclick="deleteRecharge(this)"><i class="fas fa-trash-alt"></i></button>
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

        $("#card_note").summernote({
            height: 250,
            minHeight: 150,
            maxHeight: 400,
        });

        $("#banking_note").summernote({
            height: 250,
            minHeight: 150,
            maxHeight: 400,
        });
    })

</script>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot_admin.php");
    
?>