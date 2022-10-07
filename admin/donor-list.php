<?php
session_start();
error_reporting(0);
include('includes/config.php');
if (strlen($_SESSION['alogin']) == 0) {
	header('location:index.php');
} else {
	if (isset($_REQUEST['hidden'])) {
		$eid = intval($_GET['hidden']);
		$status = "0";
		$sql = "UPDATE tblblooddonars SET Status=:status WHERE  id=:eid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':eid', $eid, PDO::PARAM_STR);
		$query->execute();

		$msg = "Booking Successfully Cancelled";
	}


	if (isset($_REQUEST['public'])) {
		$aeid = intval($_GET['public']);
		$status = 1;

		$sql = "UPDATE tblblooddonars SET Status=:status WHERE  id=:aeid";
		$query = $dbh->prepare($sql);
		$query->bindParam(':status', $status, PDO::PARAM_STR);
		$query->bindParam(':aeid', $aeid, PDO::PARAM_STR);
		$query->execute();

		$msg = "Booking Successfully Confirmed";
	}
	if (isset($_REQUEST['del'])) {
		$did = intval($_GET['del']);
		$sql = "delete from tblblooddonars WHERE  id=:did";
		$query = $dbh->prepare($sql);
		$query->bindParam(':did', $did, PDO::PARAM_STR);
		$query->execute();

		$msg = "Record deleted Successfully ";
	}
	if (isset($_REQUEST['update'])) {
		$did = intval($_GET['update']);
		$sql = "UPDATE  tblblooddonars SET FullName=:fullname,MobileNumber=:mobile,EmailId=:email,BirthDay=:bday,Age=:age,Gender=:gender,BloodGroup=:blodgroup,Purok=:purok,Barangay=:barangay,Message=:message,status=:status WHERE id=:did";
		$query = $dbh->prepare($sql);
		$query->bindParam(':did', $did, PDO::PARAM_STR);
		$query->execute();

		$msg = "Record Updated Successfully ";
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

		<title>BBDMS | Donor List </title>
		<link rel="icon" href="img/26042022123157Bakiad.png" type="image/x-icon" />
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

			.btn-group>.btn-group:not(:first-child)>.btn,
			.btn-group>.btn:not(:first-child) {
				border-top-left-radius: 0;
				border-bottom-left-radius: 0;
			}

			.btn-group>.btn-group:not(:first-child),
			.btn-group>.btn:not(:first-child) {
				margin-left: -1px;
			}

			.btn:not(:disabled):not(.disabled) {
				cursor: pointer;
			}

			.btn-group-vertical>.btn,
			.btn-group>.btn {
				position: relative;
				-ms-flex: 1 1 auto;
				flex: 1 1 auto;
			}

			.dropdown-toggle-split {
				padding-right: .5625rem;
				padding-left: .5625rem;
			}

			.dropdown-toggle {
				white-space: nowrap;
			}

			button.btn.btn-success {
				color: #fff;
				font: 15px "Open Sans", sans-serif;
				background: #28A745;
				padding: 6.5px 6px;
			}


			button.btn-success.dropdown-toggle.dropdown-toggle-split {
				color: #fff;
				font: 16px "Open Sans", sans-serif;
				background: #28A745;
				margin: 0px 0px 0px -3px;
				padding: 6px 6px;
			}

			.dropdown-toggle-split::after,
			.dropright .dropdown-toggle-split::after,
			.dropup .dropdown-toggle-split::after {
				margin-left: 0;
			}

			.dropdown-toggle::after {
				display: inline-block;
				margin-left: .100em;
				vertical-align: .100em;
				content: "";
				border-top: .3em solid;
				border-right: .3em solid transparent;
				border-bottom: 0;
				border-left: .3em solid transparent;
			}
		</style>

	</head>

	<body>
		<?php include('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Donors List</h2>

							<!-- Zero Configuration Table -->
							<div class="panel panel-default">
								<div class="panel-heading">Donors Info</div>
								<div class="panel-body">
									<?php if ($error) { ?><div class="errorWrap"><strong>ERROR</strong>:<?php echo htmlentities($error); ?> </div><?php } else if ($msg) { ?><div class="succWrap"><strong>SUCCESS</strong>:<?php echo htmlentities($msg); ?> </div><?php } ?>
									<a href="download-records.php" style="color:red; font-size:16px;">Download Donor List</a>
									<table id="zctb" class="display table table-striped table-bordered table-hover" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Mobile #</th>
												<th>Email</th>
												<th>Birth Date</th>
												<th>Gender</th>
												<th>Blood Group</th>
												<th>Purok</th>
												<th>Barangay</th>
												<th>Message </th>
												<th>action </th>
											</tr>
										</thead>
										<tfoot>
											<tr>
												<th>#</th>
												<th>Name</th>
												<th>Mobile #</th>
												<th>Email</th>
												<th>Birth Date</th>
												<th>Gender</th>
												<th>Blood Group</th>
												<th>Purok</th>
												<th>Barangay</th>
												<th>Message </th>
												<th>action </th>
											</tr>
										</tfoot>
										<tbody>

											<?php $sql = "SELECT * from  tblblooddonars ";
											$query = $dbh->prepare($sql);
											$query->execute();
											$results = $query->fetchAll(PDO::FETCH_OBJ);
											$cnt = 1;
											if ($query->rowCount() > 0) {
												foreach ($results as $result) {				?>
													<tr>
														<td><?php echo htmlentities($cnt); ?></td>
														<td><?php echo htmlentities($result->FullName); ?></td>
														<td><?php echo htmlentities($result->MobileNumber); ?></td>
														<td><?php echo htmlentities($result->EmailId); ?></td>
														<td><?php echo htmlentities($result->BirthDay); ?></td>
														<td><?php echo htmlentities($result->Gender); ?></td>
														<td><?php echo htmlentities($result->BloodGroup); ?></td>
														<td><?php echo htmlentities($result->Purok); ?></td>
														<td><?php echo htmlentities($result->Barangay); ?></td>
														<td><?php echo htmlentities($result->Message); ?></td>


														<td>

															<div class="btn-group">
																<button type="button" class="btn btn-success">Action</button>
																<button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																	<span class="sr-only">Toggle Dropdown</span>
																</button>
																<div class="dropdown-menu">
																	<?php if ($result->status == 1) { ?>
																		<a class="dropdown-item make_hidden" href="donor-list.php?hidden=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you really want to hiidden this detail')"> Make Hidden</a><br>
																	<?php } else { ?>
																		<div class="dropdown-divider"></div>
																		<a class="dropdown-item make_public" href="donor-list.php?public=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you really want to Public this detail')"> Make Public</a><br>
																		<div class="dropdown-divider"></div>
																	<?php } ?>
																	<a class="dropdown-item delete_user" href="donor-list.php?del=<?php echo htmlentities($result->id); ?>" onclick="return confirm('Do you really want to delete this record')"> Delete</a><br>
																	<a class="dropdown-item edit_user" href="javascript:void(0)" data-id="<?php echo $row['id'] ?>">Edit</a>



																</div>
															</div>
														</td>

													</tr>
											<?php $cnt = $cnt + 1;
												}
											} ?>

										</tbody>
									</table>



								</div>
							</div>



						</div>
					</div>

				</div>
			</div>
		</div>

		<!-- Loading Scripts -->
		<script>
			$('.edit_user').click(function() {
				uni_modal('Edit User', 'update-donor-info.php?id=' + $(this).attr('data-id'))
			})
		</script>
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