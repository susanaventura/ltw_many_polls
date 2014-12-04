 <!-- Page Content -->
    <div class="container">
		
        <!-- Introduction Row -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">My account settings</h1>

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
							<input type="email" class="form-control" name="email" placeholder="Email Address" pattern="^.*@.*\..*$" disabled>
						</div>
					</div>
					
					<div class="form-group">
						<label for="username" class="col-md-3 control-label">Username</label>
						<div class="col-md-9">
							<input type="text" class="form-control" name="username" placeholder="Username" disabled>
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
					
					<hr>
					
					<div class="form-group">
						<div class="col-md-4 pull-right">
							<button class="form-control btn btn-default" name="deleteAccount">Delete Account</button>
						</div>
					</div>
					
					<div class="form-group has-error">
						<label id="errorMsg" class="control-label"></label>
					</div>

					<div class="form-group">
						<!-- Button -->                                        
						<div class="col-md-offset-3 col-md-9 text-center">
							<input id="btn-signup" type="submit" class="btn btn-info" value="Save">
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>	