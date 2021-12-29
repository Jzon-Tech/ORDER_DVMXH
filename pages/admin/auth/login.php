<?php 
    $admin_page = true;
    $title = "Đăng nhập";

    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon']) && !isset($_SESSION['admin'])){
        $password = xss($_POST['password']);

        if(!$password){
            $res['error'] = "Trường password không được để trống.";
            die(json_encode($res));
        }else{
            if(typePassword($password) == setting('password_admin')){
                $_SESSION['admin'] = true;
                $res['success'] = true;
                die(json_encode($res));
            }else{
                $res['error'] = "Mật khẩu không đúng, xác thực thất bại";
                die(json_encode($res));
            }
        }

        $res['error'] = "test123";
        die(json_encode($res));
    }

    require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
?>
<style>
  .body-container {
    background-image: linear-gradient(#6baace, #264783);
    background-attachment: fixed;
    background-repeat: no-repeat;
  }

  .carousel-item>div {
    height: 100%;
    background-size: cover;
    background-repeat: no-repeat;
    background-position: center;
  }

  /* these rules are used to make sure in mobile devices, tab panes are not all the same height (for example 'forgot' pane is not as tall as 'signup' pane) */

  @media (max-width: 1199.98px) {
    .tab-sliding .tab-pane:not(.active) {
      max-height: 0 !important;
    }

    .tab-sliding .tab-pane.active {
      min-height: 80vh;
      max-height: none !important;
    }
  }
</style>
<body>
    <div class="body-container">
        <div class="main-container container bgc-transparent">
            <div class="main-content minh-100 justify-content-center">
                <div class="p-2 p-md-4">
                    <div class="row" id="row-1">
                        <div class="col-12 col-xl-10 offset-xl-1 bgc-white shadow radius-1 overflow-hidden">
                            <div class="row" id="row-2">
                                <div id="id-col-intro" class="col-lg-5 d-none d-lg-flex border-r-1 brc-default-l3 px-0">
                                    <!-- the left side section is carousel in this demo, to show some example variations -->

                                    <div id="loginBgCarousel" class="carousel slide minw-100 h-100">
                                        <ol class="d-none carousel-indicators">
                                            <li data-target="#loginBgCarousel" data-slide-to="0" class="active"></li>
                                        </ol>

                                        <div class="carousel-inner minw-100 h-100">
                                            <div class="carousel-item active minw-100 h-100">
                                                <!-- default carousel section that you see when you open login page -->
                                                <div class="px-3 bgc-blue-l4 d-flex flex-column align-items-center justify-content-center">
                                                    <a class="mt-5 mb-2" href="">
                                                        <i class="fa fa-leaf text-success-m2 fa-3x"></i>
                                                    </a>

                                                    <h2 class="text-primary-d1">Quản trị viên</h2>

                                                    <div class="mt-3 mx-4 text-dark-tp3">
                                                        <span class="text-120">
                                                            Bạn đang ở trang của Quản trị viên,<br />
                                                            vui lòng nhập mật khẩu xác thực để tiếp tục quản trị
                                                        </span>
                                                        <hr class="mb-1 brc-black-tp10" />
                                                    </div>

                                                    <div class="mt-auto mb-4 text-dark-tp2">
                                                        DucThanhIT Corp &copy; 2021
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div id="id-col-main" class="col-12 col-lg-7 py-lg-5 bgc-white px-0">

                                    <div class="tab-content tab-sliding border-0 p-0" data-swipe="right">
                                        <div class="tab-pane active show mh-100 px-3 px-lg-0 pb-3" id="id-tab-login">
                                            <!-- show this in desktop -->
                                            <div class="d-none d-lg-block col-md-6 offset-md-3 mt-lg-4 px-0">
                                                <h4 class="text-dark-tp4 border-b-1 brc-secondary-l2 pb-1 text-130">
                                                    <i class="fa fa-coffee text-orange-m1 mr-1"></i>
                                                    Đăng nhập để tiếp tục
                                                </h4>
                                            </div>

                                            <!-- show this in mobile device -->
                                            <div class="d-lg-none text-secondary-m1 my-4 text-center">
                                                <a href="">
                                                    <i class="fa fa-leaf text-success-m2 text-200 mb-4"></i>
                                                </a>
                                                <h1 class="text-170">
                                                    <span class="text-blue-d1">Quản trị viên</span>
                                                </h1>
                                                Đăng nhập để tiếp tục
                                            </div>

                                            <form class="form-row mt-4" onsubmit="return false">
                                                <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3 mt-2 mt-md-1">
                                                    <div class="d-flex align-items-center input-floating-label text-blue brc-blue-m2">
                                                        <input placeholder="Mật khẩu xác thực" type="password" class="form-control form-control-lg pr-4 shadow-none" id="id-login-password" />
                                                        <i class="fa fa-key text-grey-m2 ml-n4"></i>
                                                        <label class="floating-label text-grey-l1 ml-n3" for="id-login-password">
                                                            Mật khẩu xác thực (BẮT BUỘC)
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="form-group col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3">
                                                    <button type="submit" class="btn btn-primary btn-block px-4 btn-bold mt-2 mb-4" id="adminLogin">
                                                        ĐĂNG NHẬP
                                                    </button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                    <!-- .tab-content -->
                                </div>
                            </div>
                            <!-- /.row -->
                        </div>
                        <!-- /.col -->
                    </div>
                    <!-- /.row -->

                    <div class="d-lg-none my-3 text-white-tp1 text-center"><i class="fa fa-leaf text-success-l3 mr-1 text-110"></i> DucThanhIT Corp &copy; 2021</div>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#adminLogin").on("click", function() {
            $.ajax({
                type: "POST",
                url: "",
                data: {
                    password: $("#id-login-password").val(),
                    jzon: true
                },
                dataType: "json",
                beforeSend: function(){
                    $("#adminLogin").html('<i class="fas fa-spinner fa-pulse"></i> ĐANG ĐĂNG NHẬP').attr('disabled', 'disabled')    
                },
                complete: function(){
                    $("#adminLogin").html('ĐĂNG NHẬP').removeAttr('disabled')   
                },
                success: function (res) {
                    if(res.success){
                        window.location.href = "/admin"
                    }else{
                        jzonAlert(res.error, 'error')
                    }
                }
            });
        });
    </script>

    <!-- include common vendor scripts used in demo pages -->
    <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/js/app.js?<?= time(); ?>"></script>
    <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/js/module.js?<?= time(); ?>"></script>
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.0/dist/js/bootstrap.min.js"></script>


    <!-- include vendor scripts used in "Dashboard" page. see "/views//pages/partials/dashboard/@vendor-scripts.hbs" -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.4/dist/Chart.min.js"></script>


    <script src="https://cdn.jsdelivr.net/npm/sortablejs@1.13.0/Sortable.min.js"></script>
    <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/admin/dist/js/ace.min.js"></script>

    <!-- "Login" page script to enable its demo functionality -->
    <script>
        jQuery(function ($) {
            // because "Login Here" and "Signup now" links are not inside a "UL" or ".nav", they preserve "active" class
            // and we should remove that, to be able to move between tab panes
            $('a[data-toggle="tab"]').on("click", function () {
                $('a[data-toggle="tab"]').removeClass("active");
            });

            // start/show carousel to change backgrounds
            $("#id-start-carousel").on("click", function (e) {
                e.preventDefault();
                $(".carousel-indicators").removeClass("d-none");
                $("#loginBgCarousel").carousel(1);
            });

            var isFullsize = false;

            // remove the background/carousel section
            // if you want a compact login page (without the carousel area), you should do so in your HTML
            // but in this demo, we modify HTML using JS
            $("#id-remove-carousel").on("click", function (e) {
                e.preventDefault();

                $("#id-col-intro").remove(); // remove the .col that contains carousel/intro
                $("#id-col-main").removeClass("col-lg-7"); // remove the col-* class name for the login area

                $("#row-1")
                    .addClass("justify-content-center") // so .col is centered

                    .find("> .col-12") // change .col-12.col-xl-10, etc to .col-12.col-lg-6.col-xl-5 (so our login area is 50% of document width in `lg` mode , etc)
                    .removeClass("col-12 col-xl-10 offset-xl-1")
                    .addClass(!isFullsize ? "col-12 col-lg-6 col-xl-5" : "");

                $(".col-md-8.offset-md-2.col-lg-6.offset-lg-3") // the input elements that are inside "col-sm-10 offset-sm-1 col-md-8 offset-md-2 col-lg-6 offset-lg-3" columns
                    // ... remove '.col-lg-6 offset-lg-3' (will become .col-md-8)
                    .removeClass("col-lg-6 offset-lg-3");

                // remove "Welcome Back" etc titles that were meant for desktop, and show the other titles that were meant for mobile (lg-) view
                // because this compact login page is similar to mobile view
                $("h4").each(function () {
                    var mobileTitle = $(this).parent().next();
                    if (mobileTitle.hasClass("d-lg-none")) mobileTitle.removeClass("d-lg-none").prev().remove();
                });
            });

            // make the login area fullscreen
            // if you want a fullscreen login page you should do so in your HTML
            // but in this demo, we modify HTML using JS
            $("#id-fullscreen").on("click", function (e) {
                e.preventDefault();
                if (window.navigator.msPointerEnabled) $(".body-container").addClass("h-100"); // for IE only

                isFullsize = true;

                $(".main-container").removeClass("container");

                $(".main-content").removeClass("justify-content-center minh-100").addClass("px-4 px-lg-0").children().attr("class", "d-flex flex-column flex-lg-row flex-grow-1 my-3 m-lg-0"); // removes padding classes and add d-flex, etc

                $("#row-1").addClass("flex-grow-1").find("> .col-12").removeClass("shadow radius-1 col-xl-10 offset-xl-1").addClass("d-lg-flex"); //remove shadow, etc from, the child .col and add d-lg-flex

                $("#row-2").addClass("flex-grow-1");

                $("#id-col-intro").removeClass("col-lg-5").addClass("col-lg-4");
                $("#id-col-main").removeClass("col-lg-7 offset-2").addClass("col-lg-6 mx-auto d-flex align-items-center justify-content-center");
            });
        });
    </script>
</body>
