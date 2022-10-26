<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include('includes/new-header.php'); ?>
</head>
<body>
    <?php include('includes/nav.php'); ?>
    <?php include('includes/sidebar.php'); ?>

    <div class="content-wrapper">
    <!-- Content Header (Page header) -->
    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div><!-- /.col -->
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard v1</li>
            </ol>
          </div><!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->
        <div class="row">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-primary" style="color: white;">
              <div class="inner">
                <?php
                    $sql = "SELECT id from tblbloodgroup ";
                    $query = $dbh->prepare($sql);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $bg = $query->rowCount();
                ?>
                <h3><?php echo htmlentities($bg); ?></h3>

                <p>LISTED BLOOD GROUPS</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="manage-bloodgroup2.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box" style="color: white;background-color: #800000">
              <div class="inner">
                <?php
                    $sql1 = "SELECT id from tblblooddonars ";
                    $query1 = $dbh->prepare($sql1);;
                    $query1->execute();
                    $results1 = $query1->fetchAll(PDO::FETCH_OBJ);
                    $regbd = $query1->rowCount();
                ?>
                <h3><?php echo htmlentities($regbd); ?></h3>

                <p>REGISTERED BLOOD GROUP</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning" style="color:white !important;">
              <div class="inner">
              <?php
                    $sql6 = "SELECT id from tblcontactusquery ";
                    $query6 = $dbh->prepare($sql6);;
                    $query6->execute();
                    $results6 = $query6->fetchAll(PDO::FETCH_OBJ);
                    $query = $query6->rowCount();
                ?>
                <h3><?php echo htmlentities($query); ?></h3>

                <p>TOTAL QUIRIES</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" style="color:white !important;" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
              <?php
                    $status = 0; //active
                    $sql ="SELECT id FROM tblblooddonars WHERE `status`=:status";
                    $query= $dbh -> prepare($sql);
                    $query-> bindParam(':status', $status, PDO::PARAM_STR);
                    $query-> execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $counter = $query->rowCount();
                ?>
                <h3><?php echo htmlentities($counter); ?></h3>

                <p>ACTIVE DONORS</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="manage-donors" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-secondary">
              <div class="inner">
              <?php
                    $status = 1; //active
                    $sql ="SELECT id FROM tblblooddonars WHERE `status`=:status";
                    $query= $dbh -> prepare($sql);
                    $query-> bindParam(':status', $status, PDO::PARAM_STR);
                    $query-> execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $counter = $query->rowCount();
                ?>
                <h3><?php echo htmlentities($counter); ?></h3>

                <p>INACTIVE DONORS</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="manage-donors.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
              <?php
                    $status = 2; //active
                    $sql ="SELECT id FROM tblblooddonars WHERE `status`=:status";
                    $query= $dbh -> prepare($sql);
                    $query-> bindParam(':status', $status, PDO::PARAM_STR);
                    $query-> execute();
                    $results=$query->fetchAll(PDO::FETCH_OBJ);
                    $counter = $query->rowCount();
                ?>
                <h3><?php echo htmlentities($counter); ?></h3>
                <p>BANNED DONORS</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="manage-donors.php" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>

          
        </div>
        <!-- /.row -->
        <!-- Main row -->
      
        <!-- /.row (main row) -->
      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <?php include('includes/footer.php'); ?>
  <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
</body>
</html>