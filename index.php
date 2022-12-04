<?php include_once "includes/header.php"?>
	<body>
		<div class="caontainer-fluid d-flex flex-column justify-content-start" style="height: 100vh;background-image:url(hospital.jpg);background-position: center;background-size:contain;">
		<div class="page main-signin-wrapper ">
			<!-- Row -->
			<div class="row text-center pl-0 pr-0 ml-0 mr-0 mt-100">
				<div class="col-lg-3 d-block mx-auto col-md-6 col-lg-6 col-xl-6">
					
					<div class="card custom-card bg-dark mt-5">
						<div class="card-body">
							<h4 class="text-center">Sign into Your Account</h4>
							<form method="POST" action="control/login.inc.php">
								<div class="form-group text-left">
									<label>Username</label>
									<input required name="uname" class="form-control" placeholder="Enter your Email" type="text">
								</div>
								<div class="form-group text-left">
									<label>Password</label>
									<input required name="password" class="form-control" placeholder="Enter your password" type="password">
								</div>
								<button class="btn ripple btn-main-primary btn-block bg-light">Sign In</button>

								<div class="mt-3 text-center">
								<!-- <p class="mb-1"><a href="#">Forgot password?</a></p> -->
								<p class="mb-0">Don't have an account? <a href="register.php">Create an Account</a></p>
							</div>
							</form>
							
						</div>
					</div>
				</div>
			</div>
			<!-- End Row -->
		</div>
		</div>
		<!-- End Page -->
<?php include_once "includes/footer.php"?>