<?php
session_start();
// error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0 || $_SESSION['role'] !== 'Admin') {
    header('location:index.php');
}

$fname      = $_GET['fname'];
$email      = $_GET['email'];
$password   = md5($_GET['password']);
$role       = $_GET['role'];

date_default_timezone_set('Asia/Manila');
// $date = date('Y-m-d g:i A');
$date = date('Y-m-d H:i:s');

$sql="INSERT INTO admin(role_id, Email, Password, Full_name, updationDate) VALUES(:roles, :email, :pass, :fname, :updationDate)";
$query = $dbh->prepare($sql);
$query->bindParam(':roles',$role,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':pass',$password,PDO::PARAM_STR);
$query->bindParam(':fname',$fname,PDO::PARAM_STR);
$query->bindParam(':updationDate',$date,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
    echo $msg="true";
}
else 
{
    echo $error="Something went wrong. Please try again";
}

?>