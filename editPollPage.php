<!DOCTYPE html>
<html lang="en">

<head>

     <title>Many Polls</title>

    <!-- Bootstrap Core CSS -->
    <link href="css/bootstrap.min.css" rel="stylesheet">

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
	<script type="text/javascript">
		$(document).ready(function(){
			$('#previewPoll').hide();
			$("#question").keypress(update);
			$("#choice").keypress(update);
			
			//dynamically add choice field
			var x = 1; //initial text box count
			var maxChoices = 10;
			var btnAddChoice = $(".btn_addChoice");
			var choices = $(".form-group-choices");
			$(btnAddChoice).click(function(e){
				if(x < maxChoices){
					e.preventDefault();
					x++;
					$(choices).append('<input type="text" class="form-control" id="choice" placeholder="Enter choice">');		
				
				}
			});
		});
			
		function update(){		
		$('#previewPoll').slideDown('slow');
		var question = $("#question").val();
		var choice = $("#choice").val();
		$('#previewQuestion').html(question);
		$('#previewChoice').html(choice);
		}
		
		
		
	</script>
	
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
					<form action="upload_file.php" method="post" enctype="multipart/form-data">
						<input type="file" name="file">
					</form>
					<br>
					<div id="previewQuestion"></div>
					<br>
					<div id="previewChoice"></div>
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
						<div id="poll" class="tab-pane fade in active">
							<div class="pollForm">
								<div class="col-lg-12 text-left">
								   <h2>Poll</h2>
									<form role="form">
										<div class="form-group">
										  <label for="question">Question</label>
										  <input type="text" class="form-control" id="question" placeholder="Enter question">
										</div>
										<div class="form-group-choices">
										  <label for="choice">Choice:</label>
										  <button class="btn_addChoice">Add choice</button>
										  <input type="text" class="form-control" id="choice" placeholder="Enter choice">
										</div>
										<button type="submit" class="btn btn-default">Save</button>
									</form>
								</div>
							</div>
						</div>
						<!-- Settings form -->
						<div id="settings" class="tab-pane fade">
							<div class="settingsForm">
								<div class="col-lg-12 text-left">
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
		</div>
    </div>
    <!-- /.container -->


    <!-- jQuery Version 1.11.1 -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>

</body>

</html>
