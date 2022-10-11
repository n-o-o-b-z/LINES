<?php
    include('../includes/config.php');
    // $id= 1;
    $id         = $_GET['id'];
    $title      = $_GET['title'];
    $date       = $_GET['date'];
    $location   = $_GET['location'];
    $organizer  = $_GET['organizer'];
    $details    = $_GET['details'];

    $date2=date_create($_GET['date']);
    $date_true =  date_format($date2,"Y-m-d H:i:s");
    $arr  = [];
    // $sql ="SELECT id,BloodGroup,PostingDate FROM tblbloodgroup WHERE id=:id";
    $sql = "UPDATE announcement SET title = :title, date = :date, location = :location, organizer = :organizer, details = :details WHERE id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> bindParam(':title', $title, PDO::PARAM_STR);
    $query-> bindParam(':date', $date_true, PDO::PARAM_STR);
    $query-> bindParam(':location', $location, PDO::PARAM_STR);
    $query-> bindParam(':organizer', $organizer, PDO::PARAM_STR);
    $query-> bindParam(':details', $details, PDO::PARAM_STR);

    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0){
        echo true;
    }else{
        echo false;
    }

    

?>