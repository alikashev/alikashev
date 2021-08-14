<?php


$errors = [];
$data = [];

if (empty($_POST['name'])) {
    $errors['name'] = 'Name is required.';
}

if (empty($_POST['email'])) {
    $errors['email'] = 'Email is required.';
}

if (empty($_POST['subject'])) {
    $errors['subject'] = 'Subject is required.';
}

if (empty($_POST['formMessage'])) {
    $errors['formMessage'] = 'Message is required.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Verstuurd, Ik neem zo snel mogelijk contact met u op.';
}

echo json_encode($data);

$to      = 'kasev21@gmailcom';
$subject = 'the subject';
$message = 'hello';
$headers = 'From: webmaster@example.com'       . "\r\n" .
             'Reply-To: webmaster@example.com' . "\r\n" .
             'X-Mailer: PHP/' . phpversion();

mail($to, $subject, $message, $headers);

/*
require 'Exception.php';
require 'PHPMailer.php';
require 'SMTP.php';


use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

$mail = new PHPMailer();
$mail->IsSMTP();
$mail->Mailer = "smtp";

$mail->SMTPDebug  = 1;  
$mail->SMTPAuth   = TRUE;
$mail->SMTPSecure = "tls";
$mail->Port       = 587;
$mail->Host       = "smtp.gmail.com";
$mail->Username   = "kasev21@gmail.com";
$mail->Password   = "Alliimmeessii11.11";

$mail->IsHTML(true);
$mail->AddAddress("akshv10@gmail.com", "Kashev Ali");
$mail->SetFrom("kasev21@gmail.com", "Ali Kashev");
$mail->Subject = "Test is Test Email sent via Gmail SMTP Server using PHP Mailer";
$content = "<b>This is a Test Email sent via Gmail SMTP Server using PHP mailer class.</b>";

$mail->MsgHTML($content); 
if(!$mail->Send()) {
  echo "Error while sending Email.";
  var_dump($mail);
} else {
  echo "Email sent successfully";
}
*/

?>