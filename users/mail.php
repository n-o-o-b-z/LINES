<?php
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;
    use PHPMailer\PHPMailer\SMTP;
    
  require './PHPMailer-6.6.4/src/Exception.php';
  require './PHPMailer-6.6.4/src/PHPMailer.php';
  require './PHPMailer-6.6.4/src/SMTP.php';
if (!$con = mysqli_connect("localhost", "root", "", "bbdms")) {

  die("could not connect");
}
function send_mail($recipient,$subject,$message)
{
  global $con;
  $email = $_POST['email'];
  
  $mail = new PHPMailer();
  $mail->IsSMTP();

  $mail->SMTPDebug  = 0;  
  $mail->SMTPAuth   = TRUE;
  $mail->SMTPSecure = "tls";
  $mail->Port       = 587;
  $mail->Host       = "smtp.gmail.com";
  //$mail->Host       = "smtp.mail.yahoo.com";
  $mail->Username   = $email;
  $mail->Password   = "tpmqrifacsumkzfx";

  $mail->IsHTML(true);
  $mail->AddAddress($recipient, $email);
  $mail->SetFrom($email, "LIFELINE");
  //$mail->AddReplyTo("reply-to-email", "reply-to-name");
  //$mail->AddCC("cc-recipient-email", "cc-recipient-name");
  $mail->Subject = $subject;
  $content = $message;

  $mail->MsgHTML($content); 
  if(!$mail->Send()) {
    //echo "Error while sending Email.";
    //echo "<pre>";
    //var_dump($mail);
    return false;
  } else {
    //echo "Email sent successfully";
    return true;
  }

}

?>