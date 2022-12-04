<?php 
include_once "includes/header.php";
require_once "../control/dbh.inc.php";

$statement = $pdo->prepare("SELECT * FROM specialization ORDER BY specialization_id DESC");
$statement->execute();
$spes = $statement->fetchAll(PDO::FETCH_ASSOC);
if($_SERVER["REQUEST_METHOD"]=="POST"){
    $title = $_POST["title"];
    $desc = $_POST["desc"];
    unset($statement);
    $statement = $pdo->prepare("INSERT INTO specialization(specialization_name,specialization_desc)
    VALUES(:title,:desc)");
    $statement->bindValue(":title",$title);
    $statement->bindValue(":desc",$desc);
    $statement->execute();
    header("Refresh: 0");
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
            <h1 class="m-0">This is a list of all Specialization</h1>
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
        </div>
        <div class="card custom-card w-75 mx-auto mb-5">
            <div class="card-body">
                <h4 class="text-center text-muted mb-3">Add new specialization</h4>
                <hr>
                <form method="POST" action="">
                    <div class="row">
                        <div class="form-group text-left col">
                            <label>Title</label>
                            <input require name="title" class="form-control" placeholder="Enter title for Specialization" type="text">
                        </div>
                    </div>
                    <div class="row">
                        <div class="form-group text-left col">
                            <label>Description</label>
                            <textarea require name="desc" class="form-control" placeholder="Enter Description" type="text"></textarea>
                        </div>
                    </div>
                    <button class="btn ripple btn-main-primary btn-block bg-dark w-25 mx-auto">Add</button>
                </form>
              
            </div>
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
                    <th>Title</th>           
                  </tr>
                  </thead>
                  <tbody>
                    <?PHP foreach($spes as $i=>$spe):{?>
                  <tr>
                    <td><?php echo $i+1?></td>
                    <td><?php echo $spe["specialization_name"]?></td>
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
