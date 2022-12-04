<?php 
include_once "includes/header.php";
require_once "../control/dbh.inc.php";

$statement = $pdo->prepare("SELECT specialist.*,specialization.specialization_name FROM specialist
INNER JOIN specialization ON specialist.specialist_specialization_id=specialization.specialization_id
 ORDER BY specialist.specialist_id DESC");
$statement->execute();
$specialists = $statement->fetchAll(PDO::FETCH_ASSOC);

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
            <h1 class="m-0">This is a list of all specialist</h1>
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
          <a href="specs_add.php" class="btn btn-success mb-3 mx-2">Add specialist</a>
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
                    <th>Location</th>
                    <th>Specilization</th>                   
                    <th>Action</th>                   
                  </tr>
                  </thead>
                  <tbody>
                    <?PHP foreach($specialists as $i=>$specialist):{?>
                  <tr>
                    <td><?php echo $i+1?></td>
                    <td><?php echo $specialist["specialist_name"]?></td>
                    <td><?php echo $specialist["specialist_mobile"]?></td>
                    <td><?php echo $specialist["specialist_email"]?></td>
                    <td><?php echo $specialist["specialist_gender"]?></td>
                    <td><?php echo $specialist["specialist_location"]?></td>
                    <td><?php echo $specialist["specialization_name"]?></td>
                    <td> 
                      <a href="specs_edit.php?id=<?php echo $specialist["specialist_id"]?>&spes=<?php echo $specialist["specialization_name"]?>" class="btn btn-success mb-3">Edit</a>
                      <a href="user_del.php?lid=<?php echo $specialist["specialist_login_id"]?>" class="btn btn-danger mb-3">Delete</a>
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
