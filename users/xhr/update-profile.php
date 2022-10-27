<?php
session_start();
// error_reporting(0);
include('../includes/config.php');
if(strlen($_SESSION['user_login'])==0){	
    header('location:index.php');
}



$valid_extensions = array('jpg', 'jpeg', 'jfif', 'pjepg', 'pjp', 'gif', 'avif', 'apng', 'png', 'svg', 'webp', 'bmp'); // valid extensions
$path = '../../images/uploads/'; // upload directory
if(!empty($_POST['fname']) || !empty($_POST['email']) || !empty($_POST['btype'])|| !empty($_POST['bday'])|| !empty($_POST['age']))
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
            $id      = $_POST['id'];
            $image   = isset($_POST['image']) ? $_POST['image'] : '../../images/default.jpg';
            $fname   = $_POST['fname'];
            $bday    = $_POST['bday'];
            $age     = $_POST['age'];
            $btype   = $_POST['btype'];
            $email   = $_POST['email'];
            $mnumber = $_POST['mnumber'];
            $purok   = $_POST['purok'];
            $brgy    = $_POST['brgy'];


            $date=date_create($_POST['bday']);
            $date_true =  date_format($date,"Y-m-d");

            $sql = "UPDATE tblblooddonars SET image=:image, FullName=:fname, BirthDay=:bday, age=:age, BloodGroup=:btype, EmailId=:email, MobileNumber=:mnumber, Purok=:purok, Barangay=:brgy WHERE id=:id";
            $query= $dbh -> prepare($sql);
            $query->bindParam(':id', $id , PDO::PARAM_STR);
            $query->bindParam(':image', $path, PDO::PARAM_STR);
            $query->bindParam(':fname', $fname, PDO::PARAM_STR);
            $query->bindParam(':bday', $date_true, PDO::PARAM_STR);
            $query->bindParam(':age', $age, PDO::PARAM_STR);
            $query->bindParam(':btype', $btype, PDO::PARAM_STR);
            $query->bindParam(':email', $email, PDO::PARAM_STR);
            $query->bindParam(':mnumber', $mnumber, PDO::PARAM_STR);
            $query->bindParam(':purok', $purok, PDO::PARAM_STR);
            $query->bindParam(':brgy', $brgy, PDO::PARAM_STR);
            $query->execute();

            if(!$query->execute()){
                print_r($query->errorInfo());
            }
            // $lastInsertId = $dbh->lastInsertId();
            // if($lastInsertId) {
            //     echo $msg="true";
            // }else{
            //     echo $error="Something went wrong. Please try again";
            // }
        }
    }else {
        echo 'invalid';
    }
}


// $sql = "UPDATE tblbloodgroup SET BloodGroup = :BloodGroup WHERE id=:id";
// $query= $dbh -> prepare($sql);
// $query->bindParam(':id', $id, PDO::PARAM_STR);
// $query->bindParam(':BloodGroup', $BloodGroup, PDO::PARAM_STR);
// $query->execute();
// $results=$query->fetchAll(PDO::FETCH_OBJ);
// if($query->rowCount() > 0)
// {
//     foreach ($results as $result){
//         array_push($arr,$result);
//     }
//     echo json_encode($arr);
    
// }

?>








    
