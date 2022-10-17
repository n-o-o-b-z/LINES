<?php
session_start();
// error_reporting(0);
include('../includes/config.php');
if(strlen($_SESSION['alogin'])==0){	
    header('location:index.php');
}



$valid_extensions = array('jpg', 'jpeg', 'jfif', 'pjepg', 'pjp', 'gif', 'avif', 'apng', 'png', 'svg', 'webp', 'bmp'); // valid extensions
$path = '../../images/uploads/'; // upload directory
if(!empty($_POST['title']) || !empty($_POST['date']) || !empty($_POST['location'])|| !empty($_POST['organizer'])|| !empty($_POST['details']) || $_FILES['image'])
{
    $img = $_FILES['image']['name'];
    $tmp = $_FILES['image']['tmp_name'];

    // get uploaded file's extension
    $ext = strtolower(pathinfo($img, PATHINFO_EXTENSION));

    // can upload same image using rand function
    $final_image = rand(1000,1000000).$img;

    // check's valid format
    if(in_array($ext, $valid_extensions)) 
    { 
        $path = $path.strtolower($final_image); 
        if(move_uploaded_file($tmp,$path)) 
        {
            // echo "<img src='$path' />";

            $title      = $_POST['title'];
            $date       = $_POST['date'];
            $location   = $_POST['location'];
            $organizer  = $_POST['organizer'];
            $details    = $_POST['details'];

            $date2=date_create($_POST['date']);
            $date_true =  date_format($date2,"Y-m-d H:i:s");

            $sql="INSERT INTO announcement(title, date, location, organizer, details,banner) VALUES(:title, :date, :location, :organizer, :details,:banner)";
            $query = $dbh->prepare($sql);
            $query->bindParam(':title',$title,PDO::PARAM_STR);
            $query->bindParam(':date',$date_true,PDO::PARAM_STR);
            $query->bindParam(':location',$location,PDO::PARAM_STR);
            $query->bindParam(':organizer',$organizer,PDO::PARAM_STR);
            $query->bindParam(':details',$details,PDO::PARAM_STR);
            $query->bindParam(':banner',$path,PDO::PARAM_STR);
            $query->execute();
            $lastInsertId = $dbh->lastInsertId();
            if($lastInsertId) {
                echo $msg="true";
            }else{
                echo $error="Something went wrong. Please try again";
            }
        }
    }else {
        echo 'invalid';
    }
}


// $title      = $_GET['title'];
// $date       = $_GET['date'];
// $location   = $_GET['location'];
// $organizer  = $_GET['organizer'];
// $details    = $_GET['details'];

// $date2=date_create($_GET['date']);
// $date_true =  date_format($date2,"Y-m-d H:i:s");

// $sql="INSERT INTO announcement(title, date, location, organizer, details) VALUES(:title, :date, :location, :organizer, :details)";
// $query = $dbh->prepare($sql);
// $query->bindParam(':title',$title,PDO::PARAM_STR);
// $query->bindParam(':date',$date_true,PDO::PARAM_STR);
// $query->bindParam(':location',$location,PDO::PARAM_STR);
// $query->bindParam(':organizer',$organizer,PDO::PARAM_STR);
// $query->bindParam(':details',$details,PDO::PARAM_STR);
// $query->execute();
// $lastInsertId = $dbh->lastInsertId();
// if($lastInsertId)
// {
//     echo $msg="true";
// }
// else 
// {
//     echo $error="Something went wrong. Please try again";
// }

?>