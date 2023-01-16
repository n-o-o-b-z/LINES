<?php
    include('../includes/config.php');
    
    $id = $_POST['id'];
    $opened = 0;

    $sql = "UPDATE tblcontactusquery SET is_opened=:opened WHERE id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':opened', $opened, PDO::PARAM_STR);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query->execute();
    
    $sql2 = "SELECT * FROM tblcontactusquery WHERE id=:ids";
    $query2 = $dbh->prepare($sql2);
    $query2->bindParam(':ids',$id,PDO::PARAM_STR);
    $query2->execute();
    $results2 = $query2->fetchAll(PDO::FETCH_OBJ);
    echo json_encode($results2);

?>