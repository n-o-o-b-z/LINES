<?php
session_start();
// error_reporting(0);
include('../includes/config.php');
if (!isset($_SESSION['user_login'])) {
    header("HTTP/1.1 403 Forbidden");
}

$id = $_POST['id'];
$userid = $_SESSION['id'];
$status = 0;
$date = date('Y-m-d');


$sql2 = "SELECT * FROM event_donors WHERE `user_id`=:userid AND announcement_id=:id";
$query2 = $dbh->prepare($sql2);
$query2->bindParam(':userid',$userid,PDO::PARAM_STR);
$query2->bindParam(':id',$id,PDO::PARAM_STR);
$query2->execute();
$results2 = $query2->fetchAll(PDO::FETCH_OBJ);
$cnt = 1;
if ($query2->rowCount() > 0) {
    echo $msg= 1;
}else{
    $sql="INSERT INTO event_donors(announcement_id,`user_id`,`status`,created_at) VALUES(:id, :userid, :status,:dates)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->bindParam(':userid',$userid,PDO::PARAM_STR);
    $query->bindParam(':status',$status,PDO::PARAM_STR);
    $query->bindParam(':dates',$date,PDO::PARAM_STR);
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
}
?>