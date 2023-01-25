<?php
session_start();
$error = array();

require "mail.php";

if (!$con = mysqli_connect("localhost", "root", "", "bbdms")) {

	die("could not connect");
}

$mode = "enter_email";
if (isset($_GET['mode'])) {
	$mode = $_GET['mode'];
}

//something is posted
if (count($_POST) > 0) {

	switch ($mode) {
		case 'enter_email':
			// code...
			$email = $_POST['email'];
			//validate email
			if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
				$error[] = "Please enter a valid email";
			} elseif (!valid_email($email)) {
				$error[] = "That email was not found";
			} else {

				$_SESSION['forgot']['email'] = $email;
				send_email($email);
				header("Location: forgot.php?mode=enter_code");
				die;
			}
			break;

		case 'enter_code':
			// code...
			$code = $_POST['code'];
			$result = is_code_correct($code);

			if ($result == "the code is correct") {

				$_SESSION['forgot']['code'] = $code;
				header("Location: forgot.php?mode=enter_password");
				die;
			} else {
				$error[] = $result;
			}
			break;

		case 'enter_password':
			// code...
			$password = $_POST['password'];
			$password2 = $_POST['password2'];

			if ($password !== $password2) {
				$error[] = "Passwords do not match";
			} elseif (!isset($_SESSION['forgot']['email']) || !isset($_SESSION['forgot']['code'])) {
				header("Location: forgot.php");
				die;
			} else {

				save_password($password);
				if (isset($_SESSION['forgot'])) {
					unset($_SESSION['forgot']);
				}

				header("Location: index.php");
				die;
			}
			break;

		default:
			// code...
			break;
	}
}

function send_email($email)
{

	global $con;

	$expire = time() + (60 * 1);
	$code = rand(10000, 99999);
	$email = addslashes($email);

	$query = "insert into codes (email,code,expire) value ('$email','$code','$expire')";
	mysqli_query($con, $query);

	//send email here
	send_mail($email, 'Password reset', "Your code is " . $code);
}

function save_password($password)
{

	global $con;

	$password = md5($_POST['password']);
	$email = addslashes($_SESSION['forgot']['email']);

	$query = "update admin set Password = '$password' where Email = '$email' limit 1";
	mysqli_query($con, $query);
}

function valid_email($email)
{
	global $con;

	$email = addslashes($email);

	$query = "select * from admin where Email = '$email' limit 1";
	$result = mysqli_query($con, $query);
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			return true;
		}
	}

	return false;
}

function is_code_correct($code)
{
	global $con;

	$code = addslashes($code);
	$expire = time();
	$email = addslashes($_SESSION['forgot']['email']);

	$query = "select * from codes where code = '$code' && email = '$email' order by id desc limit 1";
	$result = mysqli_query($con, $query);
	if ($result) {
		if (mysqli_num_rows($result) > 0) {
			$row = mysqli_fetch_assoc($result);
			if ($row['expire'] > $expire) {

				return "the code is correct";
			} else {
				return "the code is expired";
			}
		} else {
			return "the code is incorrect";
		}
	}

	return "the code is incorrect";
}


?>

<!DOCTYPE html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, minimum-scale=1, maximum-scale=1">
	<title>Forgot</title>
	<link rel="icon" href="img/logo 192X192.png" type="image/x-icon"/>
</head>
<style type="text/css">
	* {
		margin: 0;
		padding: 0;
		box-sizing: border-box;
		font-family: tahoma;
		font-size: 13px;
	}

	body {
		min-height: 100vh;
		background: #eee;
		display: flex;
		font-family: 'Oswald', 'sans-serif';
	}

	.container {
		margin: auto;
		width: 500px;
		max-width: 90%;
	}

	.container form {
		width: 100%;
		height: 100%;
		padding: 20px;
		background: white;
		border-radius: 4px;
		box-shadow: 0 8px 16px rgba(0, 0, 0, .3);
	}

	.container form h1 {
		text-align: center;
		margin-bottom: 24px;
		color: #222;
	}

	.container form .form-control {
		width: 100%;
		height: 40px;
		background: white;
		border-radius: 4px;
		border: 1px solid silver;
		margin: 10px 0 18px 0;
		padding: 0 10px;
	}

	.container form .btn {
		margin-left: 50%;
		transform: translate(-50%);
		width: 120px;
		height: 34px;
		border: none;
		outline: none;
		background: #27a327;
		cursor: pointer;
		font-size: 16px;
		text-transform: uppercase;
		color: white;
		border-radius: 4px;
		transition: .3s;
	}

	.container form .btn:hover {
		opacity: 7;
	}
</style>

<body>

	<div class="container">
		<div class="form-goup">
			<?php

			switch ($mode) {
				case 'enter_email':
					// code...
			?>
					<form method="post" action="forgot.php?mode=enter_email">
						<h1>Forgot Password</h1>
						<h3>Enter your email below</h3>
						<span style="font-size: 12px;color:red;">
							<?php
							foreach ($error as $err) {
								// code...
								echo $err . "<br>";
							}
							?>
						</span>
						<input class="form-control" type="email" name="email" placeholder="email" required><br>
						<input type="submit" class="btn" value="Next">
						<br><br>
						<div><a href="index.php">Login</a></div>
					</form>

		</div>

		<div class="form-group">
		<?php
					break;

				case 'enter_code':
					// code...
		?>
			<form method="post" action="forgot.php?mode=enter_code">
				<h1>Forgot Password</h1>
				<h3>Enter your the code sent to your email</h3>
				<span style="font-size: 12px;color:red;">
					<?php
					foreach ($error as $err) {
						// code...
						echo $err . "<br>";
					}
					?>
				</span>

				<input class="form-control" type="number" name="code" placeholder="12345" required><br>
				<input type="submit" class="btn" value="Next">
				<br><br>
				<a href="forgot.php">
					<input type="button" class="btn" value="Start Over">
				</a>
				<br><br>
				<div><a href="index.php">Login</a></div>
			</form>

		</div>

		<div class="form-group">
		<?php
					break;

				case 'enter_password':
					// code...
		?>
			<form method="post" action="forgot.php?mode=enter_password">
				<h1>Forgot Password</h1>
				<h3>Enter your new password</h3>
				<span style="font-size: 12px;color:red;">
					<?php
					foreach ($error as $err) {
						// code...
						echo $err . "<br>";
					}
					?>
				</span>

				<input class="form-control" type="text" name="password" placeholder="Password"><br>
				<input class="form-control" type="text" name="password2" placeholder="Retype Password"><br>
				<input type="submit" class="btn" value="Next"> <br><br>
				<a href="forgot.php">
					<input type="button" class="btn" value="Start Over">
				</a>
				<br><br>
				<div><a href="index.php">Login</a></div>
			</form>
	<?php
					break;

				default:
					// code...
					break;
			}

	?>
		</div>

	</div>




</body>

</html>