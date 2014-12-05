

    <!-- Page Content -->
    <div class="container">
		
        <!-- Introduction Row -->
        <div class="row">
            <div class="header-custom col-lg-12">
                <h1 class="page-header">Polls</h1>
				<form id="searchForm" class="navbar-form navbar-right" role="search" method="get">
					<div class="form-group">
					  <input id="searchText" type="text" class="form-control" name="searchText" placeholder="Search">		  
					</div>
					<button type="submit" class="btn btn-default" aria-label="Search" action="pollsListPage.php">
					<span class="glyphicon glyphicon-search" aria-hidden="true"></span>
					</button>
				</form>

            </div>
			
        </div>

        <!-- Polls -->
        <div id="pollsArea" class="row">
            <div class="col-lg-12">
				<?php if (!isset($_GET['searchText'])){ ?>
					<h2 class="page-header">All Polls</h2>
				<?php } else if ($_GET['searchText'] == "MyPolls"){ ?>
					<h2 class="page-header">My Polls</h2>
				<?php } else{ ?>
					<h2 class="page-header">Search result</h2>
				<?php } ?>
            </div>

 