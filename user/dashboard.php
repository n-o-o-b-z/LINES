<?php
session_start();
error_reporting(0);
include('includes/config.php');
// if (strlen($_SESSION['user_login']) == 0) {
// 	header('location:index.php');
// } else {
?>
	<!doctype html>
	<html lang="en" class="no-js">

	<?php include('includes/header.php'); ?>

	<body>
		<?php include('includes/header.php'); ?>

		<div class="ts-main-content">
			<?php include('includes/leftbar.php'); ?>
			<div class="content-wrapper">
				<div class="container-fluid">

					<div class="row">
						<div class="col-md-12">

							<h2 class="page-title">Dashboard</h2>

							<div class="row">
								<div class="col-md-12">
									<div class="row">
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-primary" style="color: white;">
													<div class="stat-panel text-center">
														<?php
														$sql = "SELECT id from tblbloodgroup ";
														$query = $dbh->prepare($sql);
														$query->execute();
														$results = $query->fetchAll(PDO::FETCH_OBJ);
														$bg = $query->rowCount();
														?>
														<div class="stat-panel-number h1 "><?php echo htmlentities($bg); ?></div>
														<div class="stat-panel-title text-uppercase">Listed Blood Groups</div>
													</div>
												</div>
												<button class="block-anchor panel-footer"  data-toggle="modal" data-target="#exampleModal">Full Detail <i class="fa fa-arrow-right"></i></button>
											</div>
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-success text-light">
													<div class="stat-panel text-center">
														<?php
														$sql1 = "SELECT id from tblblooddonars ";
														$query1 = $dbh->prepare($sql1);;
														$query1->execute();
														$results1 = $query1->fetchAll(PDO::FETCH_OBJ);
														$regbd = $query1->rowCount();
														?>
														<div class="stat-panel-number h1 "><?php echo htmlentities($regbd); ?></div>
														<div class="stat-panel-title text-uppercase">Registered Blood Group</div>
													</div>
												</div>
												<a href="donor-list.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
											</div>
										</div>
										<div class="col-md-3">
											<div class="panel panel-default">
												<div class="panel-body bk-info text-light">
													<div class="stat-panel text-center">
														<?php
														$sql6 = "SELECT id from tblcontactusquery ";
														$query6 = $dbh->prepare($sql6);;
														$query6->execute();
														$results6 = $query6->fetchAll(PDO::FETCH_OBJ);
														$query = $query6->rowCount();
														?>
														<div class="stat-panel-number h1 "><?php echo htmlentities($query); ?></div>
														<div class="stat-panel-title text-uppercase">Total Quries</div>
													</div>
												</div>
												<a href="manage-conactusquery.php" class="block-anchor panel-footer text-center">Full Detail &nbsp; <i class="fa fa-arrow-right"></i></a>
											</div>
										</div>

									</div>
								</div>
							</div>
						</div>
					</div>
					
					<!-- <div class="row">
						<div class="col-lg-12">
							<div class="col-lg-6">
								<div class="card">
									<div class="card-header">
										<h5>TESE</h5>
									</div>
									<div class="card-body">
										<table id="example" class="display" style="width:100%">
											<thead>
												<tr>
													<th>Name</th>
													<th>LOCATION</th>
													<th>Age</th>
													<th>DATE</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Edinburgh</td>
													<td>61</td>
													<td>2011-04-25</td>
													<td>$320,800</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>

							<div class="col-lg-6">
								
							</div>
						</div>
					</div> -->












				</div>
			</div>
		</div>


		<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
			<div class="modal-dialog modal-lg" role="document">
				<div class="modal-content">
				<div class="modal-header">
					<h1 class="modal-title" id="exampleModalLabel">List of Saved lives</h1>
					<button type="button" class="close" data-dismiss="modal" aria-label="Close">
					<span aria-hidden="true">&times;</span>
					</button>
				</div>
				<div class="modal-body">
							<div class="row">
						<div class="col-lg-12">
							
								<div class="card">
									<div class="card-header">
										<h5>TESE</h5>
									</div>
									<div class="card-body">
										<table id="example" class="display" style="width:100%">
											<thead>
												<tr>
													<th>Name</th>
													<th>Unit of Blood donated</th>
													<th>LOCATION</th>
													<th>Age</th>
													<th>DATE</th>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td>Edinburgh</td>
													<td>1000cc</td>
													<td>61</td>
													<td>2011-04-25</td>
													<td>$320,800</td>
												</tr>
											</tbody>
										</table>
									</div>
								</div>
						</div>
					</div>

				</div>
				<div class="modal-footer">
					<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
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

		<script>
			window.onload = function() {

				// Line chart from swirlData for dashReport
				var ctx = document.getElementById("dashReport").getContext("2d");
				window.myLine = new Chart(ctx).Line(swirlData, {
					responsive: true,
					scaleShowVerticalLines: false,
					scaleBeginAtZero: true,
					multiTooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
				});

				// Pie Chart from doughutData
				var doctx = document.getElementById("chart-area3").getContext("2d");
				window.myDoughnut = new Chart(doctx).Pie(doughnutData, {
					responsive: true
				});

				// Dougnut Chart from doughnutData
				var doctx = document.getElementById("chart-area4").getContext("2d");
				window.myDoughnut = new Chart(doctx).Doughnut(doughnutData, {
					responsive: true
				});

			}
		</script>

		<script>
			$(document).ready(function () {
				$('#example').DataTable();
			});
		</script>
	</body>

	</html>
