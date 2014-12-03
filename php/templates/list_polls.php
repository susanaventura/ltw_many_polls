
 <?php 
	if(empty($polls)){?>
		<div class="col-lg-12"><p>No polls found</p></div>
	<? } ?>
		<div id="wrapperPolls">
			<? foreach( $polls as $row) {?>
			<div class="col-lg-4 col-sm-6 text-center poll"> 
				<a href="pollXPage.php?id=<?=$row['id']?>">
					<img class="img-circle img-responsive img-center" src=<?=$row['image']?> alt="An image">
					<h3><?=$row['title']?>
						<small><?=$row['owner']?></small>
					</h3>
				</a>
				<!-- Admin -->
				<div>
					<a href="" onClick="removePoll(<?=$row['id']?>); return false;">
						<img src="../images/removePoll_icon.png" />
					</a>
				</div>
			</div>
		</div>
<? } ?>
</div>