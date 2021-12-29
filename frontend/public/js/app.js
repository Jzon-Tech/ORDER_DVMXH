/*
    XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA
*/


function showResult(msg, type, id){

	if(type == "error"){
		type = "danger"
	}

	$(id).html('<div class="alert alert-' + type + ' solid alert-dismissible fade show">' + msg + '</div>')
	$(id).show()
}

function jzonAlert(msg, type){
	var title;
	switch(type){
		case 'success':
			title = "Thành công";
			break;
		case 'error':
			title = "Lỗi";
			break;
		case 'warning':
			title = "Xác nhận";
			break;
	}
	Swal.fire(title, msg, type)
}

function isURL(str) {
    var pattern = new RegExp(
        "^(https?:\\/\\/)?" + // protocol
        "((([a-z\\d]([a-z\\d-]*[a-z\\d])*)\\.?)+[a-z]{2,}|" + // domain name
        "((\\d{1,3}\\.){3}\\d{1,3}))" + // OR ip (v4) address
        "(\\:\\d+)?(\\/[-a-z\\d%_.~+]*)*" + // port and path
        "(\\?[;&a-z\\d%_.~+=-]*)?" + // query string
        "(\\#[-a-z\\d_]*)?$",
        "i"
    ); // fragment locator
    return pattern.test(str);
}

function setCookie(cname, cvalue, exdays) {
    const d = new Date();
    d.setTime(d.getTime() + exdays * 24 * 60 * 60 * 1000);
    let expires = "expires=" + d.toUTCString();
    document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
}

function getCookie(cname) {
    let name = cname + "=";
    let decodedCookie = decodeURIComponent(document.cookie);
    let ca = decodedCookie.split(";");
    for (let i = 0; i < ca.length; i++) {
        let c = ca[i];
        while (c.charAt(0) == " ") {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}


function addMessageAdmin(data){
    var message = $(data).attr('data-message')
    $("#message").val(message)
}

function jzonCapitalize(string) {
    return string.charAt(0).toUpperCase() + string.slice(1);
}

function jzonCopy(value, id_result = false) {
    var tempInput = document.createElement("input");
    tempInput.style = "position: absolute; left: -1000px; top: -1000px";
    tempInput.value = value;
    document.body.appendChild(tempInput);
    tempInput.select();
    document.execCommand("copy");
    document.body.removeChild(tempInput);
    if(id_result != false){
        $(id_result).show()
        setTimeout(function(){
            $(id_result).hide()
        }, 1000)
    }
}