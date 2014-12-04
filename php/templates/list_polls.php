
 <?php 
	if(empty($polls)){?>
		<div class="col-lg-12"><p>No polls found</p></div>
	<? } ?>
		<div id="wrapperPolls">
			<? foreach( $polls as $row) { 
				$userAnsweredPoll = userAnsweredPoll($_SESSION['username'], $row['id']);?>
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
				<? if($row['owner'] === $_SESSION['username']){ ?>
					<a href="" onClick="removePoll(<?=$row['id']?>); return false;">
						<img src="../images/removePoll_icon.png" />
					</a>
					<? if($row['isPrivate'] === "1"){ ?>
					<div>
						<img src="../images/private_icon.png" />
					</div> <? } ?>
				<? } ?>
				<? if(!$userAnsweredPoll){ ?>
					<div>
						<img src="../images/canVote_icon.png" />
					</div>
				<? } ?>
				</div>
			</div>
			<? } ?>
		</div>
</div>