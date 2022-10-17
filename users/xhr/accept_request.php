<?php
session_start();
    include('../includes/config.php');
    // if($_SESSION['user_login'] == ''){
    if(!isset($_SESSION['user_login'])){
        header('HTTP/1.0 403 Forbidden');
    }
 
    $id         = $_POST['id'];
    $status     = 1;
  
    $sql = "UPDATE donate_request SET status=:status WHERE id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> bindParam(':status', $status, PDO::PARAM_STR);


    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0){
        echo true;
    }else{
        echo false;
    }

    

?>