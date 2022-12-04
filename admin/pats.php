<?php 
include_once "includes/header.php";
require_once "../control/dbh.inc.php";

$statement = $pdo->prepare("SELECT * FROM patient
 ORDER BY patient_id DESC");
$statement->execute();
$patients = $statement->fetchAll(PDO::FETCH_ASSOC);

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
            <h1 class="m-0">This is a list of all Patients</h1>
          </div>
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Info boxes -->
        <div class="row">
        
          <a href="index.php" class="btn btn-warning mb-3 mx-2">Home</a>
          <!-- <a href="specs_add.php" class="btn btn-success mb-3 mx-2">Add specialist</a> -->
        </div>
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">Arranged from latest to earliest</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Name</th>
                    <th>Phone</th>
                    <th>Email</th>
                    <th>Gender</th>
                    <th>DOB</th>
                    <th>Location</th>          
                    <th>Action</th>                   
                  </tr>
                  </thead>
                  <tbody>
                    <?PHP foreach($patients as $i=>$patient):{?>
                  <tr>
                    <td><?php echo $i+1?></td>
                    <td><?php echo $patient["patient_name"]?></td>
                    <td><?php echo $patient["patient_mobile"]?></td>
                    <td><?php echo $patient["patient_email"]?></td>
                    <td><?php echo $patient["patient_gender"]?></td>
                    <td><?php echo $patient["patient_dob"]?></td>
                    <td><?php echo $patient["patient_location"]?></td>
                    <td> 
                      <a href="pat_edit.php?id=<?php echo $patient["patient_id"]?>" class="btn btn-success mb-3">Edit</a>
                      <a href="user_del.php?lid=<?php echo $patient["patient_login_id"]?>" class="btn btn-danger mb-3">Delete</a>
                    </td>
                  </tr>
                  <?PHP }endforeach;?>
               
                  </tbody>
                  
                </table>
              </div>
              <!-- /.card-body -->
            </div>
          <!-- /.col -->
    </div><!--/. container-fluid -->
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
