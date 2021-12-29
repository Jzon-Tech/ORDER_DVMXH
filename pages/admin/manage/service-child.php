<?php 
    $admin_page = true;
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Quản lí dịch vụ con";

    require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/sidebar_admin.php");

    if(!isset($_SESSION['admin'])){
        header("Location: /admin/login");
        exit;
    }
?>

<style>
    @media screen and (min-width: 800px) {
        .jzonReactions {
            max-width: 8.666667%!important
        }
        .jzonOptions {
            max-width: 11.666667%!important;
        }
        .jzonFixedPc {
            margin-bottom: -24px;
        }

    }
    @media screen and (max-width: 639px) {
        .jzonReactions {
            text-align: center;
        }
        .jzonFixed {
            margin-bottom: -10px;
        }
        .jzonFixedChooseReactions {
            margin-top: 10px;
        }
    }
</style>

<div class="row">
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">Thêm dịch vụ con</h4>
            </div>
            <div class="card-body">
                <div class="form-group">
                    <label>Chọn dịch vụ cha:</label>
                    <div class="tag-input-style" id="select2-parent">
                        <select id="service" name="service" class="select2 form-control " data-placeholder="Click để chọn dịch vụ cha...">
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
                    <label>Tên dịch vụ con:</label>
                    <input class="form-control" id="name" placeholder="ex: Tăng like bài viết">
                </div>
                <div class="form-group">
                    <label>Font icon (<a href="https://fontawesome.com/v5.15/icons?d=" target="_blank">Fontawesome</a>):</label>
                    <input class="form-control" id="icon" placeholder="ex: fas fa-air-freshener (chỉ lấy bên trong class, không lấy cả tag)">
                </div>
                <hr>
                <input type="hidden" id="customOption">
                <div class="row jzonFixedPc">
                    <div class="col-lg-3 jzonFixed">
                        <div class="form-group">
                            <label>Tùy chọn thêm (<b style="color: red;">KHÔNG BẮT BUỘC</b>):</label>
                        </div>
                    </div>
                    <div class="col-4 jzonOptions">
                        <label>
                            <input type="radio" data-type="reactions" onclick="customOption(this)" name="option" class="mr-1" />
                            Cảm xúc
                        </label>
                    </div>
                    <div class="col-4 jzonOptions">
                        <label>
                            <input type="radio" data-type="comment" onclick="customOption(this)" name="option" class="mr-1" />
                            Bình luận
                        </label>
                    </div>
                    <div class="col-4 jzonOptions" id="jzoncutehihi" data-toggle="tooltip" data-placement="top" title="" data-original-title="Tự động get ID cá nhân/bài viết (CHỈ HỖ TRỢ FACEBOOK)">
                        <label>
                            <input type="checkbox" id="extract_id" name="option" class="mr-1" />
                            Extract ID
                        </label>
                    </div>
                </div>
                <hr>
                <input type="hidden" id="reactions_arr">
                <div class="row jzonFixedChooseReactions" style="display: none;" id="chooseReactions">
                    <div class="col-lg-3">
                        <div class="form-group">
                            <label>Chọn cảm xúc:</label>
                        </div>
                    </div>

                    <div class="col-6 jzonReactions">
                        <label>
                            <input type="checkbox" name="option" class="mr-1" data-reaction="like" onclick="showPriceBox(this)"/>
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/images/jzonReactions/like.png" style="width:30px">
                        </label>
                    </div>
                    <div class="col-6 jzonReactions">
                        <label>
                            <input type="checkbox" name="option" class="mr-1" data-reaction="love" onclick="showPriceBox(this)"/>
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/images/jzonReactions/love.png" style="width:30px">
                        </label>
                    </div>
                    <div class="col-6 jzonReactions">
                        <label>
                            <input type="checkbox" name="option" class="mr-1" data-reaction="care" onclick="showPriceBox(this)"/>
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/images/jzonReactions/care.png" style="width:30px">
                        </label>
                    </div>
                    <div class="col-6 jzonReactions">
                        <label>
                            <input type="checkbox" name="option" class="mr-1" data-reaction="haha" onclick="showPriceBox(this)"/>
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/images/jzonReactions/haha.png" style="width:30px">
                        </label>
                    </div>
                    <div class="col-6 jzonReactions">
                        <label>
                            <input type="checkbox" name="option" class="mr-1" data-reaction="wow" onclick="showPriceBox(this)"/>
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/images/jzonReactions/wow.png" style="width:30px">
                        </label>
                    </div>
                    <div class="col-6 jzonReactions">
                        <label>
                            <input type="checkbox" name="option" class="mr-1" data-reaction="sad" onclick="showPriceBox(this)"/>
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/images/jzonReactions/sad.png" style="width:30px">
                        </label>
                    </div>
                    <div class="col-6 jzonReactions" style="">
                        <label>
                            <input type="checkbox" name="option" class="mr-1" data-reaction="angry" onclick="showPriceBox(this)"/>
                            <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/main/images/jzonReactions/angry.png" style="width:30px">
                        </label>
                    </div>
                </div>

                <div class="row" style="margin-bottom: 10px; display: none;" id="priceLikeForm">
                    <div class="col-lg-3">
                        <label>Giá tiền <b style="color: red;">LIKE</b>:</label>
                    </div>

                    <div class="col-lg-3">
                        <input type="number" id="jzonLikeField" class="form-control" data-reaction="like" onkeyup="fillPriceReactions(this)" placeholder="Nhập giá tiền ở đây">
                    </div>
                </div>

                <div class="row" style="margin-bottom: 10px; display: none;" id="priceLoveForm">
                    <div class="col-lg-3">
                        <label>Giá tiền <b style="color: red;">LOVE</b>:</label>
                    </div>

                    <div class="col-lg-3">
                        <input type="number" id="jzonLoveField" class="form-control" data-reaction="love" onkeyup="fillPriceReactions(this)" placeholder="Nhập giá tiền ở đây">
                    </div>
                </div>

                <div class="row" style="margin-bottom: 10px; display: none;" id="priceCareForm">
                    <div class="col-lg-3">
                        <label>Giá tiền <b style="color: red;">CARE</b>:</label>
                    </div>

                    <div class="col-lg-3">
                        <input type="number" id="jzonCareField" class="form-control" data-reaction="care" onkeyup="fillPriceReactions(this)" placeholder="Nhập giá tiền ở đây">
                    </div>
                </div>

                <div class="row" style="margin-bottom: 10px; display: none;" id="priceHahaForm">
                    <div class="col-lg-3">
                        <label>Giá tiền <b style="color: red;">HAHA</b>:</label>
                    </div>

                    <div class="col-lg-3">
                        <input type="number" id="jzonHahaField" class="form-control" data-reaction="haha" onkeyup="fillPriceReactions(this)" placeholder="Nhập giá tiền ở đây">
                    </div>
                </div>

                <div class="row" style="margin-bottom: 10px; display: none;" id="priceWowForm">
                    <div class="col-lg-3">
                        <label>Giá tiền <b style="color: red;">WOW</b>:</label>
                    </div>

                    <div class="col-lg-3">
                        <input type="number" id="jzonWowField" class="form-control" data-reaction="wow" onkeyup="fillPriceReactions(this)" placeholder="Nhập giá tiền ở đây">
                    </div>
                </div>

                <div class="row" style="margin-bottom: 10px; display: none;" id="priceSadForm">
                    <div class="col-lg-3">
                        <label>Giá tiền <b style="color: red;">SAD</b>:</label>
                    </div>

                    <div class="col-lg-3">
                        <input type="number" id="jzonSadField" class="form-control" data-reaction="sad" onkeyup="fillPriceReactions(this)" placeholder="Nhập giá tiền ở đây">
                    </div>
                </div>

                <div class="row" style="margin-bottom: 10px; display: none;" id="priceAngryForm">
                    <div class="col-lg-3">
                        <label>Giá tiền <b style="color: red;">ANGRY</b>:</label>
                    </div>

                    <div class="col-lg-3">
                        <input type="number" id="jzonAngryField" class="form-control" data-reaction="angry" onkeyup="fillPriceReactions(this)" placeholder="Nhập giá tiền ở đây">
                    </div>
                </div>

                <div class="row" style="display: none;" id="commentBox">
                    <div class="col-lg-12">
                        <p>Khi chọn "Bình luận" hệ thống sẽ hiển thị ô nhập bình luận (mỗi dòng <b>1 bình luận/số lượng</b>)</p>
                    </div>
                </div>

                <hr>

                <div class="row">
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Số lượng mua tối thiếu:</label>
                            <input type="number" id="amount_minimum" placeholder="*Trường này là bắt buộc" class="form-control">
                        </div>
                    </div>
                    <div class="col-lg-6">
                        <div class="form-group">
                            <label>Số lượng mua tối đa:</label>
                            <input type="number" id="amount_maximum" placeholder="*Trường này là bắt buộc" class="form-control">
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label>Lưu ý khi sử dụng (<b style="color: red;">HIỂN THỊ Ở TRANG MUA</b>):</label>
                    <textarea id="warn_msg" name="jzonWarnMsgEditor"></textarea>
                </div>

                <div class="form-group">
                    <button class="btn btn-success btn-block" data-loading='<i class="fas fa-spinner fa-pulse"></i> ĐANG THÊM DỊCH VỤ CON' onclick="addServiceChild(this)"><i class="fas fa-plus"></i> THÊM NGAY</button>
                </div>
            </div>
        </div>
    </div>
    <div class="col-12 col-sm-12 mt-3 mt-sm-0 cards-container" id="card-container-2">
        <div class="card border-0 shadow-sm radius-0 mb-3" id="card-2" draggable="false" style="">
            <div class="card-header bgc-primary-d1">
                <h5 class="card-title text-white">
                    <i class="fa fa-table mr-2px"></i>
                    Quản lí dịch vụ con
                </h5>
            </div>

            <div class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0">
                <div class="table-responsive">
                    <table class="table table-bordered table-striped" id="jzonTable1">
                        <thead class="text-dark-l2 text-95">
                            <tr>
                                <th>STT</th>
                                <th>Dịch vụ cha</th>
                                <th>Tên dịch vụ</th>
                                <th>Thao tác</th>
                            </tr>
                        </thead>

                        <tbody>
                            <?php
                                $jzon = 0;
                                $child_query = mysqli_query($conn, "SELECT * FROM `list_service_child` ORDER BY `id` DESC");
                                while($child = mysqli_fetch_assoc($child_query)){ 
                                    $infoFather = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `list_service` WHERE `key` = '".$child['father']."' "));
                            ?>
                            <tr id="child_<?= $child['id']; ?>">
                                <td class="text-dark-m2"><?= $jzon++; ?></td>
                                <td class="text-dark-m2" style="font-weight: bold; font-style: italic;"><?= $infoFather['name']; ?></td>
                                <td class="text-dark-m2" style="font-weight: bold;"><?= $child['name']; ?></td>
                                <td class="text-dark-m2">
                                    <a class="btn btn-info" href="/admin/edit/service-child/<?= $child['slug']; ?>" target="_blank"><i class="fas fa-edit"></i></a>
                                    <button class="btn btn-danger" data-loading='<i class="fas fa-spinner fa-pulse"></i>' data-id="<?= $child['id']; ?>" onclick="deleteServiceChild(this)"><i class="fas fa-trash-alt"></i></button>
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
        $('#jzoncutehihi').tooltip({
            template: '<div class="tooltip" role="tooltip"><div class="brc-secondary-d3 arrow"></div><div class="bgc-secondary-d3 tooltip-inner text-105 text-600"></div></div>'
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

        $("#warn_msg").summernote({
            height: 250,
            minHeight: 150,
            maxHeight: 400,
        });
    })


    function customOption(data){
        var type = $(data).attr('data-type')
        switch(type){
            case 'reactions':
                $("#customOption").val(type)
                $("#commentBox").hide()
                $("#chooseReactions").show()

                if($("#jzonLikeField").val() != ""){
                    $("#priceLikeForm").show()
                }

                if($("#jzonLoveField").val() != ""){
                    $("#priceLoveForm").show()
                }

                if($("#jzonCareField").val() != ""){
                    $("#priceCareForm").show()
                }


                if($("#jzonHahaField").val() != ""){
                    $("#priceHahaForm").show()
                }

                if($("#jzonWowField").val() != ""){
                    $("#priceWowForm").show()
                }

                if($("#jzonSadField").val() != ""){
                    $("#priceSadForm").show()
                }

                if($("#jzonAngryField").val() != ""){
                    $("#priceAngryForm").show()
                }


                break;
            case 'comment':
                $("#priceLikeForm").hide()
                $("#priceLoveForm").hide()
                $("#priceCareForm").hide()
                $("#priceHahaForm").hide()
                $("#priceWowForm").hide()
                $("#priceSadForm").hide()
                $("#priceAngryForm").hide()

                $("#chooseReactions").hide()
                $("#commentBox").show()
                $("#customOption").val(type)
                break;
        }
    }

    function showPriceBox(data){
        if($(data).is(':checked')){
            $("#price" + jzonCapitalize($(data).attr('data-reaction')) + "Form").show()
        }else{
            $("#price" + jzonCapitalize($(data).attr('data-reaction')) + "Form").hide()
        }
    }

    let reactions_arr = []

    function fillPriceReactions(data){
        var reaction = $(data).attr('data-reaction')
        var matches = reactions_arr.filter(s => s.includes(reaction))
        var rate = $(data).val()
        var value = reaction + "|" + rate

        if(isNaN(rate)){
            return;
        }

        if(matches.length <= 0){
            reactions_arr.push(value)
        }else{
            var value_search = matches[0];
            var indexInt = reactions_arr.indexOf(value_search)

            if(indexInt >= 0){
                reactions_arr[indexInt] = value
            }
        }

        $("#reactions_arr").val(reactions_arr)
    }
</script>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot_admin.php");
    
?>