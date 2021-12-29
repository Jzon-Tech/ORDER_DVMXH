<body>
    <div class="body-container">
        <nav class="navbar navbar-expand-lg navbar-fixed navbar-blue">
            <div class="navbar-inner">
                <div class="navbar-intro justify-content-xl-between">
                    <button
                        type="button"
                        class="btn btn-burger burger-arrowed static collapsed ml-2 d-flex d-xl-none"
                        data-toggle-mobile="sidebar"
                        data-target="#sidebar"
                        aria-controls="sidebar"
                        aria-expanded="false"
                        aria-label="Toggle sidebar"
                    >
                        <span class="bars"></span>
                    </button>
                    <!-- mobile sidebar toggler button -->

                    <a class="navbar-brand text-white" href="#">
                        <i class="fa fa-user-secret" aria-hidden="true" style="margin-right: 10px;"></i>
                        <span>Quản trị</span>
                        <span>viên</span>
                    </a>
                    <!-- /.navbar-brand -->

                    <button type="button" class="btn btn-burger mr-2 d-none d-xl-flex" data-toggle="sidebar" data-target="#sidebar" aria-controls="sidebar" aria-expanded="true" aria-label="Toggle sidebar">
                        <span class="bars"></span>
                    </button>
                    <!-- sidebar toggler button -->
                </div>
                <!-- /.navbar-intro -->

                <div class="navbar-content">
                    <a class="navbar-toggler py-2" type="button" href="/home" >
                        <i style="color: white;" class="fas fa-home"></i>
                    </a>
                    <!-- mobile #navbarSearch toggler -->

                    <div class="collapse navbar-collapse navbar-backdrop" id="navbarSearch">
                        <div class="d-flex align-items-center ml-lg-4 py-1" >
                            <a href="/home" class="btn btn-success" style="margin-right: 10px;"><i class="fas fa-home"></i> Trở về trang chủ</a>
                            <a href="https://zalo.me/0966142061" class="btn btn-danger"><i class="fas fa-phone-alt"></i> Liên hệ hỗ trợ viên</a>
                        </div>
                    </div>
                </div>
                <!-- .navbar-content -->

                <!-- mobile #navbarMenu toggler button -->
                <button class="navbar-toggler ml-1 mr-2 px-1" type="button">
                    <span class="pos-rel">
                        <img class="border-2 brc-white-tp1 radius-round" width="36" src="https://i.ibb.co/LkXNxwK/132036217-1495206850673524-1667284798950224339-n-2.jpg" alt="Jason's Photo" />
                        <span class="bgc-warning radius-round border-2 brc-white p-1 position-tr mr-n1px mt-n1px"></span>
                    </span>
                </button>

                <div class="navbar-menu collapse navbar-collapse navbar-backdrop" id="navbarMenu">
                    <div class="navbar-nav">
                        <ul class="nav">
                            
                        </ul>
                        <!-- /.navbar-nav menu -->
                    </div>
                    <!-- /.navbar-nav -->
                </div>
                <!-- /#navbarMenu -->
            </div>
            <!-- /.navbar-inner -->
        </nav>
        <div class="main-container bgc-white">
            <div id="sidebar" class="sidebar sidebar-fixed expandable sidebar-light">
                <div class="sidebar-inner">
                    <div class="ace-scroll flex-grow-1" data-ace-scroll="{}">
                        <div class="sidebar-section my-2">
                            
                        </div>

                        <ul class="nav has-active-border active-on-right">
                            <li class="nav-item-caption">
                                <span class="fadeable pl-3">CHÍNH</span>
                                <span class="fadeinable mt-n2 text-125">&hellip;</span>
                            </li>

                            <li class="nav-item active">
                                <a href="/admin" class="nav-link">
                                    <i class="nav-icon fa fa-tachometer-alt"></i>
                                    <span class="nav-text fadeable">
                                        <span>Thống kê</span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>

                            <li class="nav-item-caption">
                                <span class="fadeable pl-3">QUẢN LÍ</span>
                                <span class="fadeinable mt-n2 text-125">&hellip;</span>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/manage/member" class="nav-link">
                                    <i class="nav-icon fas fa-users"></i>
                                    <span class="nav-text fadeable">
                                        <span>Thành viên</span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/manage/post" class="nav-link">
                                    <i class="nav-icon fas fa-copy"></i>
                                    <span class="nav-text fadeable">
                                        <span>Bài đăng</span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/manage/support" class="nav-link">
                                    <i class="nav-icon fas fa-life-ring"></i>
                                    <span class="nav-text fadeable">
                                        <span>Yêu cầu hỗ trợ</span>
                                        <span class="badge badge-warning" ><?= number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `status` = 'wait' "))); ?></span>
                                        <?php 
                                            $numReply = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_message` WHERE `isReply` = '0' ")); 
                                            if($numReply > 20){
                                                $numReply = "20+";
                                            }
                                        ?>
                                        <span class="badge badge-info"><?= $numReply; ?></span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle collapsed">
                                    <i class="nav-icon fas fa-shopping-cart"></i>
                                    <span class="nav-text">
                                        <span>Đơn hàng</span>
                                    </span>

                                    <b class="caret fa fa-angle-left rt-n90"></b>
                                </a>

                                <div class="submenu collapse">
                                    <ul class="submenu-inner">
                                        <?php 
                                            $service_query = mysqli_query($conn, "SELECT * FROM `list_service` ");
                                            while($service = mysqli_fetch_assoc($service_query)){ 
                                        ?>
                                        <li class="nav-item">
                                            <a href="#" class="nav-link dropdown-toggle collapsed">
                                                <i class="nav-icon <?= $service['icon']; ?>" style="margin-right: 10px;"></i>
                                                <span class="nav-text">
                                                    <span><?= $service['name']; ?></span>
                                                </span>

                                                <b class="caret fa fa-angle-left rt-n90"></b>
                                            </a>

                                            <div class="submenu collapse">
                                                <ul class="submenu-inner">
                                                    <?php 
                                                        $child_query = mysqli_query($conn, "SELECT * FROM `list_service_child` WHERE `father` = '".$service['key']."' ");
                                                        while($child = mysqli_fetch_assoc($child_query)) { 
                                                    ?>
                                                    <li class="nav-item">
                                                        <a href="/admin/manage/order/<?= $child['slug']; ?>" class="nav-link">
                                                            <i class="nav-icon <?= $child['icon']; ?>" style="margin-right:10px;"></i>
                                                            <span class="nav-text fadeable">
                                                                <span><?= $child['name']; ?></span>
                                                            </span>
                                                        </a>
                                                        <b class="sub-arrow"></b>
                                                    </li>
                                                    <?php } ?>
                                                </ul>
                                            </div>

                                            <b class="sub-arrow"></b>
                                        </li>
                                        <?php } ?>
                                    </ul>
                                </div>

                                <b class="sub-arrow"></b>
                            </li>


                            <li class="nav-item">
                                <a href="/admin/manage/service" class="nav-link">
                                    <i class="nav-icon fas fa-briefcase"></i>
                                    <span class="nav-text fadeable">
                                        <span>Dịch vụ</span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/manage/service-child" class="nav-link">
                                    <i class="nav-icon fas fa-briefcase"></i>
                                    <span class="nav-text fadeable">
                                        <span>Dịch vụ con</span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/manage/server" class="nav-link">
                                    <i class="nav-icon fas fa-server"></i>
                                    <span class="nav-text fadeable">
                                        <span>Máy chủ</span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/manage/recharge" class="nav-link" id="jzon2" data-toggle="tooltip" data-placement="top" title="" data-original-title="Quản lí các thông tin ngân hàng/ví điện tử/thẻ cào">
                                    <i class="nav-icon fas fa-credit-card"></i>
                                    <span class="nav-text fadeable" >
                                        <span>Nạp tiền</span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>

                            <script>
                                $(function(){
                                    $('#jzon2').tooltip({
                                        template: '<div class="tooltip" role="tooltip"><div class="brc-secondary-d3 arrow"></div><div class="bgc-secondary-d3 tooltip-inner text-105 text-600"></div></div>'
                                    })
                                })
                            </script>

                            <li class="nav-item-caption">
                                <span class="fadeable pl-3">LỊCH SỬ</span>
                                <span class="fadeinable mt-n2 text-125">&hellip;</span>
                            </li>

                            <li class="nav-item">
                                <a href="#" class="nav-link dropdown-toggle collapsed">
                                    <i class="nav-icon fas fa-history"></i>
                                    <span class="nav-text">
                                        <span>Lịch sử nạp tiền</span>
                                    </span>

                                    <b class="caret fa fa-angle-left rt-n90"></b>
                                </a>

                                <div class="submenu collapse">
                                    <ul class="submenu-inner">
                                        <li class="nav-item">
                                            <a href="/admin/history/recharge/card" class="nav-link">
                                                <span class="nav-text fadeable">
                                                    <span>Thẻ cào tự động</span>
                                                </span>
                                            </a>
                                            <b class="sub-arrow"></b>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/admin/history/recharge/momo" class="nav-link">
                                                <span class="nav-text fadeable">
                                                    <span>Ví MOMO</span>
                                                </span>
                                            </a>
                                            <b class="sub-arrow"></b>
                                        </li>
                                        <li class="nav-item">
                                            <a href="/admin/history/recharge/zalo-pay" class="nav-link">
                                                <span class="nav-text fadeable">
                                                    <span>Zalo Pay</span>
                                                </span>
                                            </a>
                                            <b class="sub-arrow"></b>
                                        </li>
                                    </ul>
                                </div>

                                <b class="sub-arrow"></b>
                            </li>

                            

                            <li class="nav-item-caption" style="margin-top: 0.5rem!important;">
                                <span class="fadeable pl-3">THÊM</span>
                                <span class="fadeinable mt-n2 text-125">&hellip;</span>
                            </li>
                            

                            <li class="nav-item">
                                <a href="/admin/add/message-suggest" class="nav-link" id="jzon1" style="margin-left: 5px; font-size: 15px;" data-toggle="tooltip" data-placement="top" title="" data-original-title="Thêm từ khóa tin nhắn hỗ trợ để chat nhanh bằng 1 cú click">
                                    <i class="nav-icon fas fa-comment-alt"></i>
                                    <span class="nav-text fadeable">
                                        <span>Từ khóa tin nhắn</span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>

                            <script>
                                $(function(){
                                    $('#jzon1').tooltip({
                                        template: '<div class="tooltip" role="tooltip"><div class="brc-secondary-d3 arrow"></div><div class="bgc-secondary-d3 tooltip-inner text-105 text-600"></div></div>'
                                    })
                                })
                            </script>

                            <li class="nav-item">
                                <a href="/admin/add/support/problem" class="nav-link">
                                    <i class="nav-icon fas fa-exclamation-circle"></i>
                                    <span class="nav-text fadeable">
                                        <span>Vấn đề hỗ trợ</span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>



                            <li class="nav-item-caption">
                                <span class="fadeable pl-3">CÀI ĐẶT</span>
                                <span class="fadeinable mt-n2 text-125">&hellip;</span>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/setting/website" class="nav-link">
                                    <i class="nav-icon fas fa-cog"></i>
                                    <span class="nav-text fadeable">
                                        <span>Trang web</span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>

                            <li class="nav-item">
                                <a href="/admin/setting/landing_page" class="nav-link">
                                    <i class="nav-icon fas fa-file"></i>
                                    <span class="nav-text fadeable">
                                        <span>Trang đích (LANDING)</span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>
                            
                            <li class="nav-item">
                                <a href="/admin/setting/nofication" class="nav-link">
                                    <i class="nav-icon fas fa-bell"></i>
                                    <span class="nav-text fadeable">
                                        <span>Thông báo</span>
                                    </span>
                                </a>
                                <b class="sub-arrow"></b>
                            </li>
                            
                        </ul>
                    </div>
                    <!-- /.sidebar scroll -->

                    <div class="sidebar-section">
                        <div class="sidebar-section-item fadeable-bottom">
                            <div class="fadeinable">
                                <!-- shows this when collapsed -->
                                <div class="pos-rel">
                                    <img alt="Alexa's Photo" src="https://<?= $_SERVER['SERVER_NAME']; ?>/frontend/admin/assets/image/avatar/avatar3.jpg" width="42" class="px-1px radius-round mx-2 border-2 brc-default-m2" />
                                    <span class="bgc-success radius-round border-2 brc-white p-1 position-tr mr-1 mt-2px"></span>
                                </div>
                            </div>

                            <div class="fadeable hideable w-100 bg-transparent shadow-none border-0">
                                <!-- shows this when full-width -->
                                <div id="sidebar-footer-bg" class="d-flex align-items-center bgc-white shadow-sm mx-2 mt-2px py-2 radius-t-1 border-x-1 border-t-2 brc-primary-m3">
                                    <div class="d-flex mr-auto py-1">
                                        <div class="pos-rel">
                                            <img alt="DucThanh IT" src="https://i.ibb.co/LkXNxwK/132036217-1495206850673524-1667284798950224339-n-2.jpg" width="42" class="px-1px radius-round mx-2 border-2 brc-default-m2" />
                                            <span class="bgc-success radius-round border-2 brc-white p-1 position-tr mr-1 mt-2px"></span>
                                        </div>

                                        <div>
                                            <span class="text-blue-d1 font-bolder">DucThanhIT Corp</span>
                                            <div class="text-80 text-grey">
                                                Jzon Dev
                                            </div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div role="main" class="main-content">
                <div class="page-content container container-plus">