<?php
    include('../includes/config.php');
    // $id= 1;
    // $id = $_GET['data'];
    $id = $_POST['id'];
    $sql ="SELECT * FROM tblblooddonars WHERE id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        echo json_encode($results);
    }

?>