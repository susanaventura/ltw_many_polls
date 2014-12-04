
 <?php 
	if(empty($polls)){?>
		<div class="col-lg-12"><p>No polls found</p></div>
	<? } ?>
		<div id="wrapperPolls">
			<? foreach( $polls as $row) { ?>
			<div class="row col-lg-3 col-sm-5 text-center poll"> 
				<a href="pollXPage.php?id=<?=$row['id']?>">
				<? 
				$posUpload = strpos($row['image'],"upload/");
				if($posUpload){
					$pos = $posUpload+7;
					$thumbImg = substr_replace($row['image'], "thumb_", $pos, 0);
				} else $thumbImg = "http://placehold.it/200&text=ManyPolls";
				?>
					<img class="img-circle img-responsive img-center" src=<?=$thumbImg?> alt="An image">
					<h3><?=$row['title']?>
						<small><?=$row['owner']?></small>
					</h3>
				</a>
				<!-- Admin -->
				<div>
					<a href="" onClick="removePoll(<?=$row['id']?>,'<?=$_SESSION['csrf_token']?>'); return false;">
						<img src="../images/removePoll_icon.png" />
					</a>
				</div>
			</div>
			<? } ?>
		</div>
</div>