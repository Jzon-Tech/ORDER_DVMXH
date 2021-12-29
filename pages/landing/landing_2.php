<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(setting('landing_page') != 'landing_2'){
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
                        <a href="/home" class="boxed-btn blank">Truy cập ngay</a>
                        <?php }else{ ?>
                        <a href="/auth/create" class="boxed-btn blank">Tham gia ngay</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
        <!-- navbar area end -->
    </div>
    <div class="header-area header-social header-bg" style="background-image:url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/social/bg.png);">
        <div class="social-bg-img outer" data-parallax='{"x": 220, "y": 150}' style="background-image:url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/social/01.png);"></div>
        <div class="social-bg-img-02 outer" data-parallax='{"x": 20, "y": 150}' style="background-image:url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/social/02.png);"></div>
        <div class="social-bg-img-03 outer" data-parallax='{"x": 20, "y": 150}' style="background-image:url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/social/03.png);"></div>
        <div class="social-bg-img-04 outer" data-parallax='{"x": 20, "y": 150}' style="background-image:url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/social/04.png);"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <div class="header-inner desktop-center">
                        <!-- header inner -->
                        <h1 class="title"><?= setting('website_name'); ?></h1>
                        <p><?= setting('landing_describe'); ?></p>
                        <div class="btn-wrapper  desktop-center padding-top-30">
                            <?php if(isset($_SESSION['username'])) { ?>
                            <a href="/home" class="boxed-btn btn-gradient">Truy cập ngay</a>
                            <?php }else{ ?>
                            <a href="/auth/create" class="boxed-btn btn-gradient">Tham gia ngay</a>
                            <?php } ?>    
                        </div>
                    </div>
                    <!-- //.header inner -->
                </div>
            </div>
        </div>
    </div>
    <div class="header-bottom-img m-top wow animate__animated animate__fadeInUp" data-parallax='{"x": 20, "y": 50}' style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/bg/social/03.png);"></div>
    <div class="header-bottom-area padding-top-110">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center padding-bottom-40">
                        <h3 class="title social-title" style="text-transform: uppercase;">TẠI SAO NÊN CHỌN <?= setting('website_name'); ?> ?</h3>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Build Your Following -->
    <div id="feature" class="build-area padding-bottom-75">
        <div class="container">
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-icon-box-01">
                        <div class="msg-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
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
                    <div class="single-icon-box-01">
                        <div class="msg-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
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
                    <div class="single-icon-box-01">
                        <div class="msg-icon">
                            <span></span>
                            <span></span>
                            <span></span>
                        </div>
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
    
    <!-- Price Plan   -->
    <div id="pricing" class="price-plan-area padding-bottom-90">
        <div class="bg-img" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/bg/social/01.png);"></div>
        <div class="bg-img-02" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/bg/social/02.png);"></div>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-8">
                    <div class="section-title desktop-center margin-bottom-55">
                        <h3 class="title social-title">Cấp bậc ưu đãi khách hàng </h3>
                        <p>Đa dạng các cấp bậc khác nhau và nhiều mức giá cực kì hấp dẫn. </p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-price-plan-01">
                        <div class="price-header">
                            <h4 class="title">Khách hàng</h4>
                            <div class="img-icon"><img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/price-plan/01.png" alt=""></div>
                        </div>
                        <div class="price-body" style="margin-top: 25px;">
                            <ul>
                                <li><i class="fa fa-check success"></i> Cấp bậc này không có ưu đãi.</li>
                            </ul>
                        </div>
                        <div class="price-footer">
                            <div class="btn-wrapper">
                                <a href="/home" class="boxed-btn">Xem Ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-price-plan-01">
                        <div class="price-header">
                            <h4 class="title">Cộng tác viên</h4>
                            <div class="img-icon"><img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/price-plan/02.png" alt=""></div>
                        </div>
                        <div class="price-body" style="margin-top: 25px;">
                            <ul>
                                <li><i class="fa fa-check success"></i> Có ưu đại giá dịch vụ cộng tác viên.</li>
                            </ul>
                        </div>
                        <div class="price-footer">
                            <div class="btn-wrapper">
                                <a href="/home" class="boxed-btn">Xem Ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-price-plan-01">
                        <div class="price-header">
                            <h4 class="title">Đại lý</h4>
                            <div class="img-icon"><img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/price-plan/03.png" alt=""></div>
                        </div>
                        <div class="price-body" style="margin-top: 25px;">
                            <ul>
                                <li><i class="fa fa-check success"></i> Có ưu đại giá dịch vụ đại lý.</li>
                            </ul>
                        </div>
                        <div class="price-footer">
                            <div class="btn-wrapper">
                                <a href="/home" class="boxed-btn">Xem Ngay</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Join Apps -->
    <div class="join-apps-area padding-bottom-90">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="bg-image wow animate__animated animate__fadeInUp">
                        <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/bg/social/bg.png" alt="">
                    </div>
                </div>
                <div class="col-lg-10">
                    <div class="section-title desktop-center padding-top-110">
                        <h3 class="title social-title">Hơn 20.000 khách hàng đã sử dụng. Còn bạn ?</h3>
                        <p>Chúng tôi cung cấp cho quý khách những giải pháp chuyên nghiệp phục vụ cho công việc tìm kiếm khách hàng, kinh doanh buôn bán hiệu quả trên internet. <?= setting('website_name'); ?> luôn là đối tác lớn mạnh của cá nhân, kinh doanh online, công ty, ca sĩ, doanh nghiệp,...</p>
                        <div class="apps-download">
                            <div class="download-link style-01">
                                <a href="/auth/login"> <i class="fas fa-sign-in-alt"></i>Đăng nhập</a>
                            </div>
                            <div class="download-link">
                                <a href="/auth/create"> <i class="fas fa-plus"></i>Tạo tài khoản</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- footer area start -->
    <footer class="footer-area">
        <div class="copyright-area">
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="copyright-item">
                            <div class="copyright-area-inner">
                                © <?= date('Y'); ?> <b><?= setting('website_name'); ?></b>. Vận hành bởi <a style="font-weight: bold;" href="https://jzontech.asia">Jzon Tech</a>
                            </div>
                            <div class="widget widget_nav_menu">
                                <ul class="social_share style-01">
                                    <li><a href="#"><i class="fab fa-linkedin-in"></i></a></li>
                                    <li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                    <li><a href="#"><i class="fab fa-twitter"></i></a></li>
                                </ul>
                            </div>
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