<?php
    $admin_page = true;

    require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    $title = "Thống kê";

    require_once($_SERVER['DOCUMENT_ROOT']."/layout/head_admin.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/sidebar_admin.php");

    if(!isset($_SESSION['admin'])){
        header("Location: /admin/login");
        exit;
    }
?>
<style>
    .jzonText {
        font-size: 22px!important;
    }
</style>
    <div class="row">
        <div class="col-12 mt-35">
            <div class="row">
                <div class="col-12 col-sm-12">
                    <h4 class="jzonAdminTitle">Thành viên</h4>
                </div>
                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-orange-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-orange-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-orange-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users`")); ?>
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tổng thành viên
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fa fa-users text-orange opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>

                    <!-- /.ccard -->
                </div>

                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `banned` = '1' ")); ?>
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tổng thành viên bị khóa
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fa fa-lock text-danger opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>

                    <!-- /.ccard -->
                </div>

                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `users` WHERE `day` = '".date('d')."' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' ")); ?>
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Thành viên mới hôm nay
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fa fa-user-plus text-success opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>

                    <!-- /.ccard -->
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-sm-12">
                    <h4 class="jzonAdminTitle">Hỗ trợ</h4>
                </div>

                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-orange-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-orange-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-orange-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `status` = 'wait' ")); ?>
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Hỗ trợ cần duyệt
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fa fa-life-ring text-orange opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>

                    <!-- /.ccard -->
                </div>

                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-blue-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-blue-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-blue-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `status` = 'process' ")); ?>
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Hỗ trợ đang thực hiện
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fa fa-life-ring text-primary opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>

                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_list` WHERE `status` = 'done' ")); ?>
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Hỗ trợ đã hoàn tất
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fa fa-life-ring text-success opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>

            </div>
            <hr>
            <div class="row">
                <div class="col-12 col-sm-12">
                    <h4 class="jzonAdminTitle">Doanh thu & Đơn hàng</h4>
                </div>

                <div class="col-12 col-sm-3 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= number_format(mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(`total_cash`) FROM `order` WHERE `status` = 'done' AND `day` = '".date('d')."' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' "))['SUM(`total_cash`)']); ?> VNĐ
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Doanh thu hôm nay
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-money-bill text-success opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>

                    <!-- /.ccard -->
                </div>
                <div class="col-12 col-sm-3 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                <?= number_format(mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(`total_back`) FROM `order` WHERE `status` = 'fail' AND `day` = '".date('d')."' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' "))['SUM(`total_back`)']); ?> VNĐ
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tiền hoàn hôm nay
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-undo-alt text-danger opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>
                <div class="col-12 col-sm-3 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= number_format(mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(`total_cash`) FROM `order` WHERE `status` = 'done' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' "))['SUM(`total_cash`)']); ?> VNĐ
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Doanh thu tháng này
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-money-bill text-success opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>

                <div class="col-12 col-sm-3 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= number_format(mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(`total_back`) FROM `order` WHERE `status` = 'fail' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' "))['SUM(`total_back`)']); ?> VNĐ
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tiền hoàn tháng này
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-undo-alt text-danger opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>

                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-orange-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-orange-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-orange-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE `status` = 'running' ")); ?>
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tổng đơn đang chạy
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-archive text-orange opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>
                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE `status` = 'done' ")); ?>
                                </span>
                            </div>
                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tổng đơn đã chạy
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-archive text-success opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>
                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `order` WHERE `status` = 'fail' ")); ?>
                                </span>
                            </div>
                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tổng đơn đã hủy
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-archive text-danger opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>
                
            </div>
            <hr>

            <div class="row">
                <div class="col-12 col-sm-12">
                    <h4 class="jzonAdminTitle">Nạp tiền</h4>
                </div>

                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= number_format(mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(`amount_recieve`) FROM `auto-card` WHERE `status` = 'success' AND `day` = '".date('d')."' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' "))['SUM(`amount_recieve`)']); ?> VNĐ
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tổng tiền thẻ cào hôm nay
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-sim-card text-success opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>

                    <!-- /.ccard -->
                </div>
                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= number_format(mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(`amount`) FROM `auto-momo` WHERE `day` = '".date('d')."' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' "))['SUM(`amount`)']); ?> VNĐ
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tổng tiền MOMO hôm nay
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-credit-card text-danger opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>
                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-blue-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-blue-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-v-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= number_format(mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(`amount`) FROM `auto-zalo-pay` WHERE `day` = '".date('d')."' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' "))['SUM(`amount`)']); ?> VNĐ
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tổng tiền Zalo Pay hôm nay
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-comment-dollar text-primary opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>
                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-green-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= number_format(mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(`amount_recieve`) FROM `auto-card` WHERE `status` = 'success' AND `month` = '".date('m')."' AND `year` = '".date('Y')."' "))['SUM(`amount_recieve`)']); ?> VNĐ
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tổng tiền thẻ cào tháng này
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-sim-card text-success opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>

                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-red-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= number_format(mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(`amount`) FROM `auto-momo` WHERE `month` = '".date('m')."' AND `year` = '".date('Y')."' "))['SUM(`amount`)']); ?> VNĐ
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tổng tiền MOMO tháng này
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-credit-card text-danger opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>
                <div class="col-12 col-sm-4 p-0 pos-rel mt-3 mt-sm-0 pt-0 pt-sm-0 jzonAdminCard">
                    <div class="ccard h-100 pt-2 pb-25 px-25 d-flex mx-2 overflow-hidden">
                        <!-- the colored circles on bottom right -->
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-blue-l3 opacity-3" style="width: 5.25rem; height: 5.25rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-blue-l2 opacity-5" style="width: 4.75rem; height: 4.75rem;"></div>
                        <div class="position-br mb-n5 mr-n5 radius-round bgc-blue-l1 opacity-5" style="width: 4.25rem; height: 4.25rem;"></div>

                        <div class="flex-grow-1 pl-25 pos-rel d-flex flex-column">
                            <div class="text-secondary-d4">
                                <span class="jzonText">
                                    <?= number_format(mysqli_fetch_assoc(mysqli_query($conn, "SELECT SUM(`amount`) FROM `auto-zalo-pay` WHERE `month` = '".date('m')."' AND `year` = '".date('Y')."' "))['SUM(`amount`)']); ?> VNĐ
                                </span>
                            </div>

                            <div class="mt-auto text-nowrap text-secondary-d2 text-105 letter-spacing mt-n1">
                                Tổng tiền Zalo Pay tháng này
                            </div>
                        </div>

                        <div class="ml-auto pr-1 align-self-center pos-rel text-125">
                            <i class="fas fa-comment-dollar text-primary opacity-1 fa-2x mr-25"></i>
                        </div>
                    </div>
                    <!-- /.ccard -->
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-sm-12 mt-3 mt-sm-0 cards-container" id="card-container-2">
                    <div class="card border-0 shadow-sm radius-0 mb-3" id="card-2" draggable="false" style="">
                        <div class="card-header bgc-primary-d1">
                            <h5 class="card-title text-white">
                                <i class="fa fa-table mr-2px"></i>
                                Hoạt động gần đây
                            </h5>
                        </div>

                        <div class="card-body bgc-transparent p-0 border-1 brc-primary-m3 border-t-0">
                            <div class="table-responsive">
                                <table class="table table-bordered table-striped" id="jzonTable1">
                                    <thead class="text-dark-l2 text-95">
                                        <tr>
                                            <th>
                                                <i class="far fa-user text-blue mr-1px"></i>
                                                User
                                            </th>

                                            <th>
                                                <i class="fa fa-at text-orange-d1 mr-1px"></i>
                                                Nội dung
                                            </th>

                                            <th>
                                                Ngày thực hiện
                                            </th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        <?php
                                            $log_query = mysqli_query($conn, "SELECT * FROM `log_system` ORDER BY `id` DESC LIMIT 20");
                                            while($log = mysqli_fetch_assoc($log_query)){ 
                                        ?>
                                        <tr>
                                            <td class="text-dark-m2"><?= $log['username']; ?></td>
                                            <td class="text-dark-m2"><?= $log['content']; ?></td>
                                            <td class="text-dark-m2"><?= formatDate($log['created_time']); ?></td>
                                        </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>

            </div>
        </div>
    </div>
    <script>
        $(function() {
            $("#jzonTable1").DataTable({
                'ordering': false
            })
        })
    </script>
<?php 
    require_once($_SERVER['DOCUMENT_ROOT']."/layout/foot_admin.php");
    
?>