<?php
    include('../includes/config.php');
    // $id= 1;
    // $id = $_GET['data'];
    $id = $_GET['id'];
    $arr  = [];
    $sql ="SELECT id,title,date,location,organizer,details FROM announcement WHERE id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0)
    {
        foreach ($results as $result){
            array_push($arr,$result);
        }
        echo json_encode($arr);
        
    }

?>