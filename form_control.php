<?php                                
/* $fullUrl = "http://$_SERVER[HTTP_HOST]$_SERVER[REQUEST_URI]";

if (strpos($fullUrl, "form=error") == true) {
    echo "<div class=\"alert alert-danger\" role=\"alert\">
        Er is een fout opgetreden probeer het later opnieuw.
        </div>";
    exit();
}
elseif (strpos($fullUrl, "form=empty") == true) {
    echo "<div class=\"alert alert-danger\" role=\"alert\">
        Vul a.u.b. de formulair volledig in!
        </div>";
    exit();
}
elseif (strpos($fullUrl, "form=invalidemail") == true) {
    echo "<div class=\"alert alert-danger\" role=\"alert\">
        Ongeldige e-mail ingevoerd!
        </div>";
    exit();
}
elseif (strpos($fullUrl, "form=succes") == true) {
    echo "<div class=\"alert alert-success\" role=\"alert\">
        Bedankt voor het invullen van de formulair, U hoort z.s.m. wat van mij!
        </div>";
    exit();
} */

if (!isset($_GET["form"])) {
    exit();
}else {
    $formCheck = $_GET["form"];

    if ($formCheck == "erro") {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
            Er is een fout opgetreden probeer het later opnieuw.
            </div>";
        exit();    
    }
    elseif ($formCheck == "empty") {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
            Vul a.u.b. de formulair volledig in!
            </div>";
        exit();
    }
    elseif ($formCheck == "invalidemail") {
        echo "<div class=\"alert alert-danger\" role=\"alert\">
            Ongeldige e-mail ingevoerd!
            </div>";
        exit();
    }
    elseif ($formCheck == "succes") {
        echo "<div class=\"alert alert-success\" role=\"alert\">
            Bedankt voor het invullen van de formulair, U hoort z.s.m. wat van mij!
            </div>";
        exit();
    }  
}



    /*
    if (empty($name) || empty($emailFrom) || empty($subject) || empty($message)) {
        header("Location: index.php?form=empty");
        exit();
    }else {
        if (!filter_var($emailFrom, FILTER_VALIDATE_EMAIL)) {
            header("Location: index.php?form=email&firstname=$firstName&lastname=$lastName&subject=$subject&message=$message");
            exit();
        }else {

            $mailTo = "";
            $headers = "From: ".$emailFrom;
            $txt = "Je hebt een nieuwe e-mail ontvangen van ".$firstName." ".$lastName.".\n\n".$message;

            mail($mailTo, $subject, $txt, $headers);

            header("Location: index.php?form=succes");
            
        }
    }
}else {
    header("Location: index.php?form=error");
}

*/
                                
?>