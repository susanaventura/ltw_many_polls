<div id="modalPoll">
	<div class="modal-dialog">
		<div class="modal-content">    
			<!-- Portfolio Item Heading -->
			<div class="row">
				<div class="col-lg-12">
				<? var_dump($_GET) ?>
					<h1 id="title" class="page-header modal-header"><span id="titleText"><?$_GET['id']?></span>
						<small id="userText">User</small>
					</h1>
				</div>
			</div>
			<!-- /.row -->
			<div class="modal-body" >
				<!-- Portfolio Item Row -->
				<div class="row">

					<div class="col-md-8">
						<img class="img-responsive" src="http://placehold.it/750x500" alt="">
					</div>

					<div class="col-md-4">
						<h3>Project Description</h3>
						<p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Nam viverra euismod odio, gravida pellentesque urna varius vitae. Sed dui lorem, adipiscing in adipiscing et, interdum nec metus. Mauris ultricies, justo eu convallis placerat, felis enim.</p>
						<h3>Project Details</h3>
						<ul>
							<li>Lorem Ipsum</li>
							<li>Dolor Sit Amet</li>
							<li>Consectetur</li>
							<li>Adipiscing Elit</li>
						</ul>
					</div>

				</div>
				<!-- /.row -->

			</div>
		</div>
	</div>	
</div>