<?php
error_reporting(0);
include('includes/config.php');
if (isset($_POST['submit'])) {
    if($_POST['age'] < 16){
        $error = "16 years old below CANT donate!";
    }else{
        if($_POST['password'] !== $_POST['repass']){
            $error = "Password do not match!";
        }else{
        $fullname = $_POST['fullname'];
        $mobile = $_POST['mobileno'];
        $email = $_POST['emailid'];
        $bday = $_POST['bday'];
        $age = $_POST['age'];
        $gender = $_POST['gender'];
        $blodgroup = $_POST['bloodgroup'];
        $purok = $_POST['purok'];
        $barangay = $_POST['barangay'];
        $message = $_POST['message'];
        $status = 1;
        $password = md5($_POST['message']);
        $sql = "INSERT INTO  tblblooddonars(FullName,MobileNumber,EmailId,Age,BirthDay,Gender,BloodGroup,Purok,Barangay,Message,status,password) VALUES(:fullname,:mobile,:email,:age,:bday,:gender,:blodgroup,:purok,:barangay,:message,:status,:password)";
        $query = $dbh->prepare($sql);
        $query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
        $query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
        $query->bindParam(':email', $email, PDO::PARAM_STR);
        $query->bindParam(':age', $age, PDO::PARAM_STR);
        $query->bindParam(':bday', $bday, PDO::PARAM_STR);
        $query->bindParam(':gender', $gender, PDO::PARAM_STR);
        $query->bindParam(':blodgroup', $blodgroup, PDO::PARAM_STR);
        $query->bindParam(':purok', $purok, PDO::PARAM_STR);
        $query->bindParam(':barangay', $barangay, PDO::PARAM_STR);
        $query->bindParam(':message', $message, PDO::PARAM_STR);
        $query->bindParam(':status', $status, PDO::PARAM_STR);
        $query->execute();
        $lastInsertId = $dbh->lastInsertId();
        if ($lastInsertId) {
            $msg = "Your info submitted successfully";
        } else {
            $error = "EMAIL ALREADY TAKEN!";
        }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <?php include('includes/header.php'); ?>

    <!-- <style>
        .navbar-toggler {
            z-index: 1;
        }

        @media (max-width: 576px) {
            nav>.container {
                width: 100%;
            }
        }
    </style>
    <style>
        .errorWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #dd3d36;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }

        .succWrap {
            padding: 10px;
            margin: 0 0 20px 0;
            background: #fff;
            border-left: 4px solid #5cb85c;
            -webkit-box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
            box-shadow: 0 1px 1px 0 rgba(0, 0, 0, .1);
        }
    </style> -->


</head>

<body>

    <?php include('includes/nav.php'); ?>
    <!-- Page Content -->
    <div class="container">

        <!-- Page Heading/Breadcrumbs -->
        <h1 class="mt-4 mb-3">Become a Donor</h1>

        <ol class="breadcrumb">
            <li class="breadcrumb-item">
                <a href="index.php">Home</a>
            </li>
            <li class="breadcrumb-item active">Become a Donor</li>
        </ol>
        <?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
        <!-- Content Row -->
        <form name="donar" method="post">
            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Full Name<span style="color:red">*</span></div>
                    <div><input type="text" name="fullname" placeholder="First Name  Middle Name. Last Name" class="form-control" required></div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Mobile Number<span style="color:red">*</span></div>
                    <div><input type="text" name="mobileno" placeholder="ex: 09487066345" onKeyPress="return isNumberKey(event)" maxlength="11" class="form-control" required></div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Email Id</div>
                    <div><input type="email" placeholder="ex: example@gmail.com" pattern="/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|" (?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]| \\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?| \[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]: (?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/" name="emailid" class="form-control"></div>
                </div>
            </div>

            <div class="row">

                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Birth Day<span style="color:red">*</span></div>
                    <div><input type="date" name="bday" class="form-control" id="bDay" required></div>
                </div>



                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Age<span style="color:red">*</span></div>
                    <div><input type="number" name="age" id="age" onKeyPress="return isNumberKey(event)" class="form-control" required readonly></div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Gender<span style="color:red">*</span></div>
                    <div><select name="gender" class="form-control" required>
                            <option value="">Select</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                        </select>
                    </div>
                </div>

                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Blood Group<span style="color:red">*</span> </div>
                    <div><select name="bloodgroup" class="form-control">
                            <?php $sql = "SELECT * from  tblbloodgroup ";
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
                </div>
            </div>


            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Purok</div>
                    <div><textarea class="form-control" placeholder="ex: P-1" name="purok" required></textarea></div>
                </div>
                <div class="col-lg-4 mb-4">
                    <div class="font-italic">Barangay</div>
                    <div><textarea class="form-control" placeholder="ex: Bakiad" name="barangay" required></textarea></div>
                </div>

                <div class="col-lg-8 mb-4">
                    <div class="font-italic">Message<span style="color:red">*</span></div>
                    <div><textarea class="form-control" name="message" placeholder="ex: gusto kong magbigay ng dugo" required></textarea></div>
                </div>

                <div class="col-lg-8 mb-4">
                    <div class="font-italic">Password<span style="color:red">*</span></div>
                    <div><input type="password" class="form-control" name="password" id="pass" placeholder="" required/></div>
                </div>

                <div class="col-lg-8 mb-4">
                    <div class="font-italic">Retype Password<span style="color:red">*</span></div>
                    <div><input type="password" class="form-control" name="repass" id="repassword" placeholder="" required/></div>
                </div>
            </div>

            <div class="col-lg-8 mb-4">
					<input checked="" type="checkbox" name="term" value="true" required style="margin-left:10px;">
					<span style="margin-left:10px;"><b>I am agree to donate my blood and show my information in Blood donors List</b></span>
				</div>
				<div class="col-lg-8 mb-4">
					<input checked="" type="checkbox" name="term" value="true" required style="margin-left:10px;">
					<span style="margin-left:10px;"><b>I have read the eligibility criteria and confirm that i am eligible to donate blood.</b></span>
				</div>
				<!--End form-group-->

            <div class="row">
                <div class="col-lg-4 mb-4">
                    <div><input type="submit" name="submit" class="btn btn-primary" value="submit" style="cursor:pointer"></div>
                </div>

            </div>


            <!-- /.row -->
        </form>
        <!-- /.row -->
    </div>
    <footer>
        <?php include('includes/footer.php'); ?>
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/tether/tether.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.min.js"></script>

</body>


<script>
    $('#bDay').change(function (e) { 
        e.preventDefault();
        var now = new Date();

        var bday = new Date(this.value)

        // alert(bday.getYear()+1900);

        // var dateToday = (now.getYear()+1900+'/'+now.getMonth()+'/'+now.getDate();
        // alert(Math.abs(bday.getYear()+1900 - now.getYear()+1900));
        console.log(bday.getYear()+1900);
        console.log(now.getYear()+1900)
        var d1 = bday.getYear()+1900;
        var d2 = now.getYear()+1900;
        $('#age').val(d2-d1);
        // console.log(d2-d1);
    });
</script>
</html>