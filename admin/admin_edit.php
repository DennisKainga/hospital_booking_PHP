<?php 
include_once "includes/header.php";
require_once "../control/dbh.inc.php";

$statement = $pdo->prepare("SELECT * FROM admin WHERE admin_id=:id");
$statement->bindValue(":id",$_GET["id"]);
$statement->execute();
$info = $statement->fetch(PDO::FETCH_ASSOC);

if($_SERVER["REQUEST_METHOD"]=="POST"){
	$name = $_POST["name"];
	$phone = $_POST["phone"];
	$email = $_POST["email"];
	$gender  =$_POST["gender"];
  $statement = $pdo->prepare("UPDATE admin SET 
  admin_name=:name,admin_mobile=:phone,admin_email=:email,admin_gender=:gender
  WHERE admin_id=:aid");
  $statement->bindValue(":name",$name);
  $statement->bindValue(":phone",$phone);
  $statement->bindValue(":email",$email);
  $statement->bindValue(":gender",$gender);
  $statement->bindValue(":aid",$_GET["id"]);
  $statement->execute();
  header("Location: admin.php?mess=updated");


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
            <h1 class="m-0">Edit Details For Administrator</h1>
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
							<h4 class="text-center text-muted mb-3">Edit Administrator</h4>
							<hr>

							<form method="POST" action="">
								<div class="row">
									<div class="form-group text-left col">
										<label>Name</label>
										<input value="<?php echo $info["admin_name"]?>" require name="name" class="form-control" placeholder="Enter your First Name" type="text">
									</div>
								</div>
								<div class="row">
									<div class="form-group text-left col">
										<label>Phone Number</label>
										<input value="<?php echo $info["admin_mobile"]?>" require name="phone"class="form-control" placeholder="Enter your Phone Numner" type="text">
									</div>
									<div class="form-group text-left col">
										<label>Email</label>
										<input value="<?php echo $info["admin_email"]?>" require name="email"class="form-control" placeholder="Enter Email" type="email">
									</div>
								</div>
								<div class="row">
									<div class="form-group text-left col">
										<label>Gender</label>
										<input value="<?php echo $info["admin_gender"]?>" require name="gender"class="form-control" placeholder="Enter Gender" type="text">
									</div>
								
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
