<?php
  require __DIR__ . '/vendor/autoload.php';

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

  // $data['message'] = 'Secret Hi';
  // $pusher->trigger('my-channel', 'my-event', $data);
  if(isset($_POST['submit'])){
    $data['message'] = $_POST['something'];
    $pusher->trigger('my-channel', 'my-event', $data);
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <form action="" method="POST">
  <input type="text" name="something">
  <input type="submit" name="submit" value="submit">
  </form>
  
</body>
</html>