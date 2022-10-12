<?php
session_start();
// error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0 || $_SESSION['role'] !== 'Admin') {
    header('location:index.php');
}

$id = $_GET['ids'];

$sql="SELECT * FROM event_donors WHERE id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
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