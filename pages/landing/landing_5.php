<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(setting('landing_page') != 'landing_5'){
        die("Giao diện landing này chưa được cài đặt");
    }
?>


<!DOCTYPE html>

<!-- XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA -->

<html lang="en">


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title><?= setting('website_name'); ?> - <?= setting('landing_describe'); ?></title>
        <!-- favicon -->
    <link rel="icon" href="<?= setting('favicon'); ?>" sizes="20x20" type="image/png" />
    <!-- animate -->
    <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/animate.css">
    <!-- bootstrap -->
    <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/bootstrap.min.css">
    <!-- magnific popup -->
    <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/magnific-popup.css">
    <!-- owl carousel -->
    <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/owl.carousel.min.css">
    <!-- fontawesome -->
    <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/font-awesome.min.css">
    <!-- flaticon -->
    <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/flaticon.css">
    <!-- Hover CSS -->
    <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/hover-min.css">
    <!-- Main Stylesheet -->
    <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/style.css">
    <!-- responsive Stylesheet -->
    <link rel="stylesheet" href="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/css/responsive.css">

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" integrity="sha384-AYmEC3Yw5cVb3ZcuHtOA93w35dYTsvhLPVnYs9eStHfGJvOvKxVfELGroGkvsg+p" crossorigin="anonymous"/>
</head>
<!-- XÂY DỰNG WEBSITE KIẾM TIỀN ONLINE MMO | LIÊN HỆ ZALO 0966142061 | JZONTECH.ASIA -->
<body>
    <!-- preloader area start -->
    <div class="preloader" id="preloader">
        <div class="preloader-inner">
            <div></div>
            <hr/>
        </div>
    </div>
    <!-- preloader area end -->
    <div class="header-style-01">
        <!-- support bar area end -->
        <nav class="navbar navbar-area navbar-expand-lg nav-style-02">
            <div class="container nav-container social-nav">
                <div class="responsive-mobile-menu">
                    <div class="logo-wrapper">
                        <a href="/" class="logo">
                            <img src="<?= setting('logo'); ?>" alt="">
                        </a>
                    </div>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#bizcoxx_main_menu" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>
                </div>
                <div class="collapse navbar-collapse" id="bizcoxx_main_menu">
                    <ul class="navbar-nav">
                        <li><a href="/home">Trang chủ</a></li>
                        <li class="menu-item-has-children">
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
                            <a href="/home" class="login-btn">Truy cập ngay</a>
                        <?php }else{ ?>
                            <a href="/auth/create" class="login-btn">Tham gia ngay</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
        <!-- navbar area end -->
    </div>
    <div class="header-area header-lifestyle header-bg" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/lifestyle/bg.png);">
        <div class="sass-bg-img wow animate__animated animate__zoomIn" data-parallax='{"x": 220, "y": 150}' style="background-image:url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/lifestyle/01.png);"></div>
        <div class="shape" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/lifestyle/rect.png);"></div>
        <div class="shape-02" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/lifestyle/rect-02.png);"></div>
        <div class="shape-03"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-3">
                    <div class="header-inner">
                        <!-- header inner -->
                        <h2 class="title"><?= setting('website_name'); ?></h2>
                        <p><?= setting('landing_describe'); ?></p>
                        <div class="btn-wrapper padding-top-30">
                            <?php if(isset($_SESSION['username'])) { ?>
                                <a href="/home" class="boxed-btn btn-saas reverse-color">Truy cập ngay</a>
                            <?php }else{ ?>
                                <a href="/auth/create" class="boxed-btn btn-saas reverse-color">Tham gia ngay</a>
                            <?php } ?>
                        </div>
                    </div>
                    <!-- //.header inner -->
                </div>
            </div>
        </div>
    </div>
    <!-- Build Your Following -->
    <div id="what" class="build-area padding-top-115">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title brand desktop-center padding-bottom-50">
                        <h3 class="title" style="text-transform: uppercase;">TẠI SAO NÊN CHỌN <?= setting('website_name'); ?> ?</h3>
                        <p><b><?= setting('website_name'); ?></b> tự hào là đơn vị đối tác cung cấp các dịch vụ marketing online một cách nhanh chóng và toàn diện đáp ứng đầy đủ yêu cầu của khách hàng khi kinh doanh phát triển trên internet. Đặc biệt là xu thế bán hàng online đang rất thịnh hành.</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-app-item">
                        <div class="icon">
                            <i class="fas fa-shield-alt"></i>
                        </div>
                        <div class="content">
                            <h3 class="title">BẢO MẬT THÔNG TIN</h3>
                            <p>Thông tin khách hàng cung cấp được <?= setting('website_name'); ?> bảo mật hoàn toàn.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-app-item">
                        <div class="icon">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="content">
                            <h3 class="title">CHI PHÍ RẤT THẤP</h3>
                            <p>Dịch vụ mạng xã hội của <?= setting('website_name'); ?> cam kết giá rẻ nhất thị trường.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-app-item">
                        <div class="icon">
                            <i class="fas fa-life-ring"></i>
                        </div>
                        <div class="content">
                            <h3 class="title">HỖ TRỢ NHIỆT TÌNH</h3>
                            <p>Đội ngũ nhân viên trẻ am hiểu mạng xã hội hỗ trợ khách hàng 24/7.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- How to Get Started -->
    <div class="get-started-area bg-image padding-bottom-120 padding-top-110" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/bg/lifestyle/bg.png);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title brand desktop-center padding-bottom-50">
                        <h3 class="title">CÁCH THỨC TẠO ĐƠN</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="started-single-item">
                        <div class="icon">
                            <i class="fas fa-wallet"></i>
                        </div>
                        <div class="content">
                            <h3 class="title">Nạp tiền vào tài khoản</h3>
                            <p>Website hỗ trợ nhiều cổng nạp tiền tự động khác nhau (Thẻ cào, Momo, Zalo Pay,...) </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="started-single-item">
                        <div class="icon">
                            <i class="fas fa-concierge-bell"></i>
                        </div>
                        <div class="content">
                            <h3 class="title">Chọn dịch vụ</h3>
                            <p>Vui lòng chọn dịch vụ mà bạn đang có nhu cầu với giá cực kì ưu đãi </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="started-single-item">
                        <div class="icon">
                            <i class="fas fa-check"></i>
                        </div>
                        <div class="content">
                            <h3 class="title">Tạo đơn ngay</h3>
                            <p>Điền đầy đủ thông tin đối tượng cần thực thi, số dư sẽ được trừ sau khi tạo đơn </p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="btn-wrapper desktop-center margin-top-20">
                        <?php if(isset($_SESSION['username'])) { ?>
                            <a href="/home" class="boxed-btn btn-saas reverse-color">Truy cập ngay</a>
                        <?php }else{ ?>
                            <a href="/auth/create" class="boxed-btn btn-saas reverse-color">Tham gia ngay</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonial area end -->
    <div class="client-area padding-bottom-85 padding-top-110">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center padding-bottom-40">
                        <h3 class="title social-title">Hơn 20.000 khách hàng đã sử dụng. Còn bạn ?</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Map Section -->
    <div class="map-section padding-top-200 padding-bottom-200 bg-image" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/map/bg.png);">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="section-title desktop-center">
                        <h3 class="title social-title">Bắt đầu sử dụng ngay hôm nay</h3>
                        <p>Dịch vụ của <b><?= setting('website_name'); ?></b> đã và đang được hàng trăm khách hàng tin dùng và sử dụng. Chúng tôi đã giúp hàng trăm khách hàng tiết kiệm được thời gian – tiền bạc, không những thế, còn đem lại hiệu và lợi ích trực tiếp, giúp khách hàng tiếp cận được người dùng một cách hiệu quả nhất.</p>
                        <div class="btn-wrapper padding-top-30 desktop-center">
                            <?php if(isset($_SESSION['username'])) { ?>
                                <a href="/home" class="boxed-btn btn-saas reverse-color">Truy cập ngay</a>
                            <?php }else{ ?>
                                <a href="/auth/create" class="boxed-btn btn-saas reverse-color">Tham gia ngay</a>
                            <?php } ?>
                        </div>
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