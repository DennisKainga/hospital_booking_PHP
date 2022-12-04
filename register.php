<?php include_once "includes/header.php";
$rank=$_GET["rank"] ?? "patient";
 ?>
	<body>
		
		<div class="page main-signin-wrapper">
			<div class="row text-center pl-0 pr-0 ml-0 mr-0 mt-3">
				<div class="col-lg-3 d-block mx-auto col-md-6 col-lg-6 col-xl-6">
				
					<div class="card custom-card ">
						<div class="card-body">
							<h4 class="text-center text-muted mb-3">Create a new Account</h4>
							<hr>
							<form method="POST" action="control/signup.inc.php">
								<div class="row">
									<div class="form-group text-left col">
										<label>First Name</label>
										<input require name="fname" class="form-control" placeholder="Enter your First Name" type="text">
									</div>
									<div class="form-group text-left col">
										<label>Last Name</label>
										<input require name="lname"class="form-control" placeholder="Enter your Last Name" type="text">
									</div>
								</div>
								<div class="row">
									<div class="form-group text-left col">
										<label>username</label>
										<input require name="uname"class="form-control" placeholder="Enter Username" type="text">
									</div>
									<div class="form-group text-left col">
										<label>Email</label>
										<input require name="email" class="form-control" placeholder="Enter your Email" type="email">
									</div>
								</div>

								<div class="row">
									<div class="form-group text-left col">
										<label>Password</label>
										<input require name="password" class="form-control" placeholder="Enter your password" type="password">
									</div>
									<div class="form-group text-left col">
										<label>Repeat Password</label>
										<input require name="password_repeat" class="form-control" placeholder="Retype password" type="password">
									</div>
								 </div>

								<div class="row">
								<div class="form-group text-left col">
									<label>Phone Number</label>
									<input require name="phone"class="form-control" placeholder="Enter your Phone Numner" type="text">
								</div>
								<div class="form-group text-left col">
									<label>Gender</label>
									<input require name="gender"class="form-control" placeholder="Enter Gender" type="text">
								</div>

								</div>
							
								<?php if($rank=="patient"):{?>
								<div class="form-group text-left">
									<label>Enter DOB</label>
									<input require name="dob"class="form-control" placeholder="Enter DOB" type="date">
								</div>
								<div class="form-group text-left">
									<label>Enter your location</label>
									<input require name="loc"class="form-control" placeholder="Enter Current Location" type="text">
								</div>
								 <?php }endif;?>

								
								<input type="hidden" name="rank" value="<?php echo $rank?>">
								<button class="btn ripple btn-main-primary btn-block bg-dark">Create Account</button>
							</form>
							<div class="mt-3 text-center">
								<p class="mb-0">Already have an account? <a href="index.php">Sign In</a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<!-- End Row -->

		</div>
		<!-- End Page -->

	<?php include_once "includes/footer.php"?>