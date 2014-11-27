
   <!-- Page Content -->
    <div class="container">
		<div class="row">
			<div class="previewPoll">
				<div class="col-xs-6">
					<h2>Preview</h2>
					<div id="previewArea">
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
					<ul class="nav nav-tabs">
						<li class="active"><a data-toggle="tab" href="#pollForm">Poll</a></li>
						<li><a data-toggle="tab" href="#settingsForm">Settings</a></li>
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
										<a href="#" id="remove_choice1" class="remove_field">x</a>
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
								  <input type="checkbox" name="multSelect" id="multSelect" checked> 
								  <label for="multSelect">Allow multiple selections</label>
								  <br>
								  <label for="voteLabel">Vote button label:</label>
								  <input type="text" class="form-control" id="voteLabel" value="Vote">
								  <br>
								  <label for="resultsLabel">See results label:</label>
								  <input type="text" class="form-control" id="resultsLabel" value="See results">
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
								</div>
							</form>
								<div id="output"></div>
								
				
						</div>
					</div>
				</div>
			</div>
		</div>
    </div>
    <!-- /.container -->


    <!-- jQuery Version 1.11.1 -->
   <!-- <script src="../js/jquery.js"></script>-->

    <!-- Bootstrap Core JavaScript -->
    <!---->

</body>

</html>