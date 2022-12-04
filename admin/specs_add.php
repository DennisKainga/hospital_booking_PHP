<?php 
include_once "includes/header.php";
require_once "../control/dbh.inc.php";
$statement = $pdo->prepare("SELECT * FROM specialization ORDER BY specialization_id DESC");
$statement->execute();
$spes = $statement->fetchAll(PDO::FETCH_ASSOC);

?>
<body class="hold-transition light-mode sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">
<div class="wrapper">
  <!-- Navbar -->
 <?php include_once "includes/nav.php"?>
  <!-- Main Sidebar Container -->
  <?php include_once "includes/side.php"?>
  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Enter correct details for new specilist</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
      
		<a href="index.php" class="btn btn-warning mb-3 mx-2">Home</a>
        <div class="card custom-card w-75 m-auto">
						<div class="card-body">
							<h4 class="text-center text-muted mb-3">Add new specialist</h4>
							<hr>

							<form method="POST" action="../control/signup.inc.php">
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
										<label>Phone Number</label>
										<input require name="phone"class="form-control" placeholder="Enter your Phone Numner" type="text">
									</div>
									<div class="form-group text-left col">
										<label>Email</label>
										<input require name="email"class="form-control" placeholder="Enter Email" type="email">
									</div>
								</div>
								<div class="row">
									<div class="form-group text-left col">
										<label>Gender</label>
										<input require name="gender"class="form-control" placeholder="Enter Gender" type="text">
									</div>
									<div class="form-group text-left col">
										<label>Location</label>
										<input require name="loc" class="form-control" placeholder="Enter Location" type="text">
									</div>
								</div>
								<div class="row">
									<div class="input-group text-left">
										<div class="input-group-prepend">
											<label class="input-group-text" for="inputGroupSelect01">Choose Specilization</label>
										</div>
										<select class="custom-select" name="spes_id" id="inputGroupSelect01">
											<?php foreach($spes as $spe):{?>
											<option value="<?php echo $spe["specialization_id"]?>"><?php echo $spe["specialization_name"]?></option>
											<?php }endforeach;?>
										</select>
									</div>
                                </div>
								<hr><h4 class="text-center text-muted">Enter specialist Login Info</h4><hr>
								
								<div class="row">
								<div class="form-group text-left col">
									<label>Enter Username</label>
									<input require name="uname"class="form-control" placeholder="Enter DOB" type="text">
								</div>	
									<div class="form-group text-left col">
										<label>Password</label>
										<input require name="password" class="form-control" placeholder="Enter your password" type="password">
									</div>
									<div class="form-group text-left col">
										<label>Repeat Password</label>
										<input require name="password_repeat" class="form-control" placeholder="Retype password" type="password">
									</div>
								 </div>	
								 <input type="hidden" name="rank" value="spec">			
								<button class="btn ripple btn-main-primary btn-block bg-dark">Create Account</button>
							</form>
		
						</div>
					</div>
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->

  <!-- Main Footer -->

</div>
<?php require_once "includes/footer.php"?>
