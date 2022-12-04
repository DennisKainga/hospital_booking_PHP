<?php 
include_once "includes/header.php";
require_once "../control/dbh.inc.php";

$statement = $pdo->prepare("SELECT * FROM specialist WHERE specialist_id=:id");
$statement->bindValue(":id",$_SESSION["uid"]);
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
  $statement->bindValue(":sid",$_SESSION["uid"]);
  $statement->execute();
  header("Location: index.php?mess=updated");


}
?>
<body class="hold-transition layout-top-nav">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white w-100">
    <div class="container d-flex justify-content-evenly">
    
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="app.php" class="nav-link">Visits</a>
          </li>
          <li class="nav-item">
            <a href="acc_update.php" class="nav-link">Update Account</a>
          </li>
        </ul>
      </div>

      <!-- Right navbar links -->
      <ul class="order-1 order-md-3 navbar-nav navbar-no-expand">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item">
          <a href="../control/action.php?action=logout" class="nav-link">Logout</i></a>
        </li>
      
          <!-- Notifications Dropdown Menu -->
      </ul>
    </div>
  </nav>
  <!-- /.navbar -->

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <a href="index.php" class="btn btn-warning m-5 mx-2">Go back</a>
        <div class="card custom-card w-50 m-auto">
						<div class="card-body">
							<h4 class="text-center text-muted mb-3">Edit Personal Information</h4>
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
							
								<button class="btn ripple btn-main-warning btn-block bg-warning">Update</button>
							</form>
		
		
						</div>
					</div>
    <!-- /.content-header -->

    <!-- Main content -->
   
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
<!-- ./wrapper -->

<!-- REQUIRED SCRIPTS -->

<script>  
    var welcome;  
    var date = new Date();  
    var hour = date.getHours();  
    var minute = date.getMinutes();  
    var second = date.getSeconds();  
    var section = document.querySelector(".greeting");
    if (minute < 10) {  
      minute = "0" + minute;  
    }  
    if (second < 10) {  
      second = "0" + second;  
    }  
    if (hour < 12) {  
      welcome = "Good morning";  
    } else if (hour < 17) {  
      welcome = "Good afternoon";  
    } else {  
      welcome = "Good evening";  
    }  
    section.innerHTML=welcome;

</script> 
<?php include_once "includes/footer.php"?>
