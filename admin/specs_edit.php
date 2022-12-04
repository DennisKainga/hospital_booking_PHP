<?php 
include_once "includes/header.php";
require_once "../control/dbh.inc.php";
$statement = $pdo->prepare("SELECT * FROM specialization ORDER BY specialization_id DESC");
$statement->execute();
$spes = $statement->fetchAll(PDO::FETCH_ASSOC);
unset($statement);
$statement = $pdo->prepare("SELECT * FROM specialist WHERE specialist_id=:id");
$statement->bindValue(":id",$_GET["id"]);
$statement->execute();
$info = $statement->fetch(PDO::FETCH_ASSOC);
if($_SERVER["REQUEST_METHOD"]=="POST"){
	$name = $_POST["name"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$gender  =$_POST["gender"];
	$loc = $_POST["loc"];
    $spes = $_POST["spes_id"] ?? $info["specialist_specialization_id"];
    $statement = $pdo->prepare("UPDATE specialist SET 
    specialist_name=:name,specialist_mobile=:phone,specialist_email=:email,specialist_gender=:gender,
    specialist_location=:loc,specialist_specialization_id=:spes WHERE specialist_id=:sid");
    $statement->bindValue(":name",$name);
    $statement->bindValue(":phone",$phone);
    $statement->bindValue(":email",$email);
    $statement->bindValue(":gender",$gender);
    $statement->bindValue(":loc",$loc);
    $statement->bindValue(":spes",$spes);
    $statement->bindValue(":sid",$_GET["id"]);
    $statement->execute();
    header("Location: specs.php?mess=updated");


}
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

							<form method="POST" action="">
								<div class="row">
									<div class="form-group text-left col">
										<label>Name</label>
										<input value="<?php echo $info["specialist_name"]?>" require name="name" class="form-control" placeholder="Enter your First Name" type="text">
									</div>
								</div>

								<div class="row">
									<div class="form-group text-left col">
										<label>Phone Number</label>
										<input value="<?php echo $info["specialist_mobile"]?>" require name="phone"class="form-control" placeholder="Enter your Phone Numner" type="text">
									</div>
									<div class="form-group text-left col">
										<label>Email</label>
										<input value="<?php echo $info["specialist_email"]?>" require name="email"class="form-control" placeholder="Enter Email" type="email">
									</div>
								</div>
								<div class="row">
									<div class="form-group text-left col">
										<label>Gender</label>
										<input value="<?php echo $info["specialist_gender"]?>" require name="gender"class="form-control" placeholder="Enter Gender" type="text">
									</div>
									<div class="form-group text-left col">
										<label>Location</label>
										<input value="<?php echo $info["specialist_location"]?>" require name="loc" class="form-control" placeholder="Enter Location" type="text">
									</div>
								</div>
								<div class="row mb-3">
									<div class="input-group text-left">
										<div class="input-group-prepend">
											<label class="input-group-text" for="inputGroupSelect01">Choose Specilization</label>
										</div>
										<select class="custom-select" name="spes_id" id="inputGroupSelect01">
                                            <option disabled selected value="<?php echo $info["specialist_specialization_id"]?>"><?php echo $_GET["spes"]?> <p><em>(current)</em></p></option>
											<?php foreach($spes as $spe):{?>
											<option value="<?php echo $spe["specialization_id"]?>"><?php echo $spe["specialization_name"]?></option>
											<?php }endforeach;?>
										</select>
									</div>
                                </div>
								<!-- <hr><h4 class="text-center text-muted">Enter specialist Login Info</h4><hr>
								
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
								 <input type="hidden" name="rank" value="spec">			 -->
								<button class="btn ripple btn-main-warning btn-block bg-warning">Update</button>
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
