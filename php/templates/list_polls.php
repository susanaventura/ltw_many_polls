
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
			</div>
			<!-- Admin -->
			<div class="wrapperTools col-lg-4 col-sm-6 text-center">
				<button type="button" class="btn btn-default" data-toggle="tooltip" aria-label="Public" >
				<span class="glyphicons glyphicons-circle-remove" aria-hidden="true"></span>
				</button>
			</div>
		</div>
<? } ?>
</div>