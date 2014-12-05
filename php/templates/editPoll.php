
   <!-- Page Content -->
    <div class="container">

	
	<!-- Introduction Row -->
        <div class="row">
            <div class="header-custom col-lg-12">
                <h1 class="page-header">Create Poll</h1>
            </div>
			
        </div>
	
	
		<div class="row">
			<div class="previewPoll">
				<div class="col-xs-6">
					<h2>Preview</h2>
					<div id="previewArea">
						<img id="img-preview" src="http://placehold.it/500&text=ManyPolls" alt="an image">
						<div class="form-group">
						  <label for="questionPreview">Question</label>
						  <p id="questionPreview" ></p>
						</div>
						<div class="form-group">
						  <label for="previewChoices">Choices:</label>					  
						  <div id="previewChoices">
							<div class="wrapperPrevChoice">
								<input type="checkbox" id="choice1Preview" class="choicePreview" name="choicePrev" > 
								<label class="checkboxLabelNormal" for="choice1Preview"></label>
							</div>
						  </div>
						</div>
						<button id="btn_previewVote">Vote</button>
						<button id="btn_previewSeeResults">See Results</button>
					</div>
				</div>
			</div>
		
		
			<div class="editPollMenu">
				<div class="col-xs-6">
					<h2>Edit</h2>
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#pollForm">Poll</a></li>
						<li><a data-toggle="tab" href="#settingsForm">Settings</a></li>
					</ul>
					<!-- Poll Tab Menu -->
					<div class="tab-content">
						<!-- Poll Form -->
						<div id="pollForm" class=" well bs-component tab-pane fade in active col-lg-12 text-left">
							<h2>Poll</h2>							
							<form role="form" method="post" name="EditPollForm" onsubmit="validatePollSubmit('<?=$user?>', '<?=$token?>'); return false;">
								<div class="form-group">
									<div id="pollTitleInput">
									  <label for="pollTitle">Title</label>
									  <input type="text" class="form-control" name="pollTitle" placeholder="Enter title" required>
									</div>
								</div>
								<div class="form-group">
									<div id="questionInput">
									  <label for="question">Question</label>
									  <input type="text" class="form-control" name="question" placeholder="Enter question" required>
									</div>
								</div>
								<div class="form-group">
								  <label for="choiceInput">Choices:</label>					  
								  <button class="btn btn-default btn_addChoice" onClick="addChoice('choiceInput'); return false;">Add choice</button>   
								  <div id="choiceInput">
									<div class="wrapperChoice">
										<input id="choice1" type="text" class="form-control" name="choices[]" placeholder="Enter choice">
										<a href="#" id="remove_choice1" class="remove_field">x</a>
									</div>
								  </div>
								</div>
								<button type="submit" name="publish" class="btn btn-default">Save and publish</button>
							</form>
							<div class="form-group has-error">
								<label id="errorMsg" class="control-label">
								</label>
								
							</div>
						</div>
							<!-- Settings form -->
						<div id="settingsForm" class="well bs-component tab-pane fade col-lg-12 text-left">
							<h2>Settings</h2>
							
							<form role="form" name="settingsForm">
								<div class="form-group">
								  <h3>Privacy</h3>
								  <button type="button" value="0" class="toggleButton btn btn-default active" aria-label="Public" onClick="toggleButton('0')">
									<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
								  </button>
								  <button type="button" value="1" class="toggleButton btn btn-default" aria-label="Private" onClick="toggleButton('1')">
									<span class="glyphicon glyphicon-lock" aria-hidden="true"></span>
								  </button>

								</div>
							</form>
							
							<form role="form">
								<div class="form-group">
								  <h3>Layout</h3>
								  <input type="checkbox" name="multSelect" id="multSelect" checked> 
								  <label for="multSelect">Allow multiple selections</label>
								  <br>
								  <label for="voteLabel">Vote button label:</label>
								  <input type="text" class="form-control" id="voteLabel" value="Vote" required>
								  <br>
								  <label for="resultsLabel">See results label:</label>
								  <input type="text" class="form-control" id="resultsLabel" value="See results" required>
								</div>
							</form>

							<form role="form" action="templates/processupload.php" method="post" enctype="multipart/form-data" id="MyUploadForm">
								<div class="form-group">
									<h3>Image</h3>
									<div class="wrapperImgInput">
										<input name="image_file" id="imageInput" type="file" class="filestyle" data-buttonBefore="true"/>
										<input type="submit"  id="submit-btn" value="Upload" class="btn btn-default"/>
									</div>
									<img src="../images/ajax-loader.gif" id="loading-img" style="display:none;" alt="Please Wait"/>
									<div class="col-xs-12" id="output" ></div>
								</div>
							</form>				
						</div>
					</div>
				</div>
			</div>
		</div>
