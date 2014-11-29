<div id="modalSignUp">
	<div class="modal-dialog">
		<div class="modal-content">  
				<div id="signupbox"">
					<div class="panel panel-info">
						<div class="panel-heading modal-header">
							<div class="panel-title">Sign Up</div>
							<div style="float:right; font-size: 85%; position: relative; top:-10px"><a id="signinlink" href="#" onclick="$('#signupbox').hide(); $('#loginbox').show()">Sign In</a></div>
						</div>  
						<div class="panel-body modal-body" >
							<form id="signupform" class="form-horizontal" role="form" action="action_signup.php" method="post">
								
								<div id="signupalert" style="display:none" class="alert alert-danger">
									<p>Error:</p>
									<span></span>
								</div>
													
								<div class="form-group">
									<label for="firstname" class="col-md-3 control-label">First Name</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="firstname" placeholder="First Name">
									</div>
								</div>
								<div class="form-group">
									<label for="lastname" class="col-md-3 control-label">Last Name</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="lastname" placeholder="Last Name">
									</div>
								</div>
								
								<div class="form-group">
									<label for="email" class="col-md-3 control-label">Email</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="email" placeholder="Email Address">
									</div>
								</div>
								
								<div class="form-group">
									<label for="username" class="col-md-3 control-label">Username</label>
									<div class="col-md-9">
										<input type="text" class="form-control" name="username" placeholder="Username">
									</div>
								</div>
								
								<div class="form-group">
									<label for="password" class="col-md-3 control-label">Password</label>
									<div class="col-md-9">
										<input type="password" class="form-control" name="password" placeholder="Password">
									</div>
								</div>
									
								<div class="form-group">
									<label for="birth" class="col-md-3 control-label">Birth Date</label>
									<div class="col-md-9">
										<input type="date" class="form-control" name="birth">
									</div>
								</div>

								<div class="form-group">
									<!-- Button -->                                        
									<div class="col-md-offset-3 col-md-9">
										<input id="btn-signup" type="submit" class="btn btn-info" value="Sign Up">
										<span style="margin-left:8px;">or</span>  
									</div>
								</div>
								
								<div style="border-top: 1px solid #999; padding-top:20px"  class="form-group">
									
									<div class="col-md-offset-3 col-md-9">
										<button id="btn-fbsignup" type="button" class="btn btn-primary"><i class="icon-facebook"></i>   Sign Up with Facebook</button>
									</div>                                           
										
								</div>
								
								
								
							</form>
						 </div>
					</div>

						   
						   
							
				 </div> 
			</div>

  
</div>