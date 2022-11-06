<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['alogin'])){
	header('LOCATION: dashboard2.php');
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

	<title>LIFELINE | Admin Login</title>
	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="icon" href="img/26042022123157Bakiad.png" type="image/x-icon"/>
	<link rel="stylesheet" href="css/style.css">
	<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11.4.37/dist/sweetalert2.all.min.js"></script>
</head>

<body>
	
	<div class="login-page bk-img" style="background-image: url(img/banner.jpg);">
		<div class="form-content">
			<div class="container">
				<div class="row">
					<div class="col-md-6 col-md-offset-3">
						<h1 class="text-center text-bold text-light mt-4x">LIFELINE: Blood Donor Management System Sign in</h1>
						<div class="well row pt-2x pb-3x bk-light">
							<div class="col-md-8 col-md-offset-2">
								<form method="post">

									<label for="" class="text-uppercase text-sm">Email</label>
									<input type="email" placeholder="Email" name="email" class="form-control mb" required>

									<label for="" class="text-uppercase text-sm">Password</label>
									<input type="password" placeholder="Password" name="password" class="form-control mb" required>

								

									<button class="btn btn-primary btn-block" name="login" type="submit">LOGIN</button>
									<br><br>
									<div><a href="forgot.php" style="align-items: center;">Forgot password?</a></div>
								</form>
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

<?php
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=md5($_POST['password']);
// $status = 0;
// $sql ="SELECT Email,Password FROM admin WHERE Email=:email and Password=:password";
$sql ="SELECT a.Full_name,a.Email,a.Password,a.role_id,b.id,b.name,a.status FROM admin AS a LEFT JOIN roles AS b ON a.role_id = b.id WHERE Email=:email and Password=:password";
$query= $dbh -> prepare($sql);
$query-> bindParam(':email', $email, PDO::PARAM_STR);
$query-> bindParam(':password', $password, PDO::PARAM_STR);
// $query-> bindParam(':status', $status, PDO::PARAM_STR);
$query-> execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0)
{

	if($results[0]->status == 1 || $results[0]->status == 2 ){
		if($results[0]->status == 1){
			// echo "<script>alert('Inactived Account!');</script>";
			echo "<script>
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Inactived Account!',
						showConfirmButton: false,
						timer: 1500
					});
				</script>";
		}elseif($results[0]->status == 2){
			echo "<script>
					Swal.fire({
						position: 'center',
						icon: 'error',
						title: 'Your account is banned!',
						showConfirmButton: false,
						timer: 1500
					});
	  			</script>";
		}
	}else{
		$_SESSION['alogin'] = $_POST['email'];
		$_SESSION['role']   = $results[0]->name;
		$_SESSION['full_name'] = $results[0]->Full_name;
		// echo "<script type='text/javascript'> document.location = 'change-password.php'; </script>";
		echo "<script type='text/javascript'> document.location = 'dashboard2.php'; </script>";
	}
	
} else{
	echo "<script>
			Swal.fire({
				position: 'center',
				icon: 'error',
				title: 'No match record found',
				showConfirmButton: false,
				timer: 1500
			});
	  	</script>";
}

}

?>