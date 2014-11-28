<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
	<title>Many Polls</title>
	
	<script type="text/javascript" src="../js/jquery-1.10.2.min.js"></script>
	<script type="text/javascript" src="../js/jquery.form.min.js"></script>
	
	<!-- Bootstrap Core CSS -->
	<link href="../css/bootstrap.min.css" rel="stylesheet">
	<link href="../css/modalDialog.css" rel="stylesheet">

	<!-- Custom CSS -->
	<style>
	body {
		padding-top: 70px;
		/* Required padding for .navbar-fixed-top. Remove if using .navbar-static-top. Change if height of navigation changes. */
	}
	</style>
	<link rel="stylesheet" type="text/css" href="../css/editPollPage.css">
	<link href="../css/round-about.css" rel="stylesheet">

	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>-->
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>

	<script src="../js/bootstrap-filestyle.min.js"></script>

	<script src="../js/bootbox.min.js"></script>


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
	
	
	
	<script src="../js/addInput.js" language="Javascript" type="text/javascript"></script>
	<script src="../js/uploadImages.js" language="Javascript" type="text/javascript"></script>
	
</head>

<body>

	<!-- Navigation -->
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
						<a href="#">My Private Area</a>
					</li>
					<?php } ?>
					<li>
					<?php if (isset($_SESSION['username'])) { ?>
						<a href="action_logout.php">Logout <?=$_SESSION['username']?></a>
					<?php } else { ?>
						<a href="loginPage.php">Login</a>
					<?php } ?>
					</li>
				</ul>
			</div>
			<!-- /.navbar-collapse -->
		</div>
		<!-- /.container -->
	</nav>