<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {

	if (isset($_POST['submit'])) {
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
		$status = 0;
		$sql = "INSERT INTO  tblblooddonars(FullName,MobileNumber,EmailId,BirthDay,Age,Gender,BloodGroup,Purok,Barangay,Message,status) VALUES(:fullname,:mobile,:email,:bday,:age,:gender,:blodgroup,:purok,:barangay,:message,:status)";
		$query = $dbh->prepare($sql);
		$query->bindParam(':fullname', $fullname, PDO::PARAM_STR);
		$query->bindParam(':mobile', $mobile, PDO::PARAM_STR);
		$query->bindParam(':email', $email, PDO::PARAM_STR);
		$query->bindParam(':bday', $bday, PDO::PARAM_STR);
		$query->bindParam(':age', $age, PDO::PARAM_STR);
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
			$error = "Something went wrong. Please try again";
		}
	}


?>
	<!doctype html>
	<html lang="en" class="no-js">

	<head>
		<meta charset="UTF-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge">
		<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
		<meta name="description" content="">
		<meta name="author" content="">
		<meta name="theme-color" content="#3e454c">

		<title>BBDMS| Admin Add Donor</title>
		<link rel="icon" href="img/logo 192X192.png" type="image/x-icon" />

		<!-- Font awesome -->
		<link rel="stylesheet" href="css/font-awesome.min.css">
		<!-- Sandstone Bootstrap CSS -->
		<link rel="stylesheet" href="css/bootstrap.min.css">
		<!-- Bootstrap Datatables -->
		<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
		<!-- Bootstrap social button library -->
		<link rel="stylesheet" href="css/bootstrap-social.css">
		<!-- Bootstrap select -->
		<link rel="stylesheet" href="css/bootstrap-select.css">
		<!-- Bootstrap file input -->
		<link rel="stylesheet" href="css/fileinput.min.css">
		<!-- Awesome Bootstrap checkbox -->
		<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
		<!-- Admin Stye -->
		<link rel="stylesheet" href="css/style.css">
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
		</style>
		<script language="javascript">
			function isNumberKey(evt) {

				var charCode = (evt.which) ? evt.which : event.keyCode

				if (charCode > 31 && (charCode < 48 || charCode > 57) && charCode != 46)
					return false;

				return true;
			}
		</script>
	</head>

	<body>
		<?php include('includes/header.php'); ?>
		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Add Donor</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="panel panel-default">
										<div class="panel-heading">Basic Info</div>
										<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>

										<div class="panel-body">
											<form method="post" class="form-horizontal" enctype="multipart/form-data">
												<div class="form-group">
													<label class="col-sm-2 control-label">Full Name<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="fullname" placeholder="First Name  Middle Name. Last Name" class="form-control" required>
													</div>
													<label class="col-sm-2 control-label">Mobile No<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="text" name="mobileno" placeholder="09487066345" onKeyPress="return isNumberKey(event)" maxlength="11" class="form-control" required>
													</div>
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Email id </label>
													<div class="col-sm-4">
														<input type="email" placeholder="example@gmail.com" pattern="/(?:[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*|" (?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21\x23-\x5b\x5d-\x7f]| \\[\x01-\x09\x0b\x0c\x0e-\x7f])*")@(?:(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?| \[(?:(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?)\.){3}(?:25[0-5]|2[0-4][0-9]|[01]?[0-9][0-9]?|[a-z0-9-]*[a-z0-9]: (?:[\x01-\x08\x0b\x0c\x0e-\x1f\x21-\x5a\x53-\x7f]|\\[\x01-\x09\x0b\x0c\x0e-\x7f])+)\])/" name="emailid" class="form-control">
													</div><br>
													<label class="col-sm-2 control-label">Birth Day<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="date" name="bday" onKeyPress="return isNumberKey(event)" class="form-control" required>
													</div><br>
													<label class="col-sm-2 control-label">Age<span style="color:red">*</span></label>
													<div class="col-sm-4">
														<input type="number" name="age" onKeyPress="return isNumberKey(event)" class="form-control" required>
													</div>
													
												</div>

												<div class="form-group">
													<label class="col-sm-2 control-label">Gender <span style="color:red">*</span></label>
													<div class="col-sm-4">
														<select name="gender" class="form-control" required>
															<option value="">Select</option>
															<option value="Male">Male</option>
															<option value="Female">Female</option>
														</select>
													</div>
													<label class="col-sm-2 control-label">Blood Group<span style="color:red">*</span></label>
													<div class="col-sm-4">


														<select name="bloodgroup" class="form-control" required>
															<option value="">Select</option>
															<?php $sql = "SELECT * from  tblbloodgroup ";
															$query = $dbh->prepare($sql);
															$query->execute();
															$results = $query->fetchAll(PDO::FETCH_OBJ);
															$cnt = 1;
															if ($query->rowCount() > 0) {
																foreach ($results as $result) {				?>
																	<option value="<?php echo htmlentities($result->BloodGroup); ?>"><?php echo htmlentities($result->BloodGroup); ?></option>
															<?php }
															} ?>
														</select>

													</div>
												</div>



												<div class="hr-dashed"></div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Purok</label>
													<div class="col-sm-10">
														<textarea class="form-control"pattern="" placeholder="ex: P-1" name="purok"required></textarea>
													</div>
												</div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Barangay</label>
													<div class="col-sm-10">
														<textarea class="form-control"pattern="[a-zA-Z0-9\s]+(\.)? [a-zA-Z\]+(\,)? [a-zA-Z]+(\,)? [0-9\s]{4,}" placeholder="ex: Bakiad" name="barangay"required></textarea>
													</div>
												</div>

												<div class="hr-dashed"></div>
												<div class="form-group">
													<label class="col-sm-2 control-label">Message<span style="color:red">*</span></label>
													<div class="col-sm-10">
														<textarea class="form-control" name="message"required></textarea>
													</div>
												</div>



												<div class="form-group">
													<div class="col-sm-8 col-sm-offset-2">
														<button class="btn btn-default" type="reset">Cancel</button>
														<button class="btn btn-primary" name="submit" type="submit">Save changes</button>
													</div>
												</div>

											</form>
										</div>
									</div>
								</div>
							</div>



						</div>
					</div>



				</div>
			</div>
		</div>

		<!-- Loading Scripts -->
		<script src="js/jquery.min.js"></script>
		<script src="js/bootstrap-select.min.js"></script>
		<script src="js/bootstrap.min.js"></script>
		<script src="js/jquery.dataTables.min.js"></script>
		<script src="js/dataTables.bootstrap.min.js"></script>
		<script src="js/Chart.min.js"></script>
		<script src="js/fileinput.js"></script>
		<script src="js/chartData.js"></script>
		<script src="js/main.js"></script>
	</body>

	</html>
<?php } ?>