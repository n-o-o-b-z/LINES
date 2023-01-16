<?php
    include('../includes/config.php');
    // if (strlen($_SESSION['alogin']) == 0 || $_SESSION['role'] !== 'Admin') {
    //     header('location:index.php');
    // }
    
    $id = $_POST['data'];
    $status = $_POST['status'];
 
    if($status == 0){
        $status = 1;
    }elseif($status == 1){
        $status = 0;
    }

    $sql = "UPDATE announcement SET is_hidden=:status WHERE id=:id";

    $query= $dbh -> prepare($sql);
   
    $query-> bindParam(':status', $status, PDO::PARAM_STR);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);

    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0){
        echo true;
    }else{
        echo false;
    }


?>