<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // of pad naar PHPMailer handmatig

header('Content-Type: application/json');

$response = ['success' => false, 'errors' => []];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $naam = htmlspecialchars(trim($_POST["contact_name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $onderwerp = htmlspecialchars(trim($_POST["subject"]));
    $bericht = htmlspecialchars(trim($_POST["contactmessage"]));

    if (empty($naam)) {
        $response['errors']['name'] = "Naam is verplicht.";
    }
    if (empty($email)) {
        $response['errors']['email'] = "E-mail is verplicht.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $response['errors']['email'] = "Ongeldig e-mailadres.";
    }
    if (empty($onderwerp)) {
        $response['errors']['subject'] = "Onderwerp is verplicht.";
    }
    if (empty($bericht)) {
        $response['errors']['contactmessage'] = "Bericht is verplicht.";
    }

    if (empty($response['errors'])) {
        $mail = new PHPMailer(true);

        try {
            // SMTP-configuratie
            $mail->isSMTP();
            $mail->Host       = 'smtp.mail.me.com'; // ✏️ Jouw SMTP-server
            $mail->SMTPAuth   = true;
            $mail->Username   = 'contact@alikashev.nl'; // ✏️ SMTP gebruikersnaam
            $mail->Password   = 'sxle-vyrd-yzue-itro';        // ✏️ SMTP wachtwoord
            $mail->SMTPSecure = 'tls';                    // 'tls' of 'ssl'
            $mail->Port       = 587;                      // 587 voor TLS, 465 voor SSL

            // Afzender & ontvanger
            $mail->setFrom($email, $naam); 
            $mail->addAddress('contact@alikashev.nl'); // ✉️ Jouw ontvangstadres
            $mail->addReplyTo($email, $naam);

            // Inhoud
            $mail->Subject = 'Nieuw bericht van contactformulier';
            $mail->Body = "Naam: $naam\nE-mail: $email\nOnderwerp:\n$onderwerp\nBericht:\n$bericht";

            $mail->send();
            $response['success'] = true;
            $response['message'] = "Bedankt voor je bericht! We nemen contact met je op.";
        } catch (Exception $e) {
            $response['message'] = "Verzenden mislukt. Mailer Error: {$mail->ErrorInfo}";
        }
    }
} else {
    $response['message'] = "Ongeldige aanvraag.";
}

echo json_encode($response); 

?>