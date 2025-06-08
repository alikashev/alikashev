<?php
header('Content-Type: application/json');

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require 'vendor/autoload.php';

$dotenv = Dotenv::createImmutable(__DIR__);
$dotenv->load();

$response = ["success" => false, "errors" => [], "message" => ""];

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Ingevoerde waarden ophalen & schoonmaken
    $naam = htmlspecialchars(trim($_POST["name"] ?? ""));
    $email = filter_var(trim($_POST["email"] ?? ""), FILTER_SANITIZE_EMAIL);
    $onderwerp = htmlspecialchars(trim($_POST["subject"] ?? ""));
    $bericht = htmlspecialchars(trim($_POST["formmessage"] ?? ""));

    // Validatie
    if (empty($naam)) {
        $response["errors"]["name"] = "Voer je naam in.";
    }

    if (empty($email)) {
        $response["errors"]["email"] = "Voer je e-mailadres in.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response["errors"]["email"] = "Voer een geldig e-mailadres in.";
    }

    if (empty($onderwerp)) {
        $response["errors"]["subject"] = "Onderwerp mag niet leeg zijn.";
    }

    if (empty($bericht)) {
        $response["errors"]["formmessage"] = "Bericht mag niet leeg zijn.";
    }

    // Als geen fouten, verstuur e-mail
    if (empty($response["errors"])) {
        $mail = new PHPMailer(true);

        try {
            $mail->isSMTP();
            $mail->Host = $_ENV['SMTP_HOST'];
            $mail->SMTPAuth = true;
            $mail->Username = $_ENV['SMTP_USER'];
            $mail->Password = $_ENV['SMTP_PASS'];
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = $_ENV['SMTP_PORT'];

            $mail->setFrom($_ENV['SMTP_USER'], 'Contactformulier');
            $mail->addAddress($_ENV['SMTP_USER']);
            $mail->addReplyTo($email, $naam);

            $mail->isHTML(false);
            $mail->Subject = "Nieuw bericht van contactformulier: $onderwerp";
            $mail->Body = "Naam: $naam\nE-mail: $email\nOnderwerp: $onderwerp\nBericht:\n$bericht";

            $mail->send();
            $response["success"] = true;
            $response["message"] = "Bedankt voor je bericht! We nemen zo snel mogelijk contact met je op.";
        } catch (Exception $e) {
            $response["message"] = "Er is een fout opgetreden bij het verzenden. Probeer het later opnieuw.";
        }
    }
} else {
    $response["message"] = "Ongeldige aanvraag.";
}

echo json_encode($response);