<!DOCTYPE html>
<html lang="en">

<head>

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
	
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/css/bootstrap-theme.min.css">
	<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
	<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.1/js/bootstrap.min.js"></script>
	

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
	
	<script src="../js/addInput.js" language="Javascript" type="text/javascript"></script>
	

	
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
                <a class="navbar-brand" href="#">Many Polls</a>
            </div>
            <!-- Collect the nav links, forms, and other content for toggling -->
            <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                <ul class="nav navbar-nav">
                    <li>
                        <a href="#">About</a>
                    </li>
                    <li>
                        <a href="#">Services</a>
                    </li>
                    <li>
                        <a href="#">Contact</a>
                    </li>
                </ul>
            </div>
            <!-- /.navbar-collapse -->
        </div>
        <!-- /.container -->
    </nav>

    <!-- Page Content -->
    <div class="container">
		<div class="row">
			<div class="previewPoll">
				<div class="col-xs-6">
					<h2>Preview</h2>
					<div class="form-group">
					  <label for="questionPreview">Question</label>
					  <p id="questionPreview" ></p>
					</div>
					<div class="form-group">
					  <label for="previewChoices">Choices:</label>					  
					  <div id="previewChoices">
						<input type="checkbox" id="choice1Preview" class="choicePreview"> 
						<label for="choice1Preview"></label>
						<!-- <p id="choice1Preview" class="choicePreview" ></p> -->
					  </div>
					</div>
				</div>
			</div>
		
		
			<div class="editPollMenu">
				<div class="col-xs-6">
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#poll">Poll</a></li>
						<li><a data-toggle="tab" href="#settings">Settings</a></li>
					</ul>
					<!-- Poll Tab Menu -->
					<div class="tab-content">
						<!-- Poll Form -->
						<div id="pollForm" class="tab-pane fade in active col-lg-12 text-left">
							<h2>Poll</h2>
							<form role="form">
								<div class="form-group">
									<div id="questionInput">
									  <label for="question">Question</label>
									  <input type="text" class="form-control" name="question" placeholder="Enter question">
									</div>
								</div>
								<div class="form-group">
								  <label for="choiceInput">Choices:</label>					  
								  <button class="btn_addChoice" onClick="addChoice('choiceInput'); return false;">Add choice</button>   
								  <div id="choiceInput">
									<div class="wrapperChoice">
										<input id="choice1" type="text" class="form-control" name="choices[]" placeholder="Enter choice">
										<a href="#" id="remove_choice1" class="remove_field" onClick="removeChoice('wrapperChoice'); return false;">x</a>
									</div>
								  </div>
								</div>
								<button type="submit" class="btn btn-default">Save</button>
							</form>		
						</div>
						<!-- Settings form -->
					<div id="settingsForm" class="tab-pane fade col-lg-12 text-left">
						<h2>Settings</h2>
						<form role="form">
							<div class="form-group">
							  <h3>Layout</h3>
							  <label>Allow multiple selections:
								  <input type="checkbox" name="multSelect" id="multSelect"> 
							  </label>
							  <br>
							  <label for="voteLabel">Vote button label:</label>
							  <input type="text" class="form-control" id="voteLabel">
							  <br>
							  <label for="resultsLabel">See results label:</label>
							  <input type="text" class="form-control" id="resultsLabel">
							</div>
						</form>
					</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /.container -->


    <!-- jQuery Version 1.11.1 -->
    <script src="../js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="../js/bootstrap.min.js"></script>

</body>

</html>
