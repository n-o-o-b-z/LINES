<?php
session_start();
// error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0){
    header('location:index.php');
}

$date      = $_POST['date'];
$loc      = $_POST['loc'];
$requester   = $_POST['requester'];
$accepter   = $_POST['accepter'];

$status = 0;

date_default_timezone_set('Asia/Manila');
$date2=date_create($_POST['date']);
$date_true =  date_format($date2,"Y-m-d H:i:s");

$sql="INSERT INTO appointments(requester_id,accepter_id,date,location,status) VALUES(:requester, :accepter, :date, :loc, :status)";
$query = $dbh->prepare($sql);
$query->bindParam(':requester',$requester,PDO::PARAM_STR);
$query->bindParam(':accepter',$accepter,PDO::PARAM_STR);
$query->bindParam(':date',$date_true,PDO::PARAM_STR);
$query->bindParam(':loc',$loc,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);

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