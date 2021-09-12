<?php

require_once("private/functions.php");
$codeHtml=
<<<CODEHTML
<main style="text-align:center; margin:auto;">
<h3>Une erreur s'est produite</h3>

<img src="assets/img/erreurWeb.jpg">
</main>


CODEHTML;

if(isset($_REQUEST["name"]) && isset($_REQUEST["email"])&&isset($_REQUEST["message"])){

    $email = secureInput([ "name" => "email", "type" => "email" ]);
    $msg = secureInput([ "name" => "message", "type" => "text" ]);
    $name = secureInput([ "name" => "name", "type" => "text" ]);
    $genre=secureInput([ "name" => "genre", "type" => "text" ]);

    $monsieurMadame = $genre=="m"?"Monsieur":"Madame";

    // var_dump($genre=="m");
   
            // pas encore de passkey => j'écris dans la table
        echo("<p>Merci <strong>$monsieurMadame $name</strong> pour votre message, <p>un email de confirmation à été envoyé à $email.<p><p>La reception de celui-ci se fera dans les prochaines minutes -Pensez à verifier votre dossier SPAM -</p>");   
        $passkey = password_hash( $genre.$name.$email.$msg, PASSWORD_BCRYPT);
        date_default_timezone_set('Europe/Paris');
        $dateEnvoi = date("Y-m-d H:i:s"); 
        $tabAsso = [
            "genre"=>$genre,
            "email"=>$email,
            "nom"=>$name,
            "message"=>$msg,
            "dateEnvoi"=>$dateEnvoi,
            "passkey"=>$passkey];

        // j'ecris dans la base
            insertLine("mails   ", $tabAsso);
            
        //creation du mail
        $Subject="Confirmation du message sur xaviervitali.fr";
    $textEmail=
<<<EOT
    <html>
        <title>$Subject</title>
    </html>
    <body>
        <p>Bonjour $monsieurMadame $name,</p>   
        <p>il semblerait que vous ayez envoyé un message sur - xaviervitali.fr - à $dateEnvoi.</p>
        <p>S'il s'agit de vous, cliquez sur le lien ci-dessous afin de le confimer.</p><p>
            S'il ne s'agit pas de vous, le message ne sera pas envoyé et effacé automatiquement.
        </p>
        
    <p>
        <a href="http://xaviervitali.fr/valideEmail.php?passkey=$passkey"><button>Confirmer L'envoi</button></a>
    </p>
    </body>
EOT;

    sendMail($email, $Subject, $textEmail, $from="confirmation@xaviervitali.fr","confirmation@xaviervitali.fr");

}

elseif (isset($_REQUEST['passkey']))
{
    $passkey = $_REQUEST['passkey'];
    // echo($passkey);

    $objPDOStatement=readLine_("mails",$_REQUEST["passkey"], "passkey");
    foreach($objPDOStatement as $index => $tabLigne)
	{	
        
        
        $name=ucfirst($tabLigne["nom"]);
        $genre=ucfirst($tabLigne["genre"]);
        $email=$tabLigne["email"];
        $message=$tabLigne["message"];

        if($name!="" && $message!=""){

        echo("<p><strong>$genre $name</strong>,</p><p>votre mail a été confirmé, je vous répondrez dans le meilleurs délais.</p><p>Cordialement Xavier Vitali.</p>");
        sendSQL("DELETE FROM `mails` WHERE `passkey`='$passkey' ",[]);
        sendMail("xavier.vitali@gmail.com", "Nouvel email","<p>De : $genre $name</p><p>email : $email</p><p>Message : $message</p>");}
        else{
            echo($codeHtml);
        }
    }

}else{


echo($codeHtml);
}

?>

