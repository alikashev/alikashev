<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="s.css">
    <title>Contact</title>
</head>
<body>
    <div class="row">
        <div class="col-12">
            <div class="content d-flex justify-content-center">
                <p>FORMULAIR INFORMATIE</p>
            </div>
        </div>
    </div>
</body>
</html>

<?php 

if (isset($_POST['submit'])) {
$name = $_POST['name'];
$email = $_POST['email'];
$subject = $_POST['subject'];
$message = $_POST['message'];

$errorEmpty = false;
$errorMail = false;

if (empty($name) || empty($email) || empty($subject) || empty($message)) {
    echo "<div class=\"alert alert-danger\" role=\"alert\">LEEG ERROR</div>";
    $errorEmpty = true;
}else {
    echo "<div class=\"alert alert-success\" role=\"alert\">SUCCES</div>";
}
}else {
    header("Location: index.php?form=error");
    echo "Er is een ERROR!";
}

?>


