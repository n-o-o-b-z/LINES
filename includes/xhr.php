<?php
    include('config.php');


    $email= 1;
    $sql ="SELECT Email FROM admin WHERE id=:email";
    $query= $dbh -> prepare($sql);
    $query-> bindParam(':email', $email, PDO::PARAM_STR);
    $query-> execute();
    $results=$query->fetchAll(PDO::FETCH_OBJ);

    $arr = [];
    if($query->rowCount() > 0)
    {
        // $_SESSION['alogin']=$_POST['email'];
        // echo "<script type='text/javascript'> document.location = 'change-password.php'; </script>";
        // echo $query->rowCount();
            // var_dump($results);  
            foreach($results as $result){
                array_push($arr,$result->Email);
            }
            var_dump($arr);
    } else{
        // echo "<script>alert('Invalid Details');</script>";
    }


?>
           