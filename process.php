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

if (empty($_POST['contactmessage'])) {
    $errors['contactmessage'] = 'Message is required.';
}

if (!empty($errors)) {
    $data['success'] = false;
    $data['errors'] = $errors;
} else {
    $data['success'] = true;
    $data['message'] = 'Bedankt, verstuurd! Ik neem zo snel mogelijk contact met u op.';
}

echo json_encode($data);

$to      = 'contact@alikashev.nl';
$subject = $_POST['subject'];
$email = $_POST['email'];
$name = $_POST['name'];
$contactmessage = $_POST['contactmessage'];

$message = '
<html>
<head>
  <title>Contact met Ali Kashev</title>
</head>
<body style="background-color: black; color: white;">
    <h3>Bericht van: <b>'.$name.'</b></h3>
    <hr>
    <h4>Onderwerp: <b>'.$subject.'</b></h4>
    <hr>
    <p><b>Bericht:</b><br> '.$contactmessage.'</p>
</body>
</html>
';


// To send HTML mail, the Content-type header must be set
$headers[] = 'MIME-Version: 1.0';
$headers[] = 'Content-type: text/html; charset=iso-8859-1';
$headers[] = 'To: Ali Kashev <contact@alikashev.nl>';
$headers[] = 'From: '.$name." "."<".$email.">";
$headers[] = 'Reply-To:' . $email;

// Mail it
mail($to, $subject, $message, implode("\r\n", $headers));

?>