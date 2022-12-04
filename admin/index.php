<?php 
include_once "includes/header.php";
require_once "../control/dbh.inc.php";

$statement = $pdo->prepare("SELECT * FROM login ORDER BY login_id DESC");
$statement->execute();
$users = $statement->fetchAll(PDO::FETCH_ASSOC);

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
            <h1 class="m-0">Welcome <?php echo htmlspecialchars($_SESSION["name"])?></h1>
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
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-eye"></i></span>
              <a href="specs.php" class="btn">
                <div class="info-box-content">
                  <span class="info-box-text">specialist</span>
                </div>
              </a>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-eye"></i></span>
              <a href="spes.php" class="btn">
                <div class="info-box-content">
                  <span class="info-box-text">Specialization</span>
                </div>
              </a>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-eye"></i></span>
              <a href="pats.php" class="btn">
                <div class="info-box-content">
                  <span class="info-box-text">Patients</span>
                </div>
              </a>
            </div>
          </div>
          <div class="col-12 col-sm-6 col-md-3">
            <div class="info-box">
              <span class="info-box-icon bg-info elevation-1"><i class="fas fa-eye"></i></span>
              <a href="admin.php" class="btn">
                <div class="info-box-content">
                  <span class="info-box-text">Administrator</span>
                </div>
              </a>
            </div>
          </div>
         
        </div>
        <div class="card">
              <div class="card-header">
                <h3 class="card-title">List Of new users</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="example1" class="table table-bordered table-striped">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>Username</th>
                    <th>Rank</th>
                    <th>Password</th>
                   
                  </tr>
                  </thead>
                  <tbody>
                    <?PHP foreach($users as $i=>$user):{?>
                      <?php 
                        
                        if($user["login_rank"]=="spec"){
                          $text = "Specialist";
                          $icon = "<i class='fas fa-user-md'></i>";
                        }
                        if($user["login_rank"]=="admin"){
                          $text = "Administrator";
                          $icon  = "<i class='fas fa-solid fa-user'></i>";
                        }
                        if($user["login_rank"]=="patient"){
                          $text = "Patient";
                          $icon = "<i class='fas fa-male'></i>";
                        }
                        ?>
                  <tr>
                    <td><?php echo $i+1?></td>
                    <td><?php echo $user["login_username"]?></td>
                    <td><?php echo $icon."<br>".$text?> </td>
                    <td><i class='fas fa-shield-alt'></i></td>
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
