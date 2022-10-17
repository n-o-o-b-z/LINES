<?php
session_start();
// error_reporting(0);
include('../includes/config.php');
if(strlen($_SESSION['alogin'])==0){	
    header('location:index.php');
}

$title      = $_GET['title'];
$date       = $_GET['date'];
$location   = $_GET['location'];
$organizer  = $_GET['organizer'];
$details    = $_GET['details'];

$date2=date_create($_GET['date']);
$date_true =  date_format($date2,"Y-m-d H:i:s");

$sql="INSERT INTO announcement(title, date, location, organizer, details) VALUES(:title, :date, :location, :organizer, :details)";
$query = $dbh->prepare($sql);
$query->bindParam(':title',$title,PDO::PARAM_STR);
$query->bindParam(':date',$date_true,PDO::PARAM_STR);
$query->bindParam(':location',$location,PDO::PARAM_STR);
$query->bindParam(':organizer',$organizer,PDO::PARAM_STR);
$query->bindParam(':details',$details,PDO::PARAM_STR);
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