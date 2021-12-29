<?php 
    $admin_page = true;
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
    require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

    if(isset($_POST['jzon'])){
        if(isset($_SESSION['admin'])){
            $status = xss($_POST['status']);
            $status_arr = ['all', 'done', 'wait', 'process'];

            if(in_array($status, $status_arr)){
                if($status == "all"){
                    $support_list_query = mysqli_query($conn, "SELECT * FROM `support_list` ORDER BY `id` DESC ");
                }else{
                    $support_list_query = mysqli_query($conn, "SELECT * FROM `support_list` WHERE `status` = '$status' ORDER BY `id` DESC ");

                }
                while($list = mysqli_fetch_assoc($support_list_query)) {

?>
<a href="/admin/manage/support/<?= $list['code']; ?>" class="card bg-gray my-4">
    <div class="card-body jzon_card" style="padding: 1.5rem!important;">
        <div class="row">
            <div class="col-auto">
                <img src="<?= avatarUser(); ?>" width="50" alt="user" class="active avatar-home" />
            </div>
            <div class="col pl-0">
                <div class="row">
                    <div class="col">
                        <h6>
                            <span class="cl-red mr-1" style="font-weight: bold;">#<?= $list['code']; ?>:</span>
                            <span class="cl-green" style="font-weight: bold;"><?= $list['title']; ?></span>
                        </h6>
                    </div>
                    <div class="col-auto">
                        <span class="float-right d-flex align-items-center hand cl-gray-2" style="font-size: 14px;">
                            Chi tiết&nbsp;<i class="fas fa-arrow-right"></i>
                        </span>
                    </div>
                </div>
                <div class="d-md-block d-none">
                    <div class="row">
                        <div class="col-auto">
                            <?= showStatusSupport($list['status']); ?>
                            <span class="badge text-white mr-2 badge-info"><?= $list['problem']; ?></span>
                        </div>
                        <div class="col text-right">
                            <?php 
                                $numReply = mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_message` WHERE `isReply` = '0' AND `code` = '".$list['code']."' ")); 
                                if($numReply > 20){
                                    $numReply = "20+";
                                }
                            ?>
                            <span class="badge badge-danger"><i class="fas fa-reply"></i>&nbsp;<?= $numReply; ?></span>
                            <span class="badge badge-primary"><i class="far fa-comment-dots"></i>&nbsp;<?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_message` WHERE `code` = '".$list['code']."' ")); ?></span>
                            <span class="badge badge-dark"><i class="far fa-clock"></i>&nbsp;<?= timeAgo($list['created_time']); ?></span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <h6 class="mb-0 align-items-center justify-content-between d-block d-md-none mt-2">
            <div class="row align-items-center">
                <div class="col">
                    <span class="badge bg-green-3 font-bold text-dark"><?= $list['username']; ?></span>
                </div>
                <div class="col-auto">
                    <span class="d-flex align-items-center cl-gray-2 font-13"><i class="far fa-clock"></i> <?= timeAgo($list['created_time']); ?></span>
                </div>
            </div>
            <div class="row align-items-center mt-2">
                <div class="col-auto">
                    <?= showStatusSupport($list['status']); ?>
                    <span class="badge text-white mr-2 badge-info"><?= $list['problem']; ?></span>
                </div>
                <div class="col text-right">
                    <span class="badge badge-primary">
                        <i class="far fa-comment-dots"></i>&nbsp;<?= mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `support_message` WHERE `code` = '".$list['code']."' ")); ?>
                    </span>
                </div>
            </div>
        </h6>
    </div>
</a>
<?php
                }   
            }
            
        }
    }

?>