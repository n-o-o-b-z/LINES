<?php
session_start();
// error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['alogin']) == 0 || $_SESSION['role'] !== 'Admin') {
    header('location:index.php');
}

$fullname = $_GET['fname'];
$mobile = $_GET['mobile'];
$email = $_GET['email'];
$bday = $_GET['bday'];
$age = $_GET['age'];
$gender = $_GET['gender'];
$blodgroup = $_GET['bloodtype'];
$purok = $_GET['purok'];
$barangay = $_GET['barangay'];
$message = $_GET['message'];
$password = $_GET['password'];
$password_hashed = md5($_GET['password']);
$status = 0;

// var_dump($_GET);
if($password !== $_GET['confirm']){
    echo '<script>alert("Password doesnt match");</script>';
}

$sql = "INSERT INTO  tblblooddonars(FullName, MobileNumber, EmailId, Age ,BirthDay ,Gender ,BloodGroup ,Purok ,Barangay ,Message ,status ,password)
 VALUES(:fullname,:mobile,:email,:age,:bday,:gender,:blodgroup,:purok,:barangay, :message, :status, :password)";
$query = $dbh->prepare($sql);
$query->bindParam(':fullname',$fullname,PDO::PARAM_STR);
$query->bindParam(':mobile',$mobile,PDO::PARAM_STR);
$query->bindParam(':email',$email,PDO::PARAM_STR);
$query->bindParam(':age',$age,PDO::PARAM_STR);
$query->bindParam(':bday',$bday,PDO::PARAM_STR);
$query->bindParam(':gender',$gender,PDO::PARAM_STR);
$query->bindParam(':blodgroup',$blodgroup,PDO::PARAM_STR);
$query->bindParam(':purok',$purok,PDO::PARAM_STR);
$query->bindParam(':barangay',$barangay,PDO::PARAM_STR);
$query->bindParam(':message',$message,PDO::PARAM_STR);
$query->bindParam(':status',$status,PDO::PARAM_STR);
$query->bindParam(':password',$password_hashed,PDO::PARAM_STR);

$query->execute();
$lastInsertId = $dbh->lastInsertId();
if($lastInsertId)
{
    echo $msg="true";
}
else 
{
    echo $error="Something went wrong. Please try again";
}

?>