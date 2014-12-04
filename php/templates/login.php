<div id="modalLogin">
	<div class="modal-dialog">
		<div class="modal-content">    
			<div id="loginbox">                      
				<div class="panel panel-info" >
					<div class="panel-heading modal-header">
						<div class="panel-title modal-title">Login</div>
					</div>     

					<div style="padding-top:30px" class="panel-body modal-body" >
							
						<form id="loginform" name="loginForm" method="post" class="form-horizontal" role="form" onsubmit="validateLogin(); return false;">
									
							<div style="margin-bottom: 25px" class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-user"></i></span>
										<input id="login-username" type="text" class="form-control" name="username" value="" placeholder="username or email" required>                                        
									</div>
								
							<div style="margin-bottom: 25px" class="input-group">
										<span class="input-group-addon"><i class="glyphicon glyphicon-lock"></i></span>
										<input id="login-password" type="password" class="form-control" name="password" placeholder="password" required>
									</div>
									
							<div class="form-group has-error">
								<label id="errorMsg" class="control-label"></label>
							</div>
								
								<div style="margin-top:10px" class="form-group">
									<!-- Button -->
									<div class="col-sm-12 controls">
										 <input type="submit" class="btn btn-success" value="Login">
									</div>
								</div>
									
								<div class="form-group">
									<div class="col-md-12 control">
										<div style="border-top: 1px solid#888; padding-top:15px; font-size:85%" >
											Don't have an account! 
											
										<a href="" onClick="signup(); return false;">
											Sign Up Here
										</a>
										</div>
									</div>
								</div>    
							</form>     
						</div>                     
					</div>  
				</div>
			</div>
		</div>
	</div>
</div>

