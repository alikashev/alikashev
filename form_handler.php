<?php 

if (isset($_POST['submit'])) {
    $firstName = $_POST['firstname'];
    $lastName = $_POST['lastname'];
    $emailFrom = $_POST['email'];
    $subject = $_POST['subject'];
    $message = $_POST['message'];

    if (empty($firstName) || empty($lastName) || empty($emailFrom) || empty($subject) || empty($message)) {
        header("Location: index.php?form=empty");
    }
    else {
        if (!filter_var($emailFrom, FILTER_VALIDATE_EMAIL)) {
            header("Location: index.php?form=invalidemail");
        }else {

            $mailTo = "";
            $headers = "From: ".$emailFrom;
            $txt = "Je hebt een nieuwe e-mail ontvangen van ".$firstName." ".$lastName.".\n\n".$message;

            mail($mailTo, $subject, $txt, $headers);
            
        }
    }
}else {
    header("Location: index.php?form=error");
}

?>