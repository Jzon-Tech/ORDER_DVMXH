<?php 
	require_once($_SERVER['DOCUMENT_ROOT']."/core/database.php");
	require_once($_SERVER['DOCUMENT_ROOT']."/core/function.php");

	if(isset($_POST['jzon']) && isset($_POST['numPost'])){
		$numPost = intval($_POST['numPost']) + 10;
?>
	<?php 
		$newsfeed_query = mysqli_query($conn, "SELECT * FROM `newsfeed` ORDER BY `id` DESC LIMIT $numPost");
		while($news = mysqli_fetch_assoc($newsfeed_query)){
	?>
	<div class="card">
		<div class="card-body p-4">
		    <div class="row align-items-center">
		        <div class="col-auto"><img src="https://i.ibb.co/M1rVWtS/Untitled-design-5.png" width="44" alt="user" class="active avatar-home" /></div>
		        <div class="col pl-0">
		            <h6 class="mb-0 bold"><?= $news['poster']; ?></h6>
		            <h6 class="mb-0 cl-gray-2"><?= timeAgo($news['created_time']); ?></h6>
		        </div>
		    </div>
		    <div class="content mt-3">
		        <?= $news['content']; ?>
		    </div>
		    <div>
		        <div class="row mt-3">
		            <div class="col-auto text-center">
		            	<?php 
		            		$check_like = mysqli_fetch_assoc(mysqli_query($conn, "SELECT * FROM `like_post` WHERE `username` = '".$_SESSION['username']."' AND `post_key` = '".$news['key']."' "));

		            		if($check_like){
		            			$attr = "cl-red";
		            			$onclick = "onclick='unlikePost(this)'";
		            		}else{
		            			$attr = "cl-gray-2";
		            			$onclick = "onclick='likePost(this)'";
		            		}
		            	?>
		                <h5 id="jzonPost_<?= $news['key']; ?>" class="hand cl-gray-2" data-key="<?= $news['key']; ?>" <?= $onclick; ?>>
		                	<i id="icon_<?= $news['key']; ?>" class="fas <?= $attr; ?> fa-heart mr-1"></i>
		                	<span id="like_<?= $news['key']; ?>">
		                		<?= number_format(mysqli_num_rows(mysqli_query($conn, "SELECT * FROM `like_post` WHERE `post_key` = '".$news['key']."' "))); ?>
		                	</span>
		                </h5>
		            </div>
		        </div>
		    </div>
		</div>
	</div>
	<?php } ?>

<?php } else { ?>

<?php } ?>