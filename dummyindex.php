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

  $data['message'] = 'Secret donated';
  $pusher->trigger('my-channel', 'my-event', $data);
?>