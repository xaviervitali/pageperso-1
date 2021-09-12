<?php

$nomExp = filtrerInput("name") ?? "";
$emailExp = filtrerInput("email") ?? "";
$messageExp = filtrerInput("message") ?? "";

if ($nomExp != "" && $emailExp != "" && $messageExp != "") {
    // Test fonction mail();

    // *** A configurer

    $to = "xavier.vitali@gmail.com";

    // adresse MAIL OVH liée à l’hébergement.

    $from = "moi@xaviervitali.fr";

    ini_set("SMTP", "smtp.xaviervitali.fr"); // Pour les hébergements mutualisés Windows de OVH

    // *** Laisser tel quel

    $JOUR = date("Y-m-d");

    $HEURE = date("H:i");

    $Subject = "xaviervitali.fr - $JOUR $HEURE";

    $mail_Data = "";

    $mail_Data .= "<html> \n";

    $mail_Data .= "<head> \n";

    $mail_Data .= "<title> Subject </title> \n";

    $mail_Data .= "</head> \n";

    $mail_Data .= "<body> \n";

    $mail_Data .= "Mail HTML simple  :<p>$nomExp</p><p>$emailExp</p> <b>$messageExp </b> <br> \n";

    $mail_Data .= "</body> \n";

    $mail_Data .= "</HTML> \n";

    $headers = "MIME-Version: 1.0 \n";

    $headers .= "Content-type: text/html; charset=iso-8859-1 \n";

    $headers .= "From: $from  \n";

    $headers .= "Disposition-Notification-To: $from  \n";

    // Message de Priorité haute

    // -------------------------

    $headers .= "X-Priority: 1  \n";

    $headers .= "X-MSMail-Priority: High \n";

    $CR_Mail = true;

    $CR_Mail = @mail($to, $Subject, $mail_Data, $headers);

    if ($CR_Mail === false) {

        echo " Erreur envoi mail <br> \n";
    } else {

        echo " Votre mail a bien été envoyé \n";
    }
}
?>



<h2 id="contact">
	Contactez moi
</h2>
<section class='category contact'>

    <form method="get" action="valideEmail.php" onsubmit="popup('valideEmail.php')>
    <div>
        <label for="m">Monsieur</label>
        <input type="radio" id="m"
        name="genre" value="m">

        <label for="mme">Madame</label>
        <input type="radio" id="mme"
        name="genre" value="mme" checked>

    </div>
        <label for="name">Nom</label>
        <input name="name" id="name" type="text" placeholder="" class="form-control" id="name" placeholder="" value="" required>

        <label for="email">Mail</label>
        <input type="email" id="email" placeholder="" class="form-control" id="email" name="email" placeholder="" value="" required>

        <label for="message">Message</label>
        <textarea name="message" id="message" placeholder="" id="message" rows="10" ></textarea>

        <button class="btn " type="submit" id="submit" style="margin-top:20px;">Envoyer</button>
    </form>

</section>
<?php
require_once("private/view/footer.php");