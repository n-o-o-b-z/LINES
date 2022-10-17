<?php
session_start();
// error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0 || $_SESSION['role'] !== 'Admin') {
    header('location:index.php');
}

$id = $_GET['id'];



$sql="SELECT a.*,b.FullName FROM event_donors AS a LEFT JOIN tblblooddonars AS b ON a.user_id = b.id WHERE announcement_id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0){
    $data =  json_encode($results);
    echo $data;
}else{
    echo 'wala';
}

?>