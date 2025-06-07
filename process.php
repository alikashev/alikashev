<?php

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Veilig de gegevens ophalen en filteren
    $naam = htmlspecialchars(trim($_POST["name"]));
    $email = filter_var(trim($_POST["email"]), FILTER_SANITIZE_EMAIL);
    $onderwerp = htmlspecialchars(trim($_POST["subject"]));
    $bericht = htmlspecialchars(trim($_POST["formmessage"]));

    echo $naam;
    echo $email;
    echo $onderwerp;
    echo $bericht;


    // Check of alles is ingevuld
    if (!empty($naam) && !empty($email) && !empty($onderwerp) && !empty($bericht)) {
        $to = "contact@alikashev.nl"; // Verander dit naar je eigen e-mailadres
        $subject = "Nieuw bericht van contactformulier";
        
        $message = "Naam: $naam\n";
        $message .= "E-mail: $email\n";
        $message .= "Onderwerp:\n$onderwerp\n";
        $message .= "Bericht:\n$bericht\n";

        $headers = "From: contact@alikashev.nl\r\n";
        $headers .= "Reply-To: $email\r\n";
        $headers .= "X-Mailer: PHP/" . phpversion();

        // Verstuur de mail
        if (mail($to, $subject, $message, $headers)) {
            echo "Bedankt voor je bericht! We nemen zo snel mogelijk contact met je op.";
        } else {
            echo "Er is een fout opgetreden. Probeer het later opnieuw.";
        }
    } else {
        echo "Vul alle velden in aub.";
    }
} else {
    echo "Ongeldige aanvraag.";
}

?>