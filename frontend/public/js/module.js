/*
    XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA
*/


function moduleLogin(data){
    $.ajax({
        type: "POST",
        url: "",
        data: {
            username: $("#username").val(),
            password: $("#password").val(),
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')    
        },
        complete: function(){
            $(data).html('<i class="fas fa-sign-in-alt"></i> ĐĂNG NHẬP NGAY').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                window.location.href = '/home';
            }else{
                showResult(res.error, "error", "#result")
            }
        }
    });
}

function moduleCreateAccount(data){
    $.ajax({
        type: "POST",
        url: "",
        data: {
            username: $("#username").val(),
            password: $("#password").val(),
            repassword: $("#repassword").val(),
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')    
        },
        complete: function(){
            $(data).html('<i class="fas fa-plus"></i> TẠO TÀI KHOẢN').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                showResult(res.success, "success", "#result")
                setTimeout(() => {
                    window.location.href = '/auth/login';
                }, 1200);
            }else{
                showResult(res.error, "error", "#result")
            }
        }
    });
}



function likePost(data){
    var key = $(data).attr('data-key')
    $.ajax({
        type: "POST",
        url: "/ajaxs/users/actionNewsfeed.php",
        data: {
            key,
            type: "likePost",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).attr('onclick', 'return false;')
        },
        success: function (res) {
            if(res.success){
                $('#icon_' + key).removeClass('cl-gray-2').addClass('cl-red')
                $('#like_' + key).html(res.like_count)
                $(data).attr('onclick', 'unlikePost(this)')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function unlikePost(data){
    var key = $(data).attr('data-key')
    $.ajax({
        type: "POST",
        url: "/ajaxs/users/actionNewsfeed.php",
        data: {
            key,
            type: "unlikePost",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).attr('onclick', 'return false;')
        },
        success: function (res) {
            if(res.success){
                $('#icon_' + key).removeClass('cl-red').addClass('cl-gray-2')
                $('#like_' + key).html(res.like_count)
                $(data).attr('onclick', 'likePost(this)')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function extractIdFb(data){
    setTimeout(() => {
        var link = $(data).val()

        if(!isURL(link)){
            return false
        }

        $.ajax({
            type: "POST",
            url: "/ajaxs/extensions/getIdFb.php",
            data: {
                link
            },
            dataType: "json",
            beforeSend: function(){
                $("#successMsg").hide()
                $("#object_id").attr('readonly', 'readonly').attr('style', 'background-color: #e9ecef;')
            },
            complete: function(){
                $("#object_id").removeAttr('readonly').removeAttr('style', 'background-color: #e9ecef;')
            },
            success: function (res) {
                if(res.success){
                    if(res.uid != "") { 
                        $("#successMsg").show()
                        $("#object_id").val(res.uid)
                    }else{
                        $("#object_id").val('')
                        jzonAlert("Liên kết không hợp lệ", "error")
                    }
                }else{
                    $("#object_id").val('')
                    jzonAlert(res.error, "error")
                }
            }
        });
    }, 100);
}

function amountComment(data){
    var comment = $(data).val().split(/\n+/).length;
    $("#object_amount").text(comment)
}

function createOrder(data){
    var amountType = $(data).attr('data-amount')
    var amount;
    var list_comment;
    var reactions;

    if($("#list_comment").val() == undefined){
        list_comment = "";
    }else{
        list_comment = $("#list_comment").val()
    }

    if($("#main_reaction").val() == undefined){
        reactions = "";
    }else{
        reactions = $("#main_reaction").val()
    }

    var server = $("#server").val();
    var note = $("#note").val();
    var object_id = $("#object_id").val();

    switch(amountType){
        case 'text':
            amount = $("#object_amount").text()
            break;

        case 'val':
            amount = $("#object_amount").val()
            break;

        default:
            return false
            break;
    }

    $.ajax({
        type: "POST",
        url: "/ajaxs/users/createOrder.php",
        data: {
            slug: infoService.slug,
            object_id,
            amount,
            list_comment,
            reactions,
            server,
            note,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')    
        },
        complete: function(){
            $(data).html('TẠO TIẾN TRÌNH').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                setTimeout(function(){ window.location.href= window.location.pathname + "/manage" }, 1200);
                jzonAlert(res.success, "success")
            }else{
                jzonAlert(res.error, "error")
            }
        }
    });
}

function createSupport(data){
    var fd = new FormData();
    var files = $("#upfile")[0].files;

    fd.append("file", files[0]);
    fd.append("title", $("#title__").val());
    fd.append("problem", $("#problem").val());
    fd.append("service", $("#service").val());
    fd.append("describe", $("#describe").val());
    fd.append("jzon", true);

    $.ajax({
        url: "/ajaxs/users/support/create.php",
        type: "post",
        data: fd,
        dataType: "json",
        contentType: false,
        processData: false,
        beforeSend: function () {
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function () {
            $(data).html('<i class="fas fa-paper-plane"></i> GỬI YÊU CẦU NGAY').removeAttr('disabled')   
        },
        success: function (res) {
            if (res.success) {
                jzonAlert(res.success, "success")
                setTimeout(function(){ window.location.href="/support/" + res.code }, 1200);
            } else {
                jzonAlert(res.error, "error")
            }
        },
    });
}

function sendSupportMessage1(data){
    var message = $("#message").val()
    var code = $(data).attr('data-code')
    
    $.ajax({
        type: "POST",
        url: "/ajaxs/users/support/send.php",
        data: {
            code,
            message,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $("#message").attr('readonly', 'readonly')    
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $("#message").removeAttr('readonly')    
            $(data).html('<i class="fas fa-paper-plane"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonHtml = '<div class="message me"> <span class="bubble"> ' + res.message + ' </span> </div>'
                $("#support_data").append(jzonHtml)
                $("#message").val('')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function sendSupportMessage2(data){
    var message = $("#message").val()
    var code = $(data).attr('data-code')
    
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/support/send.php",
        data: {
            code,
            message,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $("#message").attr('readonly', 'readonly')
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $("#message").removeAttr('readonly')    
            $(data).html('<i class="fas fa-paper-plane"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonHtml = '<div class="message me"> <span class="bubble"> ' + res.message + ' </span> </div>'
                $("#support_data").append(jzonHtml)
                $("#message").val('')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function closeSupport(data){
    var code = $(data).attr('data-code')
    
    $.ajax({
        type: "POST",
        url: "/ajaxs/users/support/close.php",
        data: {
            code,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).attr('readonly', 'readonly')
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).removeAttr('readonly')    
            $(data).html('<i class="fas fa-times-circle"></i> Đóng hỗ trợ').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(function(){ window.location.href="/support/list" }, 1200);
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function openSupport(data){
    var code = $(data).attr('data-code')
    
    $.ajax({
        type: "POST",
        url: "/ajaxs/users/support/open.php",
        data: {
            code,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).attr('readonly', 'readonly')
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).removeAttr('readonly')    
            $(data).html('<i class="fas fa-door-open"></i> Mở hỗ trợ').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(function(){ window.location.reload() }, 1200);
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function showUserModal(data){
    var id = $(data).attr('data-id')
    var type = "infoUser"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/member.php",
        data: {
            id,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-edit"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $("#jzon_id").val(res.uid)
                $("#jzon_username").val(res.username)
                $("#jzon_cash").val(res.cash)
                $("#jzon_level_now").text("Hiện tại: " + res.level)
                $("#jzon_banned").val(res.banned)
                $("#editAccountModal").modal('show')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveUser(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/member.php",
        data: {
            id: $("#jzon_id").val(),
            username: $("#jzon_username").val(),
            cash: $("#jzon_cash").val(),
            level: $("#jzon_level").val(),
            banned: $("#jzon_banned").val(),
            type: "saveUser",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function deleteUser(data){
    var id = $(data).attr('data-id')
    var type = "deleteUser"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/member.php",
        data: {
            id,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-trash-alt"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $("#user_" + id).remove()
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function plusCashUser(data){
    var id = $("#jzon_id").val()
    var cash = $("#jzon_cash_plus").val()
    var type = "plusCashUser"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/member.php",
        data: {
            id,
            cash,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('CỘNG TIỀN').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function minusCashUser(data){
    var id = $("#jzon_id").val()
    var cash = $("#jzon_cash_minus").val()
    var type = "minusCashUser"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/member.php",
        data: {
            id,
            cash,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('TRỪ TIỀN').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function createPost(data){
    var content = $('#jzonPostContent').summernote('code');
    var type = "createPost"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/post.php",
        data: {
            content,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-plus"></i> ĐĂNG BÀI NGAY').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(() => {
                    window.location.reload()
                }, 1200);
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function deletePost(data){
    var id = $(data).attr('data-id')
    var type = "deletePost"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/post.php",
        data: {
            id,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-trash-alt"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $("#post_" + id).remove()
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}




function openSupport2(data){
    var code = $(data).attr('data-code')
    
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/support/open.php",
        data: {
            code,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('Mở hỗ trợ').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(function(){ window.location.reload() }, 1200);
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function closeSupport2(data){
    var code = $(data).attr('data-code')
    
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/support/close.php",
        data: {
            code,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('Đóng hỗ trợ').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(function(){ window.location.href="/admin/manage/support" }, 1200);
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function deleteSupport2(data){
    var code = $(data).attr('data-code')
    
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/support/delete.php",
        data: {
            code,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('Xóa hỗ trợ').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(function(){ window.location.href="/admin/manage/support" }, 1200);
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function filterSupport(data){
    var isAll = $(data).attr('data-all')
    var status;

    if(isAll == 'jzon'){
        status = 'all'
    }else{
        status = $("#filterStatus").val()
    }
    
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/support/filter.php",
        data: {
            status,
            jzon: true
        },
        dataType: "text",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            if(status == 'all'){
                $(data).html('TẤT CẢ').removeAttr('disabled')   
            }else{
                $(data).html('<i class="fas fa-filter"></i> LỌC NGAY').removeAttr('disabled')   
            }
        },
        success: function (res) {
            $("#support_list").html(res)
        }
    });
}

function deleteMessageSuggest(data){
    var id = $(data).attr('data-id')
    var type = "deleteMessageSuggest"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/add/message-suggest.php",
        data: {
            id,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-trash-alt"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $("#sg_" + id).remove()
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function addMessageSuggest(data){
    var message = $("#jzonMessage").val()
    var type = "addMessageSuggest"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/add/message-suggest.php",
        data: {
            message,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-plus"></i> THÊM NGAY').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(() => {
                    window.location.reload()
                }, 1200);
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function addService(data){
    var name = $("#name").val()
    var icon = $("#icon").val()
    var type = "addService"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/service.php",
        data: {
            name,
            icon,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-plus"></i> THÊM NGAY').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(() => {
                    window.location.reload()
                }, 1200);
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function deleteService(data){
    var id = $(data).attr('data-id')
    var type = "deleteService"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/service.php",
        data: {
            id,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-trash-alt"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $("#service_" + id).remove()
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function infoService(data){
    var id = $(data).attr('data-id')
    var type = "infoService"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/service.php",
        data: {
            id,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-pen"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $("#jzon_key").val(res.key)
                $("#jzon_name").val(res.name)
                $("#jzon_icon").val(res.icon)
                $("#editService_modal").modal('show')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveService(data){
    var key = $("#jzon_key").val()
    var name = $("#jzon_name").val()
    var icon = $("#jzon_icon").val()

    var type = "saveService"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/service.php",
        data: {
            key,
            name,
            icon,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function addServiceChild(data){
    var service = $("#service").val()
    var name = $("#name").val()
    var icon = $("#icon").val()
    var customOption = $("#customOption").val()
    var extract_id = $("#extract_id").is(":checked")
    var amount_minimum = $("#amount_minimum").val()
    var amount_maximum = $("#amount_maximum").val()
    var warn_msg = $('#warn_msg').summernote('code');

    var type = "addServiceChild"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/service-child.php",
        data: {
            service,
            name,
            icon,
            customOption,
            extract_id,
            reactions_arr: reactions_arr.toString(),
            amount_minimum,
            amount_maximum,
            warn_msg,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-plus"></i> THÊM NGAY').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(function(){
                    window.location.reload()
                }, 1200)
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}
/*
    XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA
*/
function saveServiceChild(data){
    var service = $("#service").val()
    var name = $("#name").val()
    var icon = $("#icon").val()
    var customOption = $("#customOption").val()
    var extract_id = $("#extract_id").is(":checked")
    var amount_minimum = $("#amount_minimum").val()
    var amount_maximum = $("#amount_maximum").val()
    var warn_msg = $('#warn_msg').summernote('code');
    
    var type = "saveServiceChild"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/service-child.php",
        data: {
            id: $(data).attr('data-id'),
            service,
            name,
            icon,
            customOption,
            extract_id,
            reactions_arr: reactions_arr.toString(),
            amount_minimum,
            amount_maximum,
            warn_msg,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function deleteServiceChild(data){
    var id = $(data).attr('data-id')
    var type = "deleteServiceChild"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/service-child.php",
        data: {
            id,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-trash-alt"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $("#child_" + id).remove()
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function actionOrder(data){
    var action = $(data).attr('data-action')
    var type = "actionOrder"
    var isBack = false

    if(totalCode <= 0){
        jzonAlert('Không có đơn nào để thao tác hàng loạt', 'error')
        return
    }

    if(action == 'fail') {
        Swal.fire({
            title: 'Hoàn tiền đơn hàng',
            text: "Vì bạn đang chọn HỦY, nếu hoàn tiền vui lòng chọn HOÀN TIỀN",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: 'Hoàn tiền'
            }).then((result) => {
            if (result.isConfirmed) {
                isBack = true
            }else{
                isBack = false
            }
            $.ajax({
                type: "POST",
                url: "/ajaxs/admin/manage/order.php",
                data: {
                    type,
                    orderCode,
                    totalCode,
                    action,
                    isBack,
                    jzon: true
                },
                dataType: "json",
                beforeSend: function(){
                    $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
                },
                complete: function(){
                    switch(action){
                        case 'done':
                            $(data).html('<i class="fas fa-check-square"></i> Hoàn tất').removeAttr('disabled')   
                            break;
                        case 'running':
                            $(data).html('<i class="fas fa-running"></i> Đang chạy').removeAttr('disabled')   
                            break;
                        case 'fail':
                            $(data).html('<i class="fas fa-times-circle"></i> Hủy').removeAttr('disabled')   
                            break;
                        case 'delete':
                            $(data).html('<i class="fas fa-trash-alt"></i> Xóa').removeAttr('disabled')   
                            break;
                    }
                },
                success: function (res) {
                    if(res.success){
                        jzonAlert(res.success, 'success')
                        setTimeout(function(){
                            window.location.reload()
                        }, 1200)
                    }else{
                        jzonAlert(res.error, 'error')
                    }
                }
            });
        })
    }else if(action == 'message'){
        Swal.fire({
            title: "Nội dung tin nhắn",
            html: `<input type="text" id="message" class="swal2-input" placeholder="Bạn muốn nhắn gì đến người mua ?">`,
            confirmButtonText: "Gửi ngay",
            focusConfirm: false,
            preConfirm: () => {
                const message = Swal.getPopup().querySelector("#message").value;
                if (!message) {
                    Swal.showValidationMessage(`Vui lòng nhập nội dung tin nhắn`);
                }
                return { message: message };
            },
        }).then((result) => {
            $.ajax({
                type: "POST",
                url: "/ajaxs/admin/manage/order.php",
                data: {
                    type,
                    orderCode,
                    totalCode,
                    action,
                    message: result.value.message,
                    jzon: true
                },
                dataType: "json",
                beforeSend: function(){
                    $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
                },
                complete: function(){
                    switch(action){
                        case 'done':
                            $(data).html('<i class="fas fa-check-square"></i> Hoàn tất').removeAttr('disabled')   
                            break;
                        case 'running':
                            $(data).html('<i class="fas fa-running"></i> Đang chạy').removeAttr('disabled')   
                            break;
                        case 'fail':
                            $(data).html('<i class="fas fa-times-circle"></i> Hủy').removeAttr('disabled')   
                            break;
                        case 'delete':
                            $(data).html('<i class="fas fa-trash-alt"></i> Xóa').removeAttr('disabled')   
                            break;
                    }
                },
                success: function (res) {
                    if(res.success){
                        jzonAlert(res.success, 'success')
                        setTimeout(function(){
                            window.location.reload()
                        }, 1200)
                    }else{
                        jzonAlert(res.error, 'error')
                    }
                }
            });
        });
    }else{
        $.ajax({
            type: "POST",
            url: "/ajaxs/admin/manage/order.php",
            data: {
                type,
                orderCode,
                totalCode,
                action,
                jzon: true
            },
            dataType: "json",
            beforeSend: function(){
                $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
            },
            complete: function(){
                switch(action){
                    case 'done':
                        $(data).html('<i class="fas fa-check-square"></i> Hoàn tất').removeAttr('disabled')   
                        break;
                    case 'running':
                        $(data).html('<i class="fas fa-running"></i> Đang chạy').removeAttr('disabled')   
                        break;
                    case 'fail':
                        $(data).html('<i class="fas fa-times-circle"></i> Hủy').removeAttr('disabled')   
                        break;
                    case 'delete':
                        $(data).html('<i class="fas fa-trash-alt"></i> Xóa').removeAttr('disabled')   
                        break;
                }
            },
            success: function (res) {
                if(res.success){
                    jzonAlert(res.success, 'success')
                    setTimeout(function(){
                        window.location.reload()
                    }, 1200)
                }else{
                    jzonAlert(res.error, 'error')
                }
            }
        });
    }
    

    
}

function changePassword(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/users/personal/changePassword.php",
        data: {
            password: $("#password").val(),
            newPassword: $("#newPassword").val(),
            renewPassword: $("#renewPassword").val(),
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-lock"></i> ĐỔI MẬT KHẨU').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function showMoreServiceChild(){
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/server.php",
        data: {
            service: $("#service").val(),
            type: "showMoreServiceChild",
            jzon: true
        },
        dataType: "text",
        success: function (res) {
            $("#serviceChild").html(res)
        }
    });
}

function addServer(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/server.php",
        data: {
            service: $("#service").val(),
            serviceChild: $("#serviceChild").val(),
            note: $("#note").val(),
            price: $("#price").val(),
            max_order: $("#max_order").val(),
            display: $("#display").val(),
            type: "addServer",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-plus"></i> THÊM NGAY').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(() => {
                    window.location.reload();
                }, 1200);
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function deleteServer(data){
    var id = $(data).attr('data-id')
    var type = "deleteServer"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/server.php",
        data: {
            id,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-trash-alt"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $("#sv_" + id).remove()
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function infoServer(data){
    var id = $(data).attr('data-id')
    var type = "infoServer"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/server.php",
        data: {
            id,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-edit"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $("#jzon_key").val(res.key)
                $("#jzon_note").val(res.note)
                $("#jzon_price").val(res.price)
                $("#jzon_max_order").val(res.max_order)
                $("#jzon_display").html(res.display)
                $("#editServerModal").modal('show')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveServer(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/server.php",
        data: {
            key: $("#jzon_key").val(),
            note: $("#jzon_note").val(),
            price: $("#jzon_price").val(),
            max_order: $("#jzon_max_order").val(),
            display: $("#jzon_display").val(),
            type: "saveServer",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function requestCard(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/users/recharge/card.php",
        data: {
            telco: $("#telco").val(),
            amount: $("#amount").val(),
            pin: $("#pin").val(),
            serial: $("#serial").val(),
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-paper-plane"></i>&nbsp;&nbsp;NẠP THẺ NGAY').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(function(){ window.location.reload() }, 1200);
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveRecharge(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/recharge.php",
        data: {
            memo_mode: $("#memo_mode").val(),
            memo_name: $("#memo_name").val(),
            type: "saveRecharge",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveCardRecharge(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/recharge.php",
        data: {
            api_card1s: $("#api_card1s").val(),
            card_note: $('#card_note').summernote('code'),
            type: "saveRecharge",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveBankRecharge(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/recharge.php",
        data: {
            banking_note: $('#banking_note').summernote('code'),
            type: "saveRecharge",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveVCBRecharge(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/recharge.php",
        data: {
            vcb_owner: $("#vcb_owner").val(),
            vcb_stk: $("#vcb_stk").val(),
            vcb_token: $("#vcb_token").val(),
            vcb_note: $("#vcb_note").val(),
            type: "saveRecharge",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}
function saveMomoRecharge(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/recharge.php",
        data: {
            momo_owner: $("#momo_owner").val(),
            momo_phone: $("#momo_phone").val(),
            momo_token: $("#momo_token").val(),
            momo_note: $("#momo_note").val(),
            type: "saveRecharge",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveZaloPayRecharge(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/recharge.php",
        data: {
            zalo_owner: $("#zalo_owner").val(),
            zalo_phone: $("#zalo_phone").val(),
            zalo_token: $("#zalo_token").val(),
            zalo_note: $("#zalo_note").val(),
            type: "saveRecharge",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function addBank(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/recharge.php",
        data: {
            logo_bank: $("#logo_bank").val(),
            owner: $("#owner").val(),
            number_account: $("#number_account").val(),
            branch: $("#branch").val(),
            note: $("#note").val(),
            type: "addBank",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-plus"></i> THÊM NGÂN HÀNG/VÍ ĐIỆN TỬ').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(function(){ window.location.reload() }, 1200);
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function showRechargeModal(data){
    var id = $(data).attr('data-id')
    var type = "infoBank"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/recharge.php",
        data: {
            id,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-edit"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $("#jzon_id").val(res.id)
                $("#jzon_logo_bank").val(res.logo_bank)
                $("#jzon_owner").val(res.owner)
                $("#jzon_number_account").val(res.number_account)
                $("#jzon_branch").val(res.branch)
                $("#jzon_note").val(res.note)
                $("#editRechargeModal").modal('show')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveRechargeModal(data){
    var type = "saveBank"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/recharge.php",
        data: {
            id: $("#jzon_id").val(),
            logo_bank: $("#jzon_logo_bank").val(),
            owner: $("#jzon_owner").val(),
            number_account: $("#jzon_number_account").val(),
            branch: $("#jzon_branch").val(),
            note: $("#jzon_note").val(),
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function deleteRecharge(data){
    var id = $(data).attr('data-id')
    var type = "deleteBank"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/recharge.php",
        data: {
            id,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-trash-alt"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $("#recharge_" + id).remove()
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function encodePassword(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/extensions/encodePassword.php",
        data: {
            password: $("#password_en").val(),
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')    
        },
        complete: function(){
            $(data).html('<i class="fas fa-code"></i> Mã hóa ngay').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $(".result").show()
                $("#password_result").val(res.encode).attr('onclick', 'jzonCopy("' + res.encode + '")')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveSetting(data){
    var type = $(data).attr('data-type')

    switch(type){
        case 'website':
            var password_admin = $("#password_admin").val()
            var website_name = $("#website_name").val()
            var keyword = $("#keyword").val()
            var description = $("#description").val()
            var og_image = $("#og_image").val()
            var favicon = $("#favicon").val()
            var logo = $("#logo").val()
            var nofication = $('#nofication').summernote('code');
    
            var discount_member = $("#discount_member").val()
            var discount_ctv = $("#discount_ctv").val()
            var discount_agency = $("#discount_agency").val()
        
            var color_navbar = $("#color_navbar").val()
            var color_logo = $("#color_logo").val()
            var color_header = $("#color_header").val()
            var theme_mode = $("#theme_mode").val()

            var plugin_js = $("#plugin_js").val()

            $.ajax({
                type: "POST",
                url: "/ajaxs/admin/setting/website.php",
                data: {
                    password_admin,
                    website_name,
                    keyword,
                    description,
                    og_image,
                    favicon,
                    logo,
                    nofication,
                    color_header,
                    color_logo,
                    color_navbar,
                    theme_mode,
                    plugin_js,
                    discount_member,
                    discount_ctv,
                    discount_agency,
                    jzon: true
                },
                dataType: "json",
                beforeSend: function(){
                    $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')    
                },
                complete: function(){
                    $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
                },
                success: function (res) {
                    if(res.success){
                        jzonAlert(res.success, 'success')
                    }else{
                        jzonAlert(res.error, 'error')
                    }
                }
            });
            break;
        
        case 'landing_page':
            var landing_describe = $("#landing_describe").val()
            var landing_page = $("#landing_page").val()


            $.ajax({
                type: "POST",
                url: "/ajaxs/admin/setting/landing_page.php",
                data: {
                    landing_describe,
                    landing_page,
                    jzon: true
                },
                dataType: "json",
                beforeSend: function(){
                    $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')    
                },
                complete: function(){
                    $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
                },
                success: function (res) {
                    if(res.success){
                        jzonAlert(res.success, 'success')
                    }else{
                        jzonAlert(res.error, 'error')
                    }
                }
            });
            break;

    }
}

/*
    XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA
*/

function maintenanceMode(data){
    var maintenance_mode = $(data).attr('data-mode')

    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/setting/maintenance.php",
        data: {
            maintenance_mode,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')    
        },
        complete: function(){
            $(data).removeAttr('disabled').html('<i class="fas fa-power-off"></i>')
            if(maintenance_mode == 'off'){
                $(".power-on").hide()
                $(".power-off").show()
            }
            if(maintenance_mode == 'on'){
                $(".power-off").hide()
                $(".power-on").show()
            }
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveNofication(data){
    var tele_token = $("#tele_token").val()
    var tele_chatid = $("#tele_chatid").val()

    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/setting/nofication.php",
        data: {
            tele_token,
            tele_chatid,
            type: "nofication",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')    
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveJzonNofication(data){
    var nofication_new_member = $("#nofication_new_member").is(":checked")
    var nofication_login_member = $("#nofication_login_member").is(":checked")
    var nofication_like_post = $("#nofication_like_post").is(":checked")
    var nofication_new_order = $("#nofication_new_order").is(":checked")
    var nofication_success_card = $("#nofication_success_card").is(":checked")
    var nofication_momo = $("#nofication_momo").is(":checked")
    var nofication_vcb = $("#nofication_vcb").is(":checked")
    var nofication_zalopay = $("#nofication_zalopay").is(":checked")
    var nofication_new_support = $("#nofication_new_support").is(":checked")
    var nofication_reply_support = $("#nofication_reply_support").is(":checked")
    var nofication_action_support = $("#nofication_action_support").is(":checked")
    var nofication_changepass_member = $("#nofication_changepass_member").is(":checked")
    var nofication_detect_bot = $("#nofication_detect_bot").is(":checked")

    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/setting/nofication.php",
        data: {
            nofication_new_member,
            nofication_login_member,
            nofication_like_post,
            nofication_new_order,
            nofication_success_card,
            nofication_momo,
            nofication_vcb,
            nofication_zalopay,
            nofication_new_support,
            nofication_reply_support,
            nofication_action_support,
            nofication_changepass_member,
            nofication_detect_bot,
            type: "jzonNofication",
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')    
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function addSupportProblem(data){
    var prob = $("#prob_name").val()
    var type = "addSupportProblem"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/add/support/problem.php",
        data: {
            prob,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-plus"></i> THÊM NGAY').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
                setTimeout(() => {
                    window.location.reload()
                }, 1200);
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function deleteSupportProblem(data){
    var id = $(data).attr('data-id')
    var type = "deleteSupportProblem"
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/add/support/problem.php",
        data: {
            id,
            type,
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-trash-alt"></i>').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                $("#sg_" + id).remove()
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}

function saveSupportCaution(data){
    $.ajax({
        type: "POST",
        url: "/ajaxs/admin/manage/support/caution.php",
        data: {
            support_caution: $('#support_caution').summernote('code'),
            jzon: true
        },
        dataType: "json",
        beforeSend: function(){
            $(data).html($(data).attr('data-loading')).attr('disabled', 'disabled')  
        },
        complete: function(){
            $(data).html('<i class="fas fa-save"></i> LƯU THAY ĐỔI').removeAttr('disabled')   
        },
        success: function (res) {
            if(res.success){
                jzonAlert(res.success, 'success')
            }else{
                jzonAlert(res.error, 'error')
            }
        }
    });
}