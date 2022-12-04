<?php 
include_once "includes/header.php";
require_once "../control/dbh.inc.php";

$statement = $pdo->prepare("SELECT * FROM patient WHERE patient_id=:id");
$statement->bindValue(":id",$_GET["id"]);
$statement->execute();
$info = $statement->fetch(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$name = $_POST["name"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$gender  =$_POST["gender"];
	$dob  =$_POST["dob"];
	$loc  =$_POST["loc"];
    $statement = $pdo->prepare("UPDATE patient SET 
    patient_name=:name,patient_mobile=:phone,patient_email=:email,
    patient_gender=:gender,patient_dob=:dob,patient_location=:loc
    WHERE patient_id=:pid");
    $statement->bindValue(":name",$name);
    $statement->bindValue(":phone",$phone);
    $statement->bindValue(":email",$email);
    $statement->bindValue(":gender",$gender);
    $statement->bindValue(":dob",$dob);
    $statement->bindValue(":loc",$loc);
    $statement->bindValue(":pid",$_GET["id"]);
    $statement->execute();
    header("Location: pats.php?mess=updated");


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
            <h1 class="m-0">Edit Details For Patient</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
      
		<a href="admin.php" class="btn btn-warning mb-3 mx-2">Go back</a>
        <div class="card custom-card w-75 m-auto">
						<div class="card-body">
							<h4 class="text-center text-muted mb-3">Edit Patient</h4>
							<hr>

							<form method="POST" action="">
								<div class="row">
									<div class="form-group text-left col">
										<label>Name</label>
										<input value="<?php echo $info["patient_name"]?>" require name="name" class="form-control" placeholder="Enter your First Name" type="text">
									</div>
								</div>
								<div class="row">
									<div class="form-group text-left col">
										<label>Phone Number</label>
										<input value="<?php echo $info["patient_mobile"]?>" require name="phone"class="form-control" placeholder="Enter your Phone Numner" type="text">
									</div>
									<div class="form-group text-left col">
										<label>Email</label>
										<input value="<?php echo $info["patient_email"]?>" require name="email"class="form-control" placeholder="Enter Email" type="email">
									</div>
								</div>
								<div class="row">
									<div class="form-group text-left col">
										<label>Gender</label>
										<input value="<?php echo $info["patient_gender"]?>" require name="gender"class="form-control" placeholder="Enter Gender" type="text">
									</div>
									<div class="form-group text-left col">
										<label>DOB</label>
										<input value="<?php echo $info["patient_dob"]?>" require name="dob"class="form-control" placeholder="Enter Gender" type="text">
									</div>
								</div>
                                <div class="form-group text-left col">
                                    <label>Location</label>
                                    <input value="<?php echo $info["patient_location"]?>" require name="loc"class="form-control" placeholder="Enter Gender" type="text">
                                </div>
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
