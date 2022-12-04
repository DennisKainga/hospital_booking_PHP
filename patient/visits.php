<?php
include_once "includes/header.php";
require_once "../control/dbh.inc.php";

$statement = $pdo->prepare("SELECT specialist.*,patient.*,appointment.* FROM appointment 
INNER JOIN specialist ON specialist.specialist_id=appointment.appointment_specialist_id 
INNER JOIN patient ON patient.patient_id=appointment.appointment_patient_id
WHERE appointment.appointment_patient_id=:pid ORDER BY appointment.appointment_id DESC");
$statement->bindValue(":pid",$_SESSION["uid"]);
$statement->execute();
$pats  = $statement->fetchAll(PDO::FETCH_ASSOC);


?>
<body class="hold-transition layout-top-nav">

<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand-md navbar-light navbar-white">
    <div class="container">
      <button class="navbar-toggler order-1" type="button" data-toggle="collapse" data-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <div class="collapse navbar-collapse order-3" id="navbarCollapse">
        <!-- Left navbar links -->
        <ul class="navbar-nav">
          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>
          <li class="nav-item">
            <a href="visits.php" class="nav-link">Visits</a>
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
            <h5 class="text-muted text-center">Below is a list of your Visits</h5>
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
                    $style = "disabled";
                    $text = "Pending Visitation";
                }
                if($pat["appointment_status"]=="2"){
                    $color = "bg-success";
                    $text = "Visitation Complete";
                    $style = "";
                  
                }
                if($pat["appointment_status"]=="0"){
                  $color = "bg-danger";
                  $style = "disabled";
                  $text = "Pending Visitation";
                  
                }
                if($pat["appointment_status"]=="8"){
                  $color = "bg-warning";
                  $style = "disabled";
                  $text = "Visitation canceled";
                  $display = "hidden";
                  
                }
                ?>
          <div class="col-lg-6">
           
            <div class="card card-primary card-outline">
              <div class="card-header d-flex justify-content-between">
                <div class="left d-inline">
                    <h5 class="card-title m-0"><?php echo $i+1?></h5><h6 class="card-title">&nbsp;<span class="text-muted">Doctor</span> <span class="text-danger"><?php echo $pat["specialist_name"]?></span></h6>
                </div>
                <div class="right ml-auto">
                <span class="badge rounded-pill <?php echo $color?>"><?php echo $text?></span>
                </div>
            </div>
              <div class="card-body">
                <p class="card-text">This is visitation was done on <strong><?php echo htmlspecialchars($pat["appointment_date"])?></strong></p>
                
                <div class="d-flex justify-content-between">
                <a href="ail.php?pid=<?php echo $pat["patient_id"]?>&app_id=<?php echo $pat["appointment_id"]?>" class="btn btn-primary <?php echo $style?>">View ailments</a>
                <?php if($pat["appointment_status"]=="8"):{?>
                <a href="app_del.php?app_id=<?php echo $pat["appointment_id"]?>" class="btn btn-danger">Delete</a>
                  <?php }endif;?>

                </div>
              
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
