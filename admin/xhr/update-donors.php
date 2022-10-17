<?php
    include('../includes/config.php');
    // $id= 1;
    $id      = $_GET['id'];
    $fname   = $_GET['fname'];
    $email   = $_GET['email'];
    $mobile  = $_GET['mobile'];
    $bday    = $_GET['bday'];
    $age     = $_GET['age'];
    $gender  = $_GET['gender'];
    $btype   = $_GET['btype'];
    $purok   = $_GET['purok'];
    $brgy    = $_GET['brgy'];
    $msg     = $_GET['msg'];

    // $date2=date_create($_GET['date']);
    // $date_true =  date_format($date2,"Y-m-d H:i:s");
    // $arr  = [];
    // $sql ="SELECT id,BloodGroup,PostingDate FROM tblbloodgroup WHERE id=:id";
    $sql = "UPDATE tblblooddonars SET Fullname=:fname, MobileNumber=:mobile, EmailId=:email, Gender=:gender, BirthDay=:bday, age=:age, BloodGroup=:btype, Purok=:purok, Barangay=:brgy, `Message`=:msg WHERE id=:id";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':id', $id, PDO::PARAM_STR);
    $query-> bindParam(':fname', $fname, PDO::PARAM_STR);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> bindParam(':mobile', $mobile, PDO::PARAM_STR);
    $query-> bindParam(':bday', $bday, PDO::PARAM_STR);
    $query-> bindParam(':age', $age, PDO::PARAM_STR);
    $query-> bindParam(':gender', $gender, PDO::PARAM_STR);
    $query-> bindParam(':btype', $btype, PDO::PARAM_STR);
    $query-> bindParam(':purok', $purok, PDO::PARAM_STR);
    $query-> bindParam(':brgy', $brgy, PDO::PARAM_STR);
    $query-> bindParam(':msg', $msg, PDO::PARAM_STR);

    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);
    if($query->rowCount() > 0){
        echo true;
    }else{
        echo false;
    }

    

?>