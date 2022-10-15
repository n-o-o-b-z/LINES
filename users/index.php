<?php
session_start();
include('includes/config.php');
if(isset($_SESSION['user_login'])){
	header('LOCATION: dashboard2.php');
}
if(isset($_POST['login']))
{
$email=$_POST['email'];
$password=md5($_POST['password']);


// $sql ="SELECT a.Full_name,a.Email,a.Password,a.role_id,b.id,b.name,a.status FROM admin AS a LEFT JOIN roles AS b ON a.role_id = b.id WHERE Email=:email and Password=:password";
$sql = "SELECT id, FullName, EmailId,status FROM tblblooddonars WHERE EmailId=:email AND password=:password";
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
			echo "<script>alert('Inactived Account!');</script>";
		}elseif($results[0]->status == 2){
			echo "<script>alert('Banned Account!');</script>";
		}
	}else{
		$_SESSION['user_login'] = $_POST['email'];
		// $_SESSION['roles']   = $results[0]->name;
		$_SESSION['name'] = $results[0]->FullName;
		$_SESSION['id'] = $results[0]->id;

		// echo "<script type='text/javascript'> document.location = 'change-password.php'; </script>";
		echo "<script type='text/javascript'> document.location = 'dashboard2.php'; </script>";
	}
	
	
	
} else{
	
	echo "<script>alert('Invalid Details');</script>";

	
//   echo "<script>alert('Invalid Details');</script>";

}

}

?>

<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>LIFELINE | User Login</title>

	<link rel="stylesheet" href="css/font-awesome.min.css">
	<link rel="stylesheet" href="../vendor/bootstrap/css/bootstrap.min.css">

	<link rel="stylesheet" href="css/dataTables.bootstrap.min.css">
	<link rel="stylesheet" href="css/bootstrap-social.css">
	<link rel="stylesheet" href="css/bootstrap-select.css">
	<link rel="stylesheet" href="css/fileinput.min.css">
	<link rel="stylesheet" href="css/awesome-bootstrap-checkbox.css">
	<link rel="icon" href="img/26042022123157Bakiad.png" type="image/x-icon"/>
	<link rel="stylesheet" href="css/style.css">
	<!-- icons  -->
	<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.15.4/css/all.css" integrity="sha384-DyZ88mC6Up2uqS4h/KRgHuoeGwBcD4Ng9SiP4dIRy0EXTlnuz47vAwmeGwVChigm" crossorigin="anonymous">

	<style>
		@import url("https://fonts.googleapis.com/css2?family=Poppins&display=swap");

		* {
			margin: 0px;
			padding: 0px;
			box-sizing: border-box;
			font-family: "Poppins", sans-serif;
		}

		.flex-r,
		.flex-c {
			justify-content: center;
			align-items: center;
			display: flex;
		}

		.flex-c {
			flex-direction: column;
		}

		.flex-r {
			flex-direction: row;
		}

		.container {
			width: 100%;
			min-height: 100vh;
			padding: 20px 10px;
			background: #e5e5e5;
		}

		.login-text {
			background-color: #f6f6f6;
			max-width: 400px;
			min-height: 500px;
			border-radius: 10px;
			padding: 10px 20px;
		}

		.logo {
			margin-bottom: 20px;
		}

		.logo span,
		.logo span i {
			font-size: 25px;
			color: #0d8aa7;
		}

		.login-text h1 {
			font-size: 25px;
		}

		.login-text p {
			font-size: 15px;
			color: #000000b2;
		}

		form {
			align-items: flex-start !important;
			width: 100%;
			margin-top: 15px;
		}

		.input-box {
			margin: 10px 0px;
			width: 100%;
		}

		.label {
			font-size: 15px;
			color: black;
			margin-bottom: 3px;
		}

		.input {
			background-color: #f6f6f6;
			padding: 0px 5px;
			border: 2px solid rgba(216, 216, 216, 1);
			border-radius: 10px;
			overflow: hidden;
			justify-content: flex-start;
		}

		input {
			border: none;
			outline: none;
			padding: 10px 5px;
			background-color: #f6f6f6;
			flex: 1;
		}

		.input i {
			color: rgba(0, 0, 0, 0.4);
		}

		.check span {
			color: #000000b2;
			font-size: 15px;
			font-weight: bold;
			margin-left: 5px;
		}

		.btn {
			color: #ffffff;
			border-radius: 30px;
			padding: 10px 15px;
			background: linear-gradient(122.33deg, #68bed1 30.62%, #1e94e9 100%);
			margin-top: 30px;
			margin-bottom: 10px;
			font-size: 16px;
			transition: all 0.3s linear;
		}

		.btn:hover {
			transform: translateY(-2px);
		}

		.extra-line {
			font-size: 15px;
			font-weight: 600;
		}

		.extra-line a {
			color: #0095b6;
		}

	</style>
</head>


<body>
  <div class=" flex-r container">
    <div class="flex-r login-wrapper">
      <div class="login-text">
		<div class="logo">
        	<span><i class="fab fa-speakap"></i></span>
          	<span>LIFELINE</span>
        </div>
        <h1>Login</h1>
        <p>It's not long before you embark on this journey! </p>

        <form class="flex-c" method="POST">
          <div class="input-box">
            <span class="label">E-mail</span>
            <div class=" flex-r input">
              <input type="text" name="email">
              <!-- <i class="fas fa-at"></i> -->
            </div>
          </div>

          <div class="input-box">
            <span class="label">Password</span>
            <div class="flex-r input">
              <input type="password" name="password" id="test_input" >
              <!-- <i class="fas fa-lock"></i> -->
			  <!-- <i class="far fa-eye"></i> -->
			  <i class="far fa-eye-slash" class="opener" id="eye_close"></i>
			  <i class="far fa-eye" class="opener" id="eye_open"></i>
            </div>
          </div>

          <div class="check">
            <input type="checkbox" name="" id="">
            <span>Remember me</span>
          </div>

          <input class="form-control btn" type="submit" name="login" value="Submit">
          <span class="extra-line">
            <span>Forgot password?</span>
            <a href="forgot.php">Recover here.</a>
          </span>
        </form>

      </div>
    </div>
  </div>
</body>

<script src="../vendor/jquery/jquery.min.js"></script>
<script>
	$('#eye_open').hide();
	$('#eye_close').click(function(){
    	if($('#test_input').attr('type') =='password'){
			//  $('#test-input').prop('type', 'text');
			$('#test_input').attr('type', 'text');
			$('#eye_close').hide();
			$('#eye_open').show();
		
		}else{
			$('#test_input').attr('type', 'password');
			$('#eye_close').show();
			$('#eye_open').hide();
		}
	});

	$('#eye_open').click(function(){
    	if($('#test_input').attr('type') =='text'){
			//  $('#test-input').prop('type', 'text');
			$('#test_input').attr('type', 'password');
			$('#eye_close').show();
			$('#eye_open').hide();
		
		}else{
			$('#test_input').attr('type', 'text');
			$('#eye_close').hide();
			$('#eye_open').show	();
		}
	});
</script>

</html>