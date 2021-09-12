<?php 


function printStars($table, $col="id", $order="DESC"){
 $json = array();
$skills = readTable($table, $col, $order);

foreach($skills as $skill){

    array_push($json,["nom"=> strtoupper($skill["view"]),"note"=>intval($skill["note_sur_dix"]*100/10)]);
   
}
var_dump($json);
return $json;

}


function filtrerInput($tabInput)
{
    // $name   = $tabInput["name"] ;

    if($_REQUEST[$tabInput]){
        return trim(strip_tags($_REQUEST[$tabInput]));
    
    }
}
function insertLine($nomTable, $tabAssoColonneValeur)
{

    $listeCle   = "";
    $listeToken = "";
    $estPremier = true;
    foreach ($tabAssoColonneValeur as $cle => $valeur) {
            $listeCle   = $listeCle . ($estPremier ? "" : ", ") . $cle;
            $listeToken = $listeToken . ($estPremier ? "" : ", ") . ":$cle";

            $estPremier = false;
        }

    $requeteSQL =
        <<<CODESQL

INSERT INTO $nomTable
( $listeCle )
VALUES
( $listeToken )

CODESQL;


    $objPDOStatement = sendSQL($requeteSQL, $tabAssoColonneValeur);

    return $objPDOStatement;
}


function sendSQL($requeteSQL, $tabAssoColonneValeur)
{

       $portSQL      = 3306;
     $charsetSQL   = "utf8";



//Wamp
/*$loginSQL     = "root";
  $passwordSQL  = "";
     $databaseSQL  = "perso";
      $hostSQL      = "127.0.0.1";
*/

$databaseSQL  = "xaviervimjpers0";


    $dsnSQL       = "mysql:host=$hostSQL;port=$portSQL;charset=$charsetSQL;dbname=$databaseSQL";

    $objPDO       = new PDO($dsnSQL, $loginSQL, $passwordSQL, []);

    $objPDO->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_WARNING);

    $objPDOStatement = $objPDO->prepare($requeteSQL);

    $objPDOStatement->execute($tabAssoColonneValeur);


    $objPDOStatement->setFetchMode(PDO::FETCH_ASSOC);

    return $objPDOStatement;
}


// FONCTION QUI FILTRE LES INFOS DES FORMULAIRES
// <input name="toto" type="email">
// secureInput([ "name" => "toto", "type" => "email" ])
function secureInput($tabAssoAttribut)
{
    // VARIABLE GLOBALE
    global $tabErreur;

    // ON EXTRAIT LES VALEURS DU TABLEAU ASSOCIATIF
    $name   = $tabAssoAttribut["name"] ;
    $type   = $tabAssoAttribut["type"] ;
    $table  = $tabAssoAttribut["table"] ;
    $column = $tabAssoAttribut["column"] ;

   
    // ON RECUPERE LA VALEUR ENVOYEE DU FORMULAIRE, 
    // SI L'INFO N'EST PAS PRESENTE, ON MET UN TEXTE VIDE
    $valeur = trim(strip_tags($_REQUEST["$name"] ));

    // VALEUR EST OBLIGATOIRE
    if (mb_strlen($valeur) == 0) {
            // ERREUR: LA VALEUR EST VIDE
            $tabErreur[] =  "$name EST VIDE";
        } elseif ($type == "email") {
            // VERIFIER QUE LE FORMAT RESSEMBLE A UN EMAIL
            // http://php.net/manual/fr/function.filter-var.php
            $valeurCheck = filter_var($valeur, FILTER_VALIDATE_EMAIL);

            if ($valeurCheck == false) {
                    // ERREUR SUR LE FORMAT DE L'EMAIL
                    $tabErreur[] = "$name EST UN EMAIL INVALIDE";
                }
        }

    if (($table != "") && ($column != "")) {
            // VERIFIER L'UNICITE DE LA VALEUR DANS LA TABLE
            $tabLigne = readLineColumn($table, [$column => $valeur]);
            // SI LA LIGNE N'EST PAS VIDE
            // http://php.net/manual/fr/function.empty.php
            if (!empty($tabLigne)) {
                    $tabErreur[] = "$column: $valeur EXISTE DEJA";
                }
        }

    return $valeur;
}

function readTable($nomTable, $order = "id", $way="DESC")
{

    // ETAPE1: CONSTRUIRE LA REQUETE SQL
    $requeteSQL =
        <<<CODESQL

SELECT * FROM $nomTable
ORDER BY $order $way;

CODESQL;


    // JE PEUX MAINTENANT ENVOYER LA REQUETE SQL PREPAREE
    // ET JE COMPLETE AVEC LE TABLEAU DES VALEURS (VIDE ICI)
    $objPDOStatement = sendSQL($requeteSQL, []);

    return $objPDOStatement;
}

function readLine_($nomTable, $id, $nomID = "id")
{
    // $id = intval($id);

    // ETAPE1: CONSTRUIRE LA REQUETE SQL
    $requeteSQL =
        <<<CODESQL

SELECT * FROM $nomTable
WHERE $nomID = "$id"

CODESQL;

// echo($requeteSQL);
    // JE PEUX MAINTENANT ENVOYER LA REQUETE SQL PREPAREE
    // ET JE COMPLETE AVEC LE TABLEAU DES VALEURS (VIDE ICI)
    $objPDOStatement = sendSQL($requeteSQL, ["$nomID" =>"$id"]);

    return $objPDOStatement;
}


function sendMail($to="xavier.vitali@gmail.com", $Subject, $mail_Data="Nouveau message", $from="moi@xaviervitali.fr", $bcc=""){
    // Test fonction mail();



// *** A configurer



ini_set("SMTP", "smtp.xaviervitali.fr");   // Pour les hébergements mutualisés Windows de OVH



// *** Laisser tel quel



$JOUR  = date("Y-m-d");

$HEURE = date("H:i");



$Subject = "Nouveau message  - $JOUR $HEURE";





// $mail_Data .= "<html> \n";

// $mail_Data .= "<head> \n";

// $mail_Data .= "<title> Subject </title> \n";

// $mail_Data .= "</head> \n";

// $mail_Data .= "<body> \n";



// $mail_Data .= "Mail HTML simple  : <b>$Subject </b> <br> \n";

// $mail_Data .= "<br> \n";

// $mail_Data .= "bla bla <font color=red> bla </font> bla <br> \n";

// $mail_Data .= "Etc.<br> \n";

// $mail_Data .= "</body> \n";

// $mail_Data .= "</HTML> \n";



$headers  = "MIME-Version: 1.0 \n";

$headers .= "Content-type: text/html; charset=iso-8859-1 \n";

$headers .= "From: $from  \n";

$headers .="Bcc:moi@xaviervitali@fr";
$headers .= "Disposition-Notification-To: $from  \n";



// // Message de Priorité haute

// // -------------------------

// $headers .= "X-Priority: 1  \n";

// $headers .= "X-MSMail-Priority: High \n";



$CR_Mail = true;



$CR_Mail = @mail($to, $Subject, $mail_Data, $headers);


return($CR_Mail);

// if ($CR_Mail === false) {

//         echo " ### CR_Mail=$CR_Mail - Erreur envoi mail <br> \n";
//     } else {

//         echo " *** CR_Mail=$CR_Mail - Mail envoyé<br> \n";
//     }
}
