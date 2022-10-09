<?php
    include('../includes/config.php');
 
    $id         = $_GET['id'];
    $fname      = $_GET['fname'];
    $email      = $_GET['email'];
    $role       = $_GET['role'];

    $arr  = [];
    $sql = "UPDATE admin SET Full_name = :fname, role_id = :roles ,Email = :email WHERE id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> bindParam(':fname', $fname, PDO::PARAM_STR);
    $query-> bindParam(':roles', $role, PDO::PARAM_STR);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);

    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0){
        echo true;
    }else{
        echo false;
    }

    

?>