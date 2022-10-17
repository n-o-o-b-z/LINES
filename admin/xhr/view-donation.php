<?php
 include('../includes/config.php');

$id = $_POST['id'];
$sql="SELECT a.*,b.FullName FROM donation_history as a LEFT JOIN tblblooddonars as b ON a.user_id = b.id WHERE user_id=:id";
$query = $dbh->prepare($sql);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->execute();
$results = $query->fetchAll(PDO::FETCH_OBJ);
echo json_encode($results);


?>