<?php
session_start();
error_reporting(0);
include('includes/config.php');
include('includes/header.php');
?>
<?php
$pagetype = $_GET['type'];
$sql = "SELECT type,detail,PageName from tblpages where type=:pagetype";
$query = $dbh->prepare($sql);
$query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
?>

        
        <body>
        <?php include('includes/nav.php'); ?>

            <?php include('includes/header.php'); ?>
            <!-- Page Content -->
            
                <?php
                //! ---------------
                //! FOR breadcrumb
                //! ---------------
                // $pagetype = $_GET['type'];
                // $sql = "SELECT type,detail,PageName from tblpages where type=:pagetype";
                // $query = $dbh->prepare($sql);
                // $query->bindParam(':pagetype', $pagetype, PDO::PARAM_STR);
                // $query->execute();
                // $results = $query->fetchAll(PDO::FETCH_OBJ);
                // $cnt = 1;
                $hidden  = 0;
                $sql = "SELECT title,date,location,organizer,details from announcement WHERE is_hidden = :hidden";
                $query = $dbh->prepare($sql);
                $query->bindParam(':hidden',$hidden,PDO::PARAM_STR);
                $query->execute();
                $results = $query->fetchAll(PDO::FETCH_OBJ);
                $cnt = 1;

                if ($query->rowCount() > 0) {
                    foreach ($results as $result) { ?>
                   <div class="container col-lg-5" style="margin-top: 40px;">     
                        <div class="card text-center mb-4">
                            <div class="card-body">
                                <h5 class="card-title"><?php echo $result->title; ?></h5>
                                    <p class="card-text border-bottom">
                                        <?php
                                        $date = date_create($result->date);
                                        ?>
                                    <div class="text-left">
                                        <strong>Date: </strong><span><?=date_format($date,"M-d-Y H:iA");?></span><br>
                                        <strong>Location: </strong><span><?=$result->location?></span><br>
                                        <?=isset($result->organizer) ? '<strong>Organizer: </strong><span>'.$result->organizer.'</span><br>': '';?>
                                        <?=isset($result->details) ? '<strong>Details: </strong><span>'.$result->details.'</span><br>': '';?>
                                    </div
                                </p>
                                <a href="#" class="btn btn-danger">Donate Now!</a>
                            </div>
                       </div>

            </div>
            <!-- /.container -->
    <?php }
                } ?>

    <!-- Footer -->
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

        </body>

        </html>