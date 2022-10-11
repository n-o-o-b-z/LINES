<?php
    include('../includes/config.php');
    // if (strlen($_SESSION['alogin']) == 0 || $_SESSION['role'] !== 'Admin') {
    //     header('location:index.php');
    // }
    
    $id = $_GET['id'];
    $arr  = [];
    // $sql = "SELECT admin.*, roles.name,roles.id from  admin LEFT JOIN roles ON admin.role_id = roles.id WHERE roles.id= :id";
    $sql = "SELECT id,role_id,Email,Full_name FROM admin WHERE id= :id";
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