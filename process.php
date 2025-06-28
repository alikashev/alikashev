<?php
header('Content-Type: application/json');

$response = ['success' => false, 'errors' => []];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Veilig ophalen van de data
    $naam = htmlspecialchars(trim($_POST["contact_name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $onderwerp = htmlspecialchars(trim($_POST["subject"]));
    $bericht = htmlspecialchars(trim($_POST["contactmessage"]));

    // Validatie
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
        $to = "contact@alikashev.nl";
        $subject = "Nieuw bericht van contactformulier";

        $message = "Naam: $naam\n";
        $message .= "E-mail: $email\n";
        $message .= "Onderwerp:\n$onderwerp\n";
        $message .= "Bericht:\n$bericht\n";

        $headers = "From: $email\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        if (mail($to, $subject, $message, $headers)) {
            $response['success'] = true;
            $response['message'] = "Bedankt voor je bericht! We nemen contact met je op.";
        } else {
            $response['message'] = "Er is een fout opgetreden. Probeer het later opnieuw.";
        }
    }
} else {
    $response['message'] = "Ongeldige aanvraag.";
}

echo json_encode($response);