<?php
include_once "includes/header.php";
require_once "../control/dbh.inc.php";
$pid = $_GET["pid"];
$app_id = $_GET["app_id"];
$statement = $pdo->prepare("SELECT * FROM patient WHERE patient_id=:id");
$statement->bindValue(":id",$_GET["pid"]);
$statement->execute();
$pat = $statement->fetch(PDO::FETCH_ASSOC);
if($_SERVER["REQUEST_METHOD"]=="POST"&& $_POST['randcheck']==$_SESSION['rand']){
   $desc = $_POST["desc"];
   $status =$_POST["status"];
   $statement = $pdo->prepare("INSERT INTO ailment(ailment_appointment_id,ailment_desc,ailment_specialist_id,ailment_status)
   VALUES(:app_id,:desc,:asid,:status)");
   $statement->bindValue(":app_id",$_GET["app_id"]);
   $statement->bindValue(":desc",$desc);
   $statement->bindValue(":asid",$_SESSION["uid"]);
   $statement->bindValue(":status",$status);
   $statement->execute();
}
unset($statement);
$statement = $pdo->prepare("SELECT ailment.*,appointment.* FROM ailment 
INNER JOIN appointment ON appointment.appointment_id=ailment.ailment_appointment_id 
WHERE appointment.appointment_patient_id=:pid");
$statement->bindValue(":pid",$_GET["pid"]);
$statement->execute();
$ailments=$statement->fetchAll(PDO::FETCH_ASSOC);

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
          <!-- <li class="nav-item">
            <a href="visit.php" class="nav-link">Visits</a>
          </li> -->
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
        
        <div class="col-md-6">
            
            <div class="card p-3 py-4 mt-2">
                
                <div class="text-center">
                    <img src="profile.jpg" width="100" class="rounded-circle">
                </div>
                
                <div class="text-center mt-3">
                    <span class="bg-secondary p-1 px-4 rounded text-white">DOB: <?PHP echo htmlspecialchars($pat["patient_dob"])?> </span><br><br>
                    <span class="bg-primary p-1 px-4 rounded text-white"><?PHP echo htmlspecialchars($pat["patient_gender"])?> </span>
                    <h5 class="mt-2 mb-4">Name. <strong><?php echo htmlspecialchars($pat["patient_name"])?></strong></h5>
                                    <hr>
                    <form action="" method="POST">
                    <?php
                          $rand=rand();
                          $_SESSION['rand']=$rand;
                          ?>
                        <input type="hidden" value="<?php echo $rand; ?>" name="randcheck" />
                      <div class="row">
                        <div class="form-group text-left col">
                            <label>Enter Ailement Description</label>
                            <input required name="desc" class="form-control" placeholder="Enter ailement Description" type="text">
                        </div>
                        <div class="form-group text-left col">
                            <label>Ailment Status</label>
                            <input required name="status" class="form-control" placeholder="Enter Ailment status" type="text">
                        </div>
                      </div>
                    
                      <div class="buttons">
                          <button type="submit" class="btn btn-outline-primary px-4 ms-3 w-50">Add Ailment</button>
                      </div>
                      <hr>
                  </form>
                  <div class="buttons mt-3 d-flex justify-content-between">
                    <a href="comp.php?app_id=<?php echo $app_id?>" class="btn btn-outline-success px-4 btn-sm">Complete Visit</a>
                      <a href="app.php?mess=canceled" class="btn btn-outline-danger px-4 btn-sm">Cancel</a>
                  </div>
                </div>                
            </div>
            
        </div>
        <div class="col-md-6 mt-2">
      <p>
        <a class="btn btn-primary w-100" data-toggle="collapse" href="#collapseExample" role="button" aria-expanded="false" aria-controls="collapseExample">
            View Ailments
        </a>
      </p>
      <div class="collapse" id="collapseExample">
        <div class="card card-body">
        <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Descrip</th>           
                    <th>Status</th>           
                    <th>Appointment</th>           
                    <th>Action</th>           
                  </tr>
                  </thead>
                  <tbody>
                    <?PHP foreach($ailments as $i=>$ailment):{?>
                  <tr>
                    <td><?php echo $i+1?></td>
                    <td><?php echo $ailment["ailment_desc"]?></td>
                    <td><?php echo $ailment["ailment_status"]?></td>
                    <td><?php echo $ailment["appointment_date"]?></td>
                   <td>
                    <a href="ail_del.php?aid=<?php echo $ailment["ailment_id"]?>&pid=<?php echo $pid?>&app_id=<?php echo $app_id?>" class="btn btn-danger mb-3 btn-sm">Delete</a></td>
                  </tr>
                  <?PHP }endforeach;?>
               
                  </tbody>
                  
                </table>
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
