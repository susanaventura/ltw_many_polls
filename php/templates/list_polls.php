
 <?php 
	foreach( $polls as $row) {?>
	<div class="col-lg-4 col-sm-6 text-center">
		<a href="#">
			<img class="img-circle img-responsive img-center" src=<?=$row['image']?> alt="An image">
			<h3><?=$row['title']?>
				<small><?=$row['owner']?></small>
			</h3>
		</a>
	</div>
	
<? } ?>

</div>