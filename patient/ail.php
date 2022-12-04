<?php
include_once "includes/header.php";
require_once "../control/dbh.inc.php";

$statement = $pdo->prepare("SELECT ailment.*,appointment.* FROM ailment 
INNER JOIN appointment ON appointment.appointment_id=ailment.ailment_appointment_id
WHERE appointment_patient_id=:pid");
$statement->bindValue(":pid",$_SESSION["uid"]);
$statement->execute();
$ails  = $statement->fetchAll(PDO::FETCH_ASSOC);


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
           
            <hr>
            <h5 class="text-muted text-center">Below is a list of your Ailments issued during this visit</h5>
            <hr>
          </div><!-- /.col -->
        
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <div class="content">
      <div class="container">

      <div class="card">
              <div class="card-header">
                <h3 class="card-title">Arranged from latest to earliest</h3>
              </div>
              <!-- /.card-header -->
              <a href="visits.php" class="btn btn-primary">Back</a>
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Ailment Desc</th>               
                    <th>ailment Status</th>
                  </tr>
                  </thead>
                  <tbody>
                    <?PHP foreach($ails as $i=>$ail):{?>
                  <tr>
                    <td><?php echo $i+1?></td>
                    <td><?php echo $ail["ailment_desc"]?></td>
                    <td><?php echo $ail["ailment_status"]?></td>
                  </tr>
                  <?PHP }endforeach;?>
               
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
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
