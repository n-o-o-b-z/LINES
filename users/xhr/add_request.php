<?php
session_start();
// error_reporting(0);
include('../includes/config.php');
if (strlen($_SESSION['user_login']) == 0){
    header('location:index.php');
}

require '../../vendor/autoload.php';

$options = array(
    'cluster' => 'ap1',
    'useTLS' => true
  );
  $pusher = new Pusher\Pusher(
    '9026a8fb79691852de9d',
    '59cdbb3830a60b81ac23',
    '1488035',
    $options
  );


$id      = $_GET['userid'];
$to      = $_GET['to'];

$sql2="SELECT * FROM donate_request WHERE user_id=:id AND request_to=:to";
$query = $dbh->prepare($sql2);
$query->bindParam(':id',$id,PDO::PARAM_STR);
$query->bindParam(':to',$to,PDO::PARAM_STR);
$query->execute();
$results=$query->fetchAll(PDO::FETCH_OBJ);
if($query->rowCount() > 0){
    echo $msg="Already Requested";
}else{
    $sql="INSERT INTO donate_request(`user_id`,request_to) VALUES(:id, :to)";
    $query = $dbh->prepare($sql);
    $query->bindParam(':id',$id,PDO::PARAM_STR);
    $query->bindParam(':to',$to,PDO::PARAM_STR);
    $query->execute();
    $lastInsertId = $dbh->lastInsertId();
    if($lastInsertId)
    {
        echo $msg="ok";
        $ids = $_GET['userid'];
        $sql2="SELECT FullName FROM tblblooddonars WHERE id=:id";
        $query = $dbh->prepare($sql2);
        $query->bindParam(':id',$ids,PDO::PARAM_STR);
        $query->execute();
        $results=$query->fetchAll(PDO::FETCH_OBJ);

        $data['message'] = $results[0]->FullName.' Want to request blood';
        $pusher->trigger('my-channel', 'my-event', $data);
    }
    else 
    {
        echo $error="Something went wrong. Please try again";
    }
}



?>