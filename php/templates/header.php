<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>Many Polls</title>
	
	<!-- Bootstrap Core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	

	<!-- Custom CSS -->
	<style>
	body {
		padding-top: 70px;
		/* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
	}
	</style>
	<link rel="stylesheet" type="text/css" href="../css/editPollPage.css">
	<link rel="stylesheet" type="text/css" href="../css/pollsList.css">
	<link href="../css/round-about.css" rel="stylesheet">
	<link href="../css/portfolio-item.css" rel="stylesheet">
	<link href="../css/pollX.css" rel="stylesheet">
	<link href="../css/simple-sidebar.css" rel="stylesheet">

 
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
	<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jquery/1.10.2/jquery.min.js'></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://www.google.com/jsapi"></script>
	<script src="../js/bootstrap-filestyle.min.js"></script>
	
	<!--<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>-->
	<!--<script type="text/javascript" src="../js/jquery.form.min.js"></script>-->
	

<!--<script type='text/javascript' src='http://ajax.googleapis.com/ajax/libs/jqueryui/1.10.3/jquery-ui.min.js'></script>-->
<!--<link rel="stylesheet" type="text/css" href="http://code.jquery.com/ui/1.10.3/themes/smoothness/jquery-ui.css">-->

	<!--<script src="../js/bootbox.min.js"></script>-->


	<!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
	<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
		<!--[if lt IE 9]>
			<script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
			<script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
		<![endif]-->

	<!-- esapi4js -->
	<script type="text/javascript" language="JavaScript" src="../js/esapi4js/esapi.js"></script>
	<script type="text/javascript" language="JavaScript" src="../js/esapi4js/lib/log4js.js"></script>
	<script type="text/javascript" language="JavaScript" src="../js/esapi4js/resources/i18n/ESAPI_Standard_en_US.properties.js"></script>
	<script type="text/javascript" language="JavaScript" src="../js/esapi4js/resources/Base.esapi.properties.js"></script>
	
	<script type="text/javascript" language="JavaScript">
		// Set any custom configuration options here or in an external js file that gets sourced in above.
		Base.esapi.properties.logging['ApplicationLogger'] = {
        Level: org.owasp.esapi.Logger.ALL,
        Appenders: [ new Log4js.ConsoleAppender() ],
        LogUrl: true,
        LogApplicationName: true,
        EncodingRequired: true
		};

		Base.esapi.properties.application.Name = "ManyPolls";

		// Initialize the api
		org.owasp.esapi.ESAPI.initialize();
	</script>
	
	
	<script type="text/javascript" src="../js/jquery.form.min.js"></script>
	
	<script src="../js/addInput.js" language="Javascript" type="text/javascript"></script>
	<script src="../js/uploadImages.js" language="Javascript" type="text/javascript"></script>
	<script src="../js/listPolls.js" language="Javascript" type="text/javascript"></script>
	<script src="../js/googleCharts.js" language="Javascript" type="text/javascript"></script>
	<script src="../js/pollX.js" language="Javascript" type="text/javascript"></script>
	<script src="../js/validateInput.js" language="Javascript" type="text/javascript"></script>
	
</head>

<body>

    <div id="wrapper" <?php if (!isset($_SESSION['username']))echo 'class="toggled"';?>>

		<!-- confirmation modal -->
		<div id="confirmationModal" class="modal fade">
		  <div class="modal-dialog">
			<div class="modal-content">
			  <!-- dialog header -->
			  <div class="modal-header">
				  <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				  <h4 class="modal-title">Confirmation</h4>
			  </div>
			  <!-- dialog body -->
			  <div class="modal-body">
				<p id="confirmation"></p>
			  </div>
			  <!-- dialog buttons -->
			  <div class="modal-footer">
				<button id="yesBtn" type="button" class="btn btn-primary">Yes</button>
				<button id="noBtn" type="button" class="btn btn-primary" data-dismiss="modal" aria-hidden="true">No</button>
			</div>
			</div>
		  </div>
		</div>
		<!-- --confirmation modal-- -->
	

	<!-- Navigation -->
	<div id="page-content-wrapper">
	<nav class="navbar navbar-inverse navbar-fixed-top" role="navigation">
		<div class="container">
			<!-- Brand and toggle get grouped for better mobile display -->
			<div class="navbar-header">
				<button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
					<span class="sr-only">Toggle navigation</span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
					<span class="icon-bar"></span>
				</button>
				<a class="navbar-brand" href="./editPollPage.php">Many Polls</a>
			</div>
			<!-- Collect the nav links, forms, and other content for toggling -->
			<div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
				<ul class="nav navbar-nav">
					<li>
						<a href="./pollsListPage.php">Polls</a>
					</li>
					<?php if (isset($_SESSION['username'])) { ?>
					<li>
						<a href="" id="menu-toggle">My Private Area</a>
					</li>
					<?php } ?>
					<li>
					<?php if (isset($_SESSION['username'])) { ?>
						<a href="action_logout.php">Logout <?=$_SESSION['username']?></a>
					<?php } else { ?>
					 
						<a href="" onClick="login(); return false;">Login</a>
					<?php } ?>
					</li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
		
		<!-- Sidebar -->
        <div id="sidebar-wrapper">
            <ul class="sidebar-nav">
                <li>
                    <a href="../php/pollsListPage.php?searchText=MyPolls">My Polls</a>
                </li>
                <li>
                    <a href="../php/pollsListPage.php?searchText=PollsIveAnswered">Polls I've answered</a>
                </li>
				<li>
                    <a href="">My account settings</a>
                </li>
            </ul>
        </div>
        <!-- /#sidebar-wrapper -->
	</nav>
	
	<div id="page-wrapper">
	<div class="container-fluid">
	<div id="modal_container"></div>