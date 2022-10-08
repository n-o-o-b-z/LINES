<?php
session_start();
error_reporting(0);
include('../includes/config.php');
if(strlen($_SESSION['alogin'])==0){	
    header('location:index.php');
}

$bloodgroup = $_GET['BloodGroup'];
$sql="INSERT INTO  tblbloodgroup(BloodGroup) VALUES(:bloodgroup)";
$query = $dbh->prepare($sql);
$query->bindParam(':bloodgroup',$bloodgroup,PDO::PARAM_STR);
$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
    echo $msg="Blood Group Created successfully";
}
else 
{
    echo $error="Something went wrong. Please try again";
}

?>