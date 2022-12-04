<?php
include_once "includes/header.php";
require_once "../control/dbh.inc.php";
$statement = $pdo->prepare("SELECT specialist.*,specialization.specialization_name FROM specialist 
INNER JOIN specialization ON specialization.specialization_id=specialist.specialist_specialization_id 
WHERE specialist.specialist_id NOT IN(SELECT appointment.appointment_specialist_id FROM appointment 
WHERE appointment_status<0)
ORDER BY specialist_id DESC");
$statement->execute();
$specs  = $statement->fetchAll(PDO::FETCH_ASSOC);
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
            <a href="visits.php" class="nav-link">Visits</a>
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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 w-100 ml-auto">
          <div class="col-sm-12">
            <h1 class="m-0 text-center"><small class="greeting"></small> <small><?php echo htmlspecialchars($_SESSION["name"])?></small></h1>
            <hr>
            <h5 class="text-muted text-center">Below are available doctors</h5>
          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
        <?php foreach($specs as $i=>$spes):{?>
          <?php 
            unset($statement);
            $statement = $pdo->prepare("SELECT appointment.*,patient.* FROM appointment
             INNER JOIN patient ON appointment.appointment_patient_id=patient.patient_id
             WHERE appointment.appointment_status=1 AND appointment_specialist_id=:sid");
             $statement->bindValue(":sid",$spes["specialist_id"]);
             $statement->execute();
             $count = $statement->fetchAll(PDO::FETCH_ASSOC);


             $avg_waiting_time = sizeof($count)*20;

             
             if($avg_waiting_time<=59 ){
              $time = $avg_waiting_time;
              $text = "Minute (s)";
              $color = "text-success";
             }
            
             if($avg_waiting_time>59){
              $time = $avg_waiting_time/60;
              $text= "Hour(s)";
              $color = "text-danger";
             }
             
             
            
            ?>
          <div class="col-lg-6">
           
            <div class="card card-primary card-outline">
              <div class="card-header">
                <h5 class="card-title m-0"><?php echo $i+1?></h5><h6 class="card-title">. &nbsp;   Department <?php echo $spes["specialization_name"]?></h6>
              </div>
              <div class="card-body">
                <p class="card-text">Hi am Doctor <strong><?php echo htmlspecialchars($spes["specialist_name"])?></strong>I am free click here to book an appointment with me am Currently located in <strong><?php echo $spes["specialist_location"]?></strong>
              There are currently <strong><?php echo sizeof($count)?></strong> patient(s) in the que <span class="<?php echo $color?>"><strong>Average Waiting Time= <?php echo htmlspecialchars(ceil($time))." ".$text?></strong></span></p>
                <a href="doc_choose.php?did=<?php echo $spes["specialist_id"]?>" class="btn btn-primary">Pick Me</a>
              </div>
            </div>
          </div>
          <?php }endforeach;?>
          <!-- /.col-md-6 -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
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
