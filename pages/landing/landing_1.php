<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(setting('landing_page') != 'landing_1'){
        die("Giao diện landing này chưa được cài đặt");
    }
?>
<!DOCTYPE html>
<!-- XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA -->
<html lang="en">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <title><?= setting('website_name'); ?> - <?= setting('landing_describe'); ?></title>
        <!-- favicon -->
        <link rel="icon" href="<?= setting('favicon'); ?>" sizes="20x20" type="image/png" />
        <!-- animate -->
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/animate.css" />
        <!-- bootstrap -->
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/bootstrap.min.css" />
        <!-- magnific popup -->
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/magnific-popup.css" />
        <!-- owl carousel -->
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/owl.carousel.min.css" />
        <!-- fontawesome -->
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/font-awesome.min.css" />
        <!-- flaticon -->
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/flaticon.css" />
        <!-- Hover CSS -->
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/hover-min.css" />
        <!-- Main Stylesheet -->
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/style.css" />
        <!-- responsive Stylesheet -->
        <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/responsive.css" />

        <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>

    </head>
    <!-- XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA -->
    <body>
        <!-- preloader area start -->
        <div class="preloader" id="preloader">
            <div class="preloader-inner">
                <div></div>
                <hr />
            </div>
        </div>
        <!-- preloader area end -->
        <div class="header-style-01">
            <!-- support bar area end -->
            <nav class="navbar navbar-area navbar-expand-lg nav-style-02">
                <div class="container nav-container">
                    <div class="responsive-mobile-menu">
                        <div class="logo-wrapper">
                            <a href="/" class="logo">
                                <img src="<?= setting('logo'); ?>" alt="" />
                            </a>
                        </div>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                            <span class="navbar-toggler-icon"></span>
                        </button>
                    </div>
                    <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                        <ul class="navbar-nav">
                            <li><a href="/home">Trang chủ</a></li>
                            <li class="menu-item-has-children current-menu-item">
                                <a href="#">Dịch vụ cung cấp</a>
                                <ul class="sub-menu">
                                    <?php
                                        $service_q = mysqli_query($conn, "SELECT * FROM `list_service` LIMIT 6");
                                        while($service = mysqli_fetch_assoc($service_q)) {
                                    ?>
                                    <li><a href="/home"><i class="<?= $service['icon']; ?>"></i> <?= $service['name']; ?></a></li>
                                    <?php } ?>
                                    <li><a href="/home">Một số dịch vụ khác</a></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <div class="nav-right-content">
                        <div class="btn-wrapper">
                            <?php if(isset($_SESSION['username'])) { ?>
                            <a href="/home" class="boxed-btn btn-business">Truy cập ngay</a>
                            <?php }else{ ?>
                            <a href="/auth/create" class="boxed-btn btn-business">Tham gia ngay</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- navbar area end -->
        </div>
        <div class="header-area header-business">
            <div class="business-bg-img wow animate__animated animate__zoomIn" data-parallax='{"x": 220, "y": 100}' style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/business/01.png);"></div>
            <div class="business-bg-img-02 wow animate__animated animate__zoomIn" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/business/bg.png);"></div>
            <div class="shape-02"></div>
            <div class="container">
                <div class="row">
                    <div class="col-lg-7">
                        <div class="header-inner">
                            <!-- header inner -->
                            <h1 class="title"><?= setting('website_name'); ?></h1>
                            <p><?= setting('landing_describe'); ?></p>
                            <div class="btn-wrapper padding-top-30">
                                <a href="/home" class="boxed-btn btn-business">Trải nghiệm ngay</a>
                            </div>
                        </div>
                        <!-- //.header inner -->
                    </div>
                </div>
            </div>
        </div>
        <div class="section-wrapper bg-image" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/bg/business/bg.png);">
            <!-- How to Get Started -->
            <div class="get-started-area padding-top-110">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="section-title white brand desktop-center padding-bottom-50">
                                <h3 class="title">DỊCH VỤ CHUYÊN NGHIỆP</h3>
                                <p><b><?= setting('website_name'); ?></b> tự hào là đơn vị đối tác cung cấp các dịch vụ marketing online một cách nhanh chóng và toàn diện đáp ứng đầy đủ yêu cầu của khách hàng khi kinh doanh phát triển trên internet. Đặc biệt là xu thế bán hàng online đang rất thịnh hành.</p>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="work-single-item-02">
                                <div class="icon">
                                    <div class="shape" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/bg/business/pattern.png);"></div>
                                    <div class="shape-02"></div>
                                    <i class="flaticon-contract"></i>
                                </div>
                                <div class="content">
                                    <h3 class="title">THU HÚT KHÁCH HÀNG TIỀM NĂNG</h3>
                                    <p>Tối ưu việc tiếp cận khách hàng tiềm năng của bạn trên mạng xã hội với quảng cáo.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="work-single-item-02">
                                <div class="icon">
                                    <div class="shape" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/bg/business/pattern.png);"></div>
                                    <div class="shape-02"></div>
                                    <i class="flaticon-contract"></i>
                                </div>
                                <div class="content">
                                    <h3 class="title">TĂNG TƯƠNG TÁC TÀI KHOẢN</h3>
                                    <p>Với các dịch vụ tăng like, theo dõi, chia sẻ, bình luận seeding bài viết giúp tăng tương tác nick.</p>
                                </div>
                            </div>
                        </div>
                        <div class="col-lg-4 col-md-6">
                            <div class="work-single-item-02">
                                <div class="icon">
                                    <div class="shape" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/bg/business/pattern.png);"></div>
                                    <div class="shape-02"></div>
                                    <i class="flaticon-contract"></i>
                                </div>
                                <div class="content">
                                    <h3 class="title">XÂY DỰNG UY TÍN CHO DOANH NGHIỆP</h3>
                                    <p>Với việc phổ biến thương hiệu trên các mạng xã hội sẽ tăng độ uy tín cho doanh nghiệp.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Create Content-->
            <div class="cover-your-area padding-bottom-120">
                <div class="container">
                    <div class="cover-your-wrap">
                        <div class="row">
                            <div class="col-lg-4">
                                <div class="cover-img bg-image-02 wow animate__animated animate__backInUp" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/cover/03.png);"></div>
                            </div>
                            <div class="col-lg-5 offset-lg-2">
                                <div class="unique-content-area">
                                    <div class="section-title white brand">
                                        <h4 class="title">Tại sao lại chọn <?= setting('website_name'); ?> ?</h4>
                                        <p>Với trên 5 năm làm việc trong lĩnh vực dịch vụ mạng xã hội được tin dùng bởi hàng nghìn khách hàng, <?= setting('website_name'); ?> không ngừng thay đổi nhằm đáp ứng nhu cầu ngày càng cao của khách hàng sử dụng mạng xã hội.</p>
                                        <div class="btn-wrapper padding-top-30">
                                        <?php if(isset($_SESSION['username'])) { ?>
                                            <a href="/home" class="boxed-btn btn-business blank">Truy cập ngay</a>
                                        <?php }else{ ?>
                                            <a href="/auth/create" class="boxed-btn btn-business blank">Tham gia ngay</a>
                                        <?php } ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="accoridions padding-bottom-120">
            <div class="container">
            </div>
        </div>
        <!-- Call to action -->
        <div class="call-to-action-area bg-image" style="margin-bottom: 100px;">
            <div class="container">
                <div class="call-to-action-inner style-06">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <h3 class="title">ĐỐI TÁC – KHÁCH HÀNG</h3>
                            <p style="margin-top: -19px; margin-bottom: 25px;" class="subtitle">Hơn 20.000 khách hàng đã sử dụng. Còn bạn ?</p>
                            
                            <?php if(isset($_SESSION['username'])) { ?>
                            <form class="subscribe-form" action="/home" style="display: block!important;">
                                <button type="submit" class="submit-btn" style="margin-left: -30px!important;">Trải nghiệm ngay</button>
                            </form>
                            <?php }else{ ?>
                            <form class="subscribe-form" action="/auth/create" style="display: block!important;">
                                <button type="submit" class="submit-btn" style="margin-left: -30px!important;">Tham gia ngay</button>
                            </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- footer area start -->
        <footer class="footer-area">
            <div class="copyright-area style-03">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="copyright-area-inner">
                                © <?= date('Y'); ?> <b><?= setting('website_name'); ?></b>. Vận hành bởi <a style="font-weight: bold;" href="https://jzontech.asia">Jzon Tech</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </footer>
        <!-- footer area end -->

        <!-- back to top area start -->
        <div class="back-to-top">
            <span class="back-top"><i class="fa fa-angle-up"></i></span>
        </div>
        <!-- back to top area end -->
        
        <!-- XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA -->
        
        <!-- jquery -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/jquery-2.2.4.min.js"></script>
        <!-- bootstrap -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/bootstrap.min.js"></script>
        <!-- magnific popup -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/jquery.magnific-popup.js"></script>
        <!-- wow -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/wow.min.js"></script>
        <!-- owl carousel -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/owl.carousel.min.js"></script>
        <!-- waypoint -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/waypoints.min.js"></script>
        <!-- Mail Validation -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/mail-validation.js"></script>
        <!-- Contact js -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/contact.js"></script>
        <!-- counterup -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/jquery.counterup.min.js"></script>
        <!-- Water effect -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/jquery.ripples-min.js"></script>
        <!-- VanillaTilt effect -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/tilt.jquery.js"></script>
        <!-- imageloaded -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/imagesloaded.pkgd.min.js"></script>
        <!-- isotope -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/isotope.pkgd.min.js"></script>
        <!-- parallax js -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/parallax.js"></script>
        <!-- main js -->
        <script src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/js/main.js"></script>
    </body>

</html>
