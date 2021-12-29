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
            <div class="container nav-container sass-nav">
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
                        <a href="/home" class="boxed-btn btn-saas">Truy cập ngay</a>
                        <?php }else{ ?>
                        <a href="/auth/create" class="boxed-btn btn-saas">Tham gia ngay</a>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </nav>
        <!-- navbar area end -->
    </div>
    <div class="header-area header-sass">
        <div class="sass-bg-img-02" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/sass/bg.png);"></div>
        <div class="sass-bg-img wow animate__animated animate__zoomIn" data-parallax='{"x": 220, "y": 150}' style="background-image:url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/header-slider/sass/01.png);"></div>
        <div class="shape"></div>
        <div class="shape-02"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-7">
                    <div class="header-inner">
                        <!-- header inner -->
                        <h1 class="title"><?= setting('website_name'); ?></h1>
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
                <div class="col-lg-7">
                    <div class="section-title sass desktop-center margin-bottom-25">
                        <span style="text-transform: uppercase;">TẠI SAO NÊN CHỌN <?= setting('website_name'); ?> ?</span>
                        <h3 class="title">Website cung cấp dịch vụ mạng xã hội hàng đầu</h3>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-4 col-md-6">
                    <div class="single-service-item">
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
                    <div class="single-service-item">
                        <div class="icon style-02">
                            <i class="fas fa-dollar-sign"></i>
                        </div>
                        <div class="content">
                            <h3 class="title">CHI PHÍ RẤT THẤP</h3>
                            <p>Dịch vụ mạng xã hội của <?= setting('website_name'); ?> cam kết giá rẻ nhất thị trường.</p>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4 col-md-6">
                    <div class="single-service-item">
                        <div class="icon style-03">
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

    <!-- Call To Action -->
    <div class="call-to-action-area bg-image" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/call-to-action/bg.html);">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12">
                    <div class="call-to-action-inner style-02">
                        <div class="line-area">
                            <span class="line-one"></span>
                            <span class="line-two"></span>
                            <span class="line-three"></span>
                        </div>
                        <span class="bubble"></span>
                        <div class="action-bg-img" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/call-to-action/animation/dot.png);"></div>
                        <div class="action-bg-img-02" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/call-to-action/animation/cricle.png);"></div>
                        <div class="content">
                            <h2 class="title">Bạn còn chần chừ gì nữa</h2>
                            <p class="subtitle">Hơn 20.000 khách hàng đã sử dụng. Còn bạn ?</p>
                        </div>
                        <div class="btn-wrapper desktop-center">
                            <?php if(isset($_SESSION['username'])) { ?>
                            <a href="/home" class="boxed-btn">Truy cập ngay</a>
                            <?php }else{ ?>
                            <a href="/auth/create" class="boxed-btn">Tham gia ngay</a>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- testimonial area start  -->
    <section class="testimonial-area bg-image padding-top-100 padding-bottom-120" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/testimonial/sass/bg.png);">
        <div class="bg-img" style="background-image: url(https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/landing/assets/img/testimonial/sass/01.png);"></div>
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="testimonial-carousel-area">
                        <div class="testimonial-carousel">
                            <div class="single-testimonial-item-05">
                                <div class="icon">
                                    <i class="flaticon-quote-left"></i>
                                </div>
                                <div class="thumb">
                                    <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/images/zuck.png" alt="">
                                </div>
                                <div class="content">
                                    <div class="author-details">
                                        <div class="author-meta">
                                            <h4 class="title">Mark Zuckerberg</h4>
                                            <div class="designation">Co Founder Facebook, Inc</div>
                                        </div>
                                    </div>
                                    <p class="description">Mặc dù tôi là người sáng lập ra mạng xã hội Facebook nhưng tôi thấy <?= setting('website_name'); ?> là nơi cung cấp tương tác uy tín nhất.</p>
                                </div>
                            </div>
                            <div class="single-testimonial-item-05">
                                <div class="icon">
                                    <i class="flaticon-quote-left"></i>
                                </div>
                                <div class="thumb">
                                    <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/images/boy.png" alt="">
                                </div>
                                <div class="content">
                                    <div class="author-details">
                                        <div class="author-meta">
                                            <h4 class="title">Nhữ Văn Chiến</h4>
                                            <div class="designation">Hot Facebook-er</div>
                                        </div>
                                    </div>
                                    <p class="description">Tôi năm nay hơn 20 tuổi rồi chưa thấy website dịch vụ mạng xã hội nào uy tín như website này. Nên sử dụng nha các bạn ^^</p>
                                </div>
                            </div>
                            <div class="single-testimonial-item-05">
                                <div class="icon">
                                    <i class="flaticon-quote-left"></i>
                                </div>
                                <div class="thumb">
                                    <img src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/public/images/girl.png" alt="">
                                </div>
                                <div class="content">
                                    <div class="author-details">
                                        <div class="author-meta">
                                            <h4 class="title">Nguyễn Thùy Chi</h4>
                                            <div class="designation">Hot Tiktok-er</div>
                                        </div>
                                    </div>
                                    <p class="description">Nhờ sử dụng dịch vụ của <?= setting('website_name'); ?> mà tôi đã trở thành một hot tiktoker, trở nên nổi tiếng và có nhiều đơn quảng cáo hơn.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <!-- footer area start -->
    <footer class="footer-area">
        <div class="copyright-area style-02">
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