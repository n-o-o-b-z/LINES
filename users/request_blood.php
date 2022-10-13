<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['user_login']) == 0) {
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
            <div class="content-header">
                <div class="container-fluid">
                    <div class="row mb-2">
                        <div class="col-sm-6">
                            <h1 class="m-0">Search Donor</h1>
                        </div>
                        <div class="col-sm-6">
                            <ol class="breadcrumb float-sm-right">
                                <li class="breadcrumb-item"><a href="#">Home</a></li>
                                <li class="breadcrumb-item active">Dashboard</li>
                            </ol>
                        </div>
                    </div>

                    <div class="form-group mt-5">
                        <form name="donar" method="POST">
                            <div class="row">
                                <div class="form-group col-lg-3">
                                    <label for="exampleInputEmail1">Blood Type</label>
                                    <!-- <input type="email" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email"> -->
                                    <select name="btype" id="btype" class="form-control">
                                        <option value="">Select Blood Group</option>
                                        <?php $sql = "SELECT DISTINCT BloodGroup from  tblbloodgroup ";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {               ?>
                                                <option value="<?php echo htmlentities($result->BloodGroup); ?>"><?php echo htmlentities($result->BloodGroup); ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-3">
                                    <label for="exampleInputEmail1">Purok</label>
                                    <select name="purok" id="purok" class="form-control">
                                        <option value="">Select Purok</option>

                                        <?php $sql = "SELECT DISTINCT Purok from  tblblooddonars ";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {               ?>
                                                <option value="<?php echo htmlentities($result->purok); ?>"><?php echo htmlentities($result->Purok); ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-4">
                                    <label for="exampleInputEmail1">Barangay</label>
                                    <select name="barangay" id="barangay" class="form-control">
                                        <option value="">Select Barangay</option>

                                        <?php $sql = "SELECT DISTINCT Barangay from  tblblooddonars ";
                                        $query = $dbh->prepare($sql);
                                        $query->execute();
                                        $results = $query->fetchAll(PDO::FETCH_OBJ);
                                        $cnt = 1;
                                        if ($query->rowCount() > 0) {
                                            foreach ($results as $result) {               ?>
                                                <option value="<?php echo htmlentities($result->barangay); ?>"><?php echo htmlentities($result->Barangay); ?></option>
                                        <?php }
                                        } ?>
                                    </select>
                                </div>
                                <div class="form-group col-lg-2">
                                    <label for="exampleInputEmail1" style="visibility:hidden">Email address</label>
                                    <input type="submit" name="submit" class="btn btn-info form-control" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="Enter email">
                                </div>
                            </div>
                        </form>
                    </div>

                    <div class="spinner">
                        <div class="row"  style="overflow-y:auto">
                   
                        <?php
                        if (isset($_POST['submit'])) {
                            $status = 0;
                            $bloodgroup = $_POST['btype'];
                            $purok = $_POST['purok'];
                            $barangay = $_POST['barangay'];
                            $sql = "SELECT * from tblblooddonars where status=:status AND  BloodGroup=:bloodgroup ||  (Purok=:purok) || (Barangay=:barangay)";
                            $query = $dbh->prepare($sql);
                            $query->bindParam(':status', $status, PDO::PARAM_STR);
                            $query->bindParam(':bloodgroup', $bloodgroup, PDO::PARAM_STR);
                            $query->bindParam(':purok', $purok, PDO::PARAM_STR);
                            $query->bindParam(':barangay', $barangay, PDO::PARAM_STR);
                            $query->execute();
                            $results = $query->fetchAll(PDO::FETCH_OBJ);
                            $cnt = 1;
                            if ($query->rowCount() > 0) {
                                foreach ($results as $result) { ?>

                                    <div class="col-lg-4 col-sm-6 portfolio-item">
                                        <div class="bg-white p-3 text-center rounded box mt-3" style="overflow-wrap: break-word;"><img class="img-responsive rounded-circle" src="https://i.imgur.com/uppKNuF.jpg" width="90">
                                            <h5 class="mt-3 name"><?php echo htmlentities($result->FullName); ?></h5>
                                            <!-- <span class="work d-block">Comapay agents house</span>
                                            <span class="work d-block">real estate</span> -->

                                            <div class="mt-4 about">
                                                
                                                <div class="row">
                                                    <div class="col-lg-6 text-right">
                                                        <strong>Mobile No: </strong>
                                                    </div>
                                                    <div class="col-lg-6 text-left">
                                                    <a href="tel:<?php echo htmlentities($result->MobileNumber); ?>"><?=isset($result->MobileNumber) ? $result->MobileNumber  : 'N/A' ?></a>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6 text-right">
                                                        <strong>Email: </strong>
                                                    </div>
                                                    <div class="col-lg-6  text-left">
                                                        <a href="mailto:<?php echo htmlentities($result->EmailId); ?>"><?=isset($result->EmailId) ? $result->EmailId  : 'N/A' ?></a>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6 text-right">
                                                        <strong>Gender: </strong>
                                                    </div>
                                                    <div class="col-lg-6  text-left">
                                                        <?=isset($result->Gender) ? $result->Gender  : 'N/A' ?>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6 text-right">
                                                        <strong>Birthday: </strong>
                                                    </div>
                                                    <div class="col-lg-6  text-left">
                                                        <?=isset($result->BirthDay) ? date("m-d-Y", strtotime($result->Birthday))  : 'N/A' ?>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6 text-right">
                                                        <strong>Blood Group: </strong>
                                                    </div>
                                                    <div class="col-lg-6  text-left">
                                                        <?=isset($result->BloodGroup) ? $result->BloodGroup  : 'N/A' ?>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6 text-right">
                                                        <strong>Address: </strong>
                                                    </div>
                                                    <div class="col-lg-6  text-left">
                                                        <?=$result->Purok.' '.$result->Barangay ?>
                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-lg-6 text-right">
                                                        <strong>Message: </strong>
                                                    </div>
                                                    <div class="col-lg-6  text-left">
                                                        <?=isset($result->Message) ? $result->Message  : 'N/A' ?>
                                                    </div>
                                                </div>
                                            </div>

                                            <div class="mt-4">
                                                <?php
                                                $id = $_SESSION['id'];
                                                $to = $result->id;
                                                $sql2="SELECT * FROM donate_request WHERE user_id=:id AND request_to=:to";
                                                $query = $dbh->prepare($sql2);
                                                $query->bindParam(':id',$id,PDO::PARAM_STR);
                                                $query->bindParam(':to',$to,PDO::PARAM_STR);
                                                $query->execute();
                                                $results=$query->fetchAll(PDO::FETCH_OBJ);
                                                if($query->rowCount() > 0){
                                                    ?>
                                                    <button class="btn btn-success" id="btnRequest" value="<?=$result->id?>" disabled>REQUESTED</button>
                                                    <?php }else{ ?>
                                                        <button class="btn btn-danger" id="btnRequest" value="<?=$result->id?>">REQUEST BLOOD</button>
                                                    <?php } ?>
                                            </div>
                                        </div>
                                    </div>

                                    <?php }
                                        } else {
                                            echo htmlentities("No Record Found");
                                        }
                                    } ?>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
                
            
        <?php include('includes/footer.php'); ?>
        <script src="//cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>


        <script>
            $(document).ready(function () {
                

                $(document).on('click','#btnRequest', function () {
                    var id = '<?php echo $_SESSION["id"]; ?>';
                    var to = $(this).val();
                    var test = $(this).get();
                    $.ajax({
                        type: "GET",
                        url: 'xhr/add_request.php',
                        data: {
                            userid:id,
                            to:to
                        },
                        dataType: "html",
                        success: function (response) {
                            if(response == 'ok'){
                                $(test).removeClass('btn-danger');
                                $(test).addClass('btn-success');
                                $(test).addClass('disabled');
                                $(test).attr('disabled', 'disabled');
                                $(test).html('REQUESTED');
                                Swal.fire({
                                    position: 'center',
                                    icon: 'success',
                                    title: 'Successfully Requested!',
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }else {
                                Swal.fire({
                                    position: 'center',
                                    icon: 'error',
                                    title: response,
                                    showConfirmButton: false,
                                    timer: 1500
                                });
                            }
                            
                        }
                    });
                });
            });
        </script>
    </body>
</html>
