<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
    <style>
        img{
            max-width:200px;
        }
        table{
            border:1px solid black ;
     
            border-collapse: collapse;
        }

        td, tr{
            border:1px solid black ;
        }
    </style>
</head>
<body>
    


<?php
// $pageActive="realisations";
// require_once("private/view/header.php");
require_once("private/functions.php");

error_reporting(E_ALL);
ini_set('display_errors', 1);

$tableAuth =["work", "skills", "blog"];

$table =$_REQUEST["table"]??"";
$estTable = array_search($table, $tableAuth);
$rendu="";

if($estTable>=0){
    // echo($table);
$data = readTable($table);
// var_dump($data);

switch($table){
    
    case "work":
    foreach($data as $real){
        $id = $real["id"];
        $titre = $real["title"];
        $content =  $real["content"];
        $keywords =  $real["keywords"];
        $rendu.="<tr><td>$id</td><td>$titre</td><td>$keywords</td><td>$content</td></tr>";
    }

    break;


    case "skills":
    {
        
        foreach($data as $skills){
            $id = $skills["id"];
            $skill = $skills["skill"];
            $stars = $skills["stars"];
            $rendu.="<tr><td>$id</td><td>$skill</td><td>$stars</td></tr>";
        }
            break;
    }
    
    case "blog":
    {
        $rendu="blog";
        break;
    }

}
}else{
    $rendu="pas de contenu";
}
?>

<form action="http://v38france.synology.me/CVEnLigne/admin.php" method="get">
<select name="table">
    <option value="blog">Blog</option>
    <option value="work">Réalisation</option>
    <option value="skills">Compétences</option>

  </select>
  <input type="submit" value="Submit">
</form>

<table><?php echo $rendu?></table>
</body>
</html>