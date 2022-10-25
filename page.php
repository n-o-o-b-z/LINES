<?php
    session_start();
    error_reporting(0);
    $page = 'announcement';
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
            <div class="container">
                <div class="row">
                
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
                    $sql = "SELECT id,title,date,location,organizer,details,banner from announcement WHERE is_hidden = :hidden";
                    $query = $dbh->prepare($sql);
                    $query->bindParam(':hidden',$hidden,PDO::PARAM_STR);
                    $query->execute();
                    $results = $query->fetchAll(PDO::FETCH_OBJ);
                    $cnt = 1;

                    if ($query->rowCount() > 0) {
                        foreach ($results as $result) { ?>
                        <div class="col-lg-3">

                            <div class="card mt-5">
                                    <?php
                                        $date = date_create($result->date);
                                        $path = str_replace('../', '', $result->banner);
                                        if(isset($result->banner)):?>
                                            <img src="<?= './'.$path?>" class="card-img-top" alt="...">
                                        <?php else:?>
                                            <img  src="./images/active.webp" class="card-img-top" alt="...">

                                    <?php endif; ?>
                            
                                <div class="card-body">
                                    <h5 class="card-title"><?=$result->title?></h5>
                                    <p class="card-text">
                                    <strong>Date: </strong><span><?=date_format($date,"M-d-Y H:iA");?></span><br>
                                    <strong>Location: </strong><span><?=$result->location?></span><br>
                                    <?=isset($result->organizer) ? '<strong>Organizer: </strong><span>'.$result->organizer.'</span><br>': '';?>
                                    <?=isset($result->details) ? '<strong>Details: </strong><span>'.$result->details.'</span><br>': '';?>
                                    </p>


                                    <?php
                                        $userid = $_SESSION['id'];
                                        $announcement_id = $result->id;
                                        $sql2 = "SELECT * FROM event_donors WHERE `user_id`=:userid AND announcement_id=:announcement_id";
                                        $query2 = $dbh->prepare($sql2);
                                        $query2->bindParam(':userid',$userid,PDO::PARAM_STR);
                                        $query2->bindParam(':announcement_id',$announcement_id,PDO::PARAM_STR);
                                        $query2->execute();
                                        $results=$query->fetchAll(PDO::FETCH_OBJ);
                                        if($query2->rowCount() > 0){ ?>
                                                <button class="btn btn-success" id="join" value="<?=$result->id?>" disabled>Registered</button>
                                                <?php }else{ ?>
                                                    <button class="btn btn-info" id="join" data-id="<?=$result->id?>">Register</button>
                                        <?php } ?>
                                    
                                    
                                        
                                </div>
                            </div>
                        </div>
                        
                    <?php }} ?>
                </div>
            </div>


                    
   

    <!-- Footer -->
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>


    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

    <script>
       $(document).ready(function () {
            $(document).on('click','#join', function () {
                var data = $(this).data('id');
                var test = $(this).get();
                $.ajax({
                    type: "POST",
                    url: "users/xhr/join_event.php",
                    data: {id:data},
                    dataType: "JSON",
                    statusCode: {
                        403: function (response) {
                            window.location.href = "users/";
                        },
                    },
                    success: function (response) {
                        
                        switch (response) {
                            case 1:
                                alert('Already Joined!');
                            break;
                            case true:
                                $(test).removeClass('btn-info');
                                $(test).addClass('btn-success');
                                $(test).addClass('disabled');
                                $(test).attr('disabled', 'disabled');
                                $(test).html('Registered');
                            break;
                        }
                    }
                });

            });
        });
    </script>

</body>

</html>