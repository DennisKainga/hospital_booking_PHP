<?php
include_once "includes/header.php";
require_once "../control/dbh.inc.php";

$statement = $pdo->prepare("SELECT patient.*,appointment.* FROM appointment 
JOIN patient ON patient.patient_id=appointment.appointment_patient_id 
WHERE 
appointment.appointment_specialist_id=:uid AND 
appointment.appointment_status !=0  ORDER BY 
appointment.appointment_id DESC");
$statement->bindValue(":uid",$_SESSION["uid"]);

$statement->execute();
$pats  = $statement->fetchAll(PDO::FETCH_ASSOC);

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
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2 w-100 ml-auto">
          <div class="col-sm-12">
           
            <hr>
            <h5 class="text-muted text-center">Below is a list of your patients</h5>
            <hr>
          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">
        <div class="row">
        <?php foreach($pats as $i=>$pat):{?>
            <?php
                
                if($pat["appointment_status"]=="1"){
                    $color = "bg-danger";
                    $style = "";
                    $text = "Pending Visitation";
                }
                if($pat["appointment_status"]=="2"){
                    $color = "bg-success";
                    $text = "Visitation Complete";
                    $style = "disabled";
                }
                if($pat["appointment_status"]=="8"){
                    $color = "bg-warning";
                    $text = "Visitation Canceled";
                    $style = "disabled";
                }
                ?>
          <div class="col-lg-6">
           
            <div class="card card-primary card-outline">
              <div class="card-header d-flex justify-content-between">
                <div class="left">
                    <h5 class="card-title m-0"><?php echo $i+1?></h5><h6 class="card-title">. &nbsp;<span class="text-muted">Patient Name</span> <span class="text-danger"><?php echo $pat["patient_name"]?></span></h6>
                </div>
                <div class="right ml-auto">
                <span class="badge rounded-pill <?php echo $color?>"><?php echo $text?></span>
                </div>
            </div>
              <div class="card-body">
                <p class="card-text">Hi Expect me to be there on <strong><?php echo htmlspecialchars($pat["appointment_date"])?></strong> Reach me on <strong><?php echo htmlspecialchars($pat["patient_mobile"])?></strong> Thank you</p>
                <a  href="visit.php?pid=<?php echo $pat["patient_id"]?>&app_id=<?php echo $pat["appointment_id"]?>" class="btn btn-primary <?php echo $style?>">Start Visit</a>
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
