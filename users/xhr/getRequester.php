<?php
    include('../includes/config.php');
    // $id= 1;
    // $id = $_GET['data'];
    $id = $_POST['id'];
    $arr  = [];
    $sql ="SELECT b.FullName FROM donate_request AS a LEFT JOIN tblblooddonars as b ON b.id = a.user_id  WHERE a.id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> execute();
    // $results=$query->fetchAll(PDO::FETCH_OBJ);
    $results = $query->fetch();
    if($query->rowCount() > 0)
    {
        // var_dump($results);
        echo $results['FullName'];
        
    }

?>