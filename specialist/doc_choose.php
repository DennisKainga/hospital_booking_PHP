<?php
include_once "includes/header.php";
require_once "../control/dbh.inc.php";
$statement = $pdo->prepare("SELECT specialist.*,specialization.specialization_name FROM specialist 
INNER JOIN specialization ON specialization.specialization_id=specialist.specialist_specialization_id WHERE specialist.specialist_id=:did");
$statement->bindValue(":did",$_GET["did"]);
$statement->execute();
$doc  = $statement->fetch(PDO::FETCH_ASSOC);
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $date  = $_POST["date"];
    $statement=$pdo->prepare("INSERT INTO appointment(appointment_patient_id,appointment_specialist_id,appointment_date)
    VALUES(:pid,:did,:date)");
    $statement->bindValue(":pid",$_SESSION["uid"]);
    $statement->bindValue(":did",$_GET["did"]);
    $statement->bindValue(":date",$date);
    $statement->execute();
    header("Location: index.php?mess=booked");
}
?>
<body class="hold-transition layout-top-nav">
<div class="wrapper">

<style>
    body{
    background:#eee;
}

.card{
    border:none;

    position:relative;
    overflow:hidden;
    border-radius:8px;
    cursor:pointer;
}

.card:before{
    
    content:"";
    position:absolute;
    left:0;
    top:0;
    width:4px;
    height:100%;
    background-color:#E1BEE7;
    transform:scaleY(1);
    transition:all 0.5s;
    transform-origin: bottom
}

.card:after{
    
    content:"";
    position:absolute;
    left:0;
    top:0;
    width:4px;
    height:100%;
    background-color:#8E24AA;
    transform:scaleY(0);
    transition:all 0.5s;
    transform-origin: bottom
}

.card:hover::after{
    transform:scaleY(1);
}


.fonts{
    font-size:15px;
}

.social-list{
    display:flex;
    list-style:none;
    justify-content:center;
    padding:0;
}

.social-list li{
    padding:10px;
    color:#8E24AA;
    font-size:19px;
}


.buttons button:nth-child(1){
       border:1px solid #8E24AA !important;
       color:#8E24AA;
       height:40px;
}

.buttons button:nth-child(1):hover{
       border:1px solid #8E24AA !important;
       color:#fff;
       height:40px;
       background-color:#8E24AA;
}

.buttons button:nth-child(2){
       border:1px solid #8E24AA !important;
       background-color:#8E24AA;
       color:#fff;
        height:40px;
}
</style>
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
  
    <!-- Main content -->
    <div class="content">
      
    <div class="container">
    
    <div class="row d-flex justify-content-center">
        
        <div class="col-md-7">
            
            <div class="card p-3 py-4 mt-2">
                
                <div class="text-center">
                    <img src="profile.jpg" width="100" class="rounded-circle">
                </div>
                
                <div class="text-center mt-3">
                    <span class="bg-secondary p-1 px-4 rounded text-white">Hi !</span>
                    <h5 class="mt-2 mb-0">Dr. <?php echo htmlspecialchars($doc["specialist_name"])?></h5>
                    <span></span>
                    
                    <div class="px-4 mt-1">
                        <p class="fonts">Hi <strong><?php echo htmlspecialchars($_SESSION["name"])?></strong> Am looking foward to being of assistance to you please pick a date that is most convient for you and i will get back to you below are my official comunication links</p>
                    
                    </div>
                    
                     <ul class="social-list">
                        <li><i class="fa fa-whatsapp"></i></li>
                      
                        <li><i class="fa fa-envelope"></i></li>
                    </ul>
                    
                    <form action="" method="POST">
                    <div class="row">
                        <div class="form-group text-left col">
                            <label>Pick Date</label>
                            <input required name="date" class="form-control" placeholder="Choose appointment Date" type="date">
                        </div>
                    </div>
                   
                    <div class="buttons">
                        
                        <a href="index.php?mess=canceled" class="btn btn-outline-danger px-4">Cancel</a>
                        <button type="submit" class="btn btn-primary px-4 ms-3">Submit</button>
                    </div>
                    </form>
                    
                </div>
                
               
                
                
            </div>
            
        </div>
        
    </div>
    
</div>
    </div>
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
<?php include_once "includes/footer.php"?>
