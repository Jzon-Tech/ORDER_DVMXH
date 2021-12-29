<?php
    if(isset($_SESSION['username'])){
        if(infoMe('banned') == 1){
            header('Location: /sorry/banned');
            exit;
        }
    }
?>
<?php if(jzonMobile()) { ?>

<body 
    style="font-size: 15px;" 
    data-typography="poppins" 
    data-theme-version="<?= setting('theme_mode'); ?>" 
    data-layout="vertical" 
    data-nav-headerbg="<?= setting('color_logo'); ?>" 
    data-headerbg="<?= setting('color_header'); ?>" 
    data-sidebar-style="overlay" 
    data-sibebarbg="<?= setting('color_navbar'); ?>" 
    data-sidebar-position="static"
    data-header-position="fixed" 
    data-container="wide" 
    direction="ltr" 
    data-primary="color_1" 
    onload="googleTranslateElementInit()"
>

<?php } else { ?>
<body 
    style="font-size: 15px;" 
    data-typography="poppins" 
    data-theme-version="<?= setting('theme_mode'); ?>" 
    data-layout="horizontal" 
    data-nav-headerbg="<?= setting('color_logo'); ?>" 
    data-headerbg="<?= setting('color_header'); ?>" 
    data-sidebar-style="full" 
    data-sibebarbg="<?= setting('color_navbar'); ?>" 
    data-sidebar-position="fixed"
    data-header-position="fixed" 
    data-container="wide" 
    direction="ltr" 
    data-primary="color_1"
    onload="googleTranslateElementInit()"
>
<?php } ?>

    <!--*******************
        Preloader start
    ********************-->
    <div id="preloader">
        <div class="waviy">
            <span style="--i: 1;">L</span>
            <span style="--i: 2;">o</span>
            <span style="--i: 3;">a</span>
            <span style="--i: 4;">d</span>
            <span style="--i: 5;">i</span>
            <span style="--i: 6;">n</span>
            <span style="--i: 7;">g</span>
            <span style="--i: 8;">.</span>
            <span style="--i: 9;">.</span>
            <span style="--i: 10;">.</span>
        </div>
    </div>
    <!--*******************
        Preloader end
    ********************-->

    <!--**********************************
        Main wrapper start
    ***********************************-->
    <div id="main-wrapper">
        <!--**********************************
            Nav header start
        ***********************************-->
        <div class="nav-header">
            <a href="/" class="brand-logo">
                <img src="<?= setting('favicon'); ?>" class="logo-abbr">
                <img src="<?= setting('logo'); ?>" class="brand-title">
            </a>
            <div class="nav-control">
                <div class="hamburger"><span class="line"></span><span class="line"></span><span class="line"></span></div>
            </div>
        </div>
        <!--**********************************
            Nav header end
        ***********************************-->

        <!--**********************************
            Header start
        ***********************************-->
        <div class="header">
            <div class="header-content">
                <nav class="navbar navbar-expand">
                    <div class="collapse navbar-collapse justify-content-between">
                        <div class="header-left">
                            <div class="dashboard_bar">
                                <?= $title; ?>
                            </div>
                        </div>
                        <ul class="navbar-nav header-right">
                            <li class="nav-item dropdown header-profile">
                                <a class="nav-link" href="javascript:void(0);" role="button" data-bs-toggle="dropdown">
                                    <img src="<?= avatarUser(); ?>" alt="" />
                                    <div class="header-info ms-3">
                                        <span><?= showName(); ?></span>
                                        <?php if(isset($_SESSION['username'])) { ?>
                                        <small><?= number_format(infoMe('cash')); ?> VNĐ</small>
                                        <?php } ?>
                                    </div>
                                </a>
                                <div class="dropdown-menu dropdown-menu-end">
                                    <?php if(isset($_SESSION['username'])) { ?>
                                        <a href="/personal/information" class="dropdown-item ai-icon">
                                            <i class="fas fa-user"></i>
                                            <span class="ms-2">Thông tin tài khoản </span>
                                        </a>
                                        <a href="/personal/log" class="dropdown-item ai-icon">
                                            <i class="fas fa-history"></i>
                                            <span class="ms-2">Nhật kí hoạt động </span>
                                        </a>
                                        <a href="/auth/logout" class="dropdown-item ai-icon">
                                            <i class="fas fa-sign-out-alt"></i>
                                            <span class="ms-2">Đăng xuất </span>
                                        </a>
                                    <?php }else{ ?>
                                        <a href="/auth/login" class="dropdown-item ai-icon">
                                            <i class="fas fa-sign-in-alt"></i>
                                            <span class="ms-2">Đăng nhập </span>
                                        </a>
                                        <a href="/auth/create" class="dropdown-item ai-icon">
                                            <i class="fas fa-plus"></i>
                                            <span class="ms-2">Tạo tài khoản </span>
                                        </a>
                                        <a href="/auth/reset" class="dropdown-item ai-icon">
                                            <i class="fas fa-fingerprint"></i>
                                            <span class="ms-2">Quên mật khẩu </span>
                                        </a>
                                    <?php } ?>
                                </div>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>
        <!--**********************************
            Header end ti-comment-alt
        ***********************************-->

        <!--**********************************
            Sidebar start
        ***********************************-->
        <div class="deznav">
            <div class="deznav-scroll">
                <ul class="metismenu" id="menu">
                    <li>
                        <a href="/" class="ai-icon" aria-expanded="false">
                            <i class="fas fa-home"></i>
                            <span class="nav-text">Trang chủ</span>
                        </a>
                    </li>
                    <?php 
                        $list_service = mysqli_query($conn, "SELECT * FROM `list_service` ");
                        while($service = mysqli_fetch_assoc($list_service)){
                            $fatherKey = $service['key']; 
                    ?>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="<?= $service['icon']; ?>"></i>
                            <span class="nav-text"><?= $service['name']; ?></span>
                        </a>
                        <ul aria-expanded="false">
                            <?php 
                                $list_service_child = mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `father` = '$fatherKey' ");
                                while($child = mysqli_fetch_assoc($list_service_child)) { 
                            ?>
                            <li>
                                <a href="/service/<?= $child['slug']; ?>" style="font-weight: bold;">
                                    <i style="color: white; font-size: 14px; margin-right: 4px!important;" class="<?= $child['icon']; ?>"></i>
                                    <?= $child['name']; ?>
                                </a>
                            </li>
                            <?php } ?>
                        </ul>
                    </li>
                    <?php } ?>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-coins"></i>
                            <span class="nav-text">Nạp tiền</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="/recharge/card">
                                    Thẻ cào tự động
                                </a>
                            </li>
                            <li>
                                <a href="/recharge/banking">
                                    Ngân hàng/Ví điện tử
                                </a>
                            </li>
                        </ul>
                    </li>
                    <li>
                        <a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
                            <i class="fas fa-life-ring"></i>
                            <span class="nav-text">Hỗ trợ</span>
                        </a>
                        <ul aria-expanded="false">
                            <li>
                                <a href="/support/create">
                                    Tạo yêu cầu hỗ trợ
                                </a>
                            </li>
                            <li>
                                <a href="/support/list">
                                    Hỗ trợ của bạn
                                </a>
                            </li>
                        </ul>
                    </li>
                    <?php if(infoMe('level') == 'admin'){ ?>
                    <li>
                        <a href="/admin" class="ai-icon" aria-expanded="false">
                            <i class="fas fa-tools"></i>
                            <span class="nav-text">Quản trị viên</span>
                        </a>
                    </li>
                    <?php } ?>
                </ul>
                <div class="copyright">
                    <p><strong><?= setting('website_name'); ?></strong> © 2021 All Rights Reserved</p>
                    <p class="fs-12">Developed with <span class="heart"></span> by DucThanh IT Corp</p>
                </div>
            </div>
        </div>
        <!--**********************************
            Sidebar end
        ***********************************-->
