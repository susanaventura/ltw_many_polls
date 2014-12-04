<div id="modalSignUp">
	<div class="modal-dialog">
		<div class="modal-content">  
				<div id="signupbox">
					<div class="panel panel-info">
						<div class="panel-heading modal-header">
							<div class="panel-title">Sign Up</div>
							<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
						</div>  
						<div class="panel-body modal-body" >
							<form id="submitform" name="submitForm" method="post" class="form-horizontal" role="form" onsubmit="validateSignup(); return false;">
								
																		
								<div class="form-group">
									<label for="firstname" class="col-md-3 control-label" >First Name</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="firstname" placeholder="First Name" pattern="^\w*$" required>
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-md-3 control-label">Last Name</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="lastname" placeholder="Last Name" pattern="^\w*$" required>
									</div>
								</div>
								
								<div class="form-group">
									<label for="email" class="col-md-3 control-label">Email</label>
									<div class="col-md-9">
										<input type="email" class="form-control" name="email" placeholder="Email Address" pattern="^.*@.*\..*$" required>
									</div>
								</div>
								
								<div class="form-group">
									<label for="username" class="col-md-3 control-label">Username</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="username" placeholder="Username" required>
									</div>
								</div>
								
								<div class="form-group">
									<label for="password" class="col-md-3 control-label">Password</label>
									<div class="col-md-9">
										<input type="password" class="form-control" name="password" placeholder="Password" required>
									</div>
								</div>
									
								<div class="form-group">
									<label for="birth" class="col-md-3 control-label">Birth Date</label>
									<div class="col-md-9">
										<input type="date" class="form-control" name="birth" required>
									</div>
								</div>
								
								<div class="form-group has-error">
									<label id="errorMsg" class="control-label"></label>
								</div>

								<div class="form-group">
									<!-- Button -->                                        
									<div class="col-md-offset-3 col-md-9 text-center">
										<input id="btn-signup" type="submit" class="btn btn-info" value="Sign Up">
									</div>
								</div>
								
			
								
								
								
							</form>
						 </div>
					</div>

						   
						   
							
				 </div> 
			</div>

  
</div>