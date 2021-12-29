<?php
    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(setting('landing_page') != 'landing_3'){
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

        <!-- back to top area start -->
        <div class="back-to-top">
            <span class="back-top"><i class="fa fa-angle-up"></i></span>
        </div>
        <!-- back to top area end -->


        <div class="header-style-01">
            <!-- support bar area end -->
            <nav class="navbar navbar-area navbar-expand-lg nav-style-02">
                <div class="container nav-container startup-nav">
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
                            <a href="/home" class="boxed-btn btn-startup reverse-color">Truy cập ngay</a>
                            <?php }else{ ?>
                            <a href="/auth/create" class="boxed-btn btn-startup reverse-color">Tham gia ngay</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </nav>
            <!-- navbar area end -->
            </div>
            <div class="header-area header-startup header-bg" style="background-image:url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/startup/bg.png);">
                <div class="startup-bg-img wow animate__animated animate__zoomIn" data-parallax='{"x": 220, "y": 150}' style="background-image:url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/startup/01.png);"></div>
                <div class="shape"></div>
                <div class="shape-02"></div>
                <div class="container">
                    <div class="row">
                        <div class="col-lg-6">
                            <div class="header-inner">
                                <!-- header inner -->
                                <h1 class="title"><?= setting('website_name'); ?></h1>
                                <p><?= setting('landing_describe'); ?></p>
                                <div class="header-form-area">
                                    <div class="form-group">
                                        <?php if(isset($_SESSION['username'])) { ?>
                                            <a href="/home" class="submit-btn">Truy cập ngay</a>
                                        <?php }else{ ?>
                                            <a href="/auth/create" class="submit-btn">Tham gia ngay</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                            <!-- //.header inner -->
                        </div>
                    </div>
                </div>
            </div>
            <div class="header-bottom-area padding-bottom-85 ">
                <div class="container">
                    
                </div>
            </div>
            <!-- Build Your Following -->
            <div id="idea" class="build-area">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-8">
                            <div class="section-title desktop-center margin-bottom-55">
                                <h3 class="title social-title" style="text-transform: uppercase;">TẠI SAO NÊN CHỌN <?= setting('website_name'); ?> ?</h3>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-4 col-md-6">
                            <div class="single-everything-item">
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
                            <div class="single-everything-item">
                                <div class="icon style-01">
                                    <i class="fas fa-dollar-sign"></i>
                                </div>
                                <div class="content">
                                    <h3 class="title">CHI PHÍ RẤT THẤP</h3>
                                    <p>Dịch vụ mạng xã hội của <?= setting('website_name'); ?> cam kết giá rẻ nhất thị trường.</p>
                                </div>
                            </div>
                        </div>

                        <div class="col-lg-4 col-md-6">
                            <div class="single-everything-item">
                                <div class="icon style-02">
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
            <!--Destination Us -->
            <div id="overview" class="create-content-area padding-bottom-90 padding-top-75">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-7">
                            <div class="trip-img wow animate__animated animate__backInUp bg-image" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/bg/startup/01.png);"></div>
                        </div>
                        <div class="col-xl-4 offset-xl-1 col-lg-5">
                            <div class="create-content-wrap">
                                <div class="section-title startup padding-bottom-25">
                                    <h4 class="title">Lợi ích khi sử dụng dịch vụ tại <?= setting('website_name'); ?></h4>
                                    <ul class="content">
                                        <li><i aria-hidden="true" class="fas fa-check"></i>Hỗ trợ 24/24 vấn đề bạn gặp phải</li>
                                        <li><i aria-hidden="true" class="fas fa-check"></i>Giá tốt nhất, đội ngủ nhiệt tình
                                        </li>
                                        <li><i aria-hidden="true" class="fas fa-check"></i>Là website hàng đầu về dịch vụ mạng xã hội
                                        </li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!--Create Content-->
            <div class="create-content-area padding-bottom-110">
                <div class="container">
                    <div class="row">
                        <div class="col-xl-4 col-lg-6">
                            <div class="create-content-wrap">
                                <div class="section-title startup padding-bottom-25">
                                    <h4 class="title">Dịch vụ chuyên nghiệp </h4>
                                    <p>Với trên 5 năm làm việc trong lĩnh vực dịch vụ mạng xã hội được tin dùng bởi hàng nghìn khách hàng, <?= setting('website_name'); ?> không ngừng thay đổi nhằm đáp ứng nhu cầu ngày càng cao của khách hàng sử dụng mạng xã hội.</p>
                                    <div class="btn-wrapper padding-top-30">
                                        <?php if(isset($_SESSION['username'])) { ?>
                                            <a href="/home" class="btn-startup boxed-btn reverse-color">Truy cập ngay</a>
                                        <?php }else{ ?>
                                            <a href="/auth/create" class="btn-startup boxed-btn reverse-color">Tham gia ngay</a>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-6 offset-xl-2 col-lg-6">
                            <div class="trip-img wow animate__animated animate__backInDown bg-image" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/register/01.png);"></div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="offer-area padding-bottom-120 padding-top-110 bg-image" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/bg/startup/bg.png);">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-6">
                            <div class="section-title white startup desktop-center white">
                                <h3 class="title">Hơn 20.000 khách hàng đã sử dụng. Còn bạn ?</h3>
                                <div class="btn-wrapper margin-top-30">
                                    <?php if(isset($_SESSION['username'])) { ?>
                                        <a href="/home" class="boxed-btn btn-startup">Truy cập ngay</a>
                                    <?php }else{ ?>
                                        <a href="/auth/create" class="boxed-btn btn-startup">Tham gia ngay</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- testimonial area end -->
            <!-- Price Plan   -->
            <div id="pricing" class="price-plan-area padding-top-110 padding-bottom-80">
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
            <!-- Call to action -->
            <div class="call-to-action-area">
                <div class="container">
                    <div class="row">
                        <div class="col-lg-12">
                            <div class="call-to-action-inner style-01">
                                <div class="bg-image" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/call-to-action/01.png);"></div>
                                <h2 class="title">Bạn còn chần chừ gì nữa? </h2>
                                <div class="btn-wrapper">
                                    <?php if(isset($_SESSION['username'])) { ?>
                                        <a href="/home" class="boxed-btn btn-startup">Truy cập ngay</a>
                                    <?php }else{ ?>
                                        <a href="/auth/create" class="boxed-btn btn-startup">Tham gia ngay</a>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- footer area start -->
            <footer class="footer-area">
                <div class="copyright-area style-01">
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