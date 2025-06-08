<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require 'vendor/autoload.php';

// .env laden
$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $onderwerp = htmlspecialchars(trim($_POST["subject"]));
    $bericht = htmlspecialchars(trim($_POST["formmessage"]));

    if (!empty($naam) && !empty($email) && !empty($onderwerp) && !empty($bericht)) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USER'];
            $mail->Password = $_ENV['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $_ENV['SMTP_PORT'];

            echo $_ENV['SMTP_USER'];
            echo $_ENV['SMTP_PORT'];

            $mail->setFrom($_ENV['SMTP_USER'], 'Contactformulier');
            $mail->addAddress($_ENV['SMTP_USER']);
            $mail->addReplyTo($email, $naam);

            $mail->isHTML(false);
            $mail->Subject = "Nieuw bericht van contactformulier: $onderwerp";
            $mail->Body = "Naam: $naam\nE-mail: $email\nOnderwerp: $onderwerp\nBericht:\n$bericht";

            $mail->send();
            echo "Bedankt voor je bericht! We nemen zo snel mogelijk contact met je op.";
        } catch (Exception $e) {
            echo "Er is een fout opgetreden bij het verzenden van de e-mail. Mailer Error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Vul alle velden in aub.";
    }
} else {
    echo "Ongeldige aanvraag.";
}
?>
