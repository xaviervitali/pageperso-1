<?php
require_once("private/functions.php");
$works = readTable("work");
$json = array();

foreach($works as $skill){
array_push($json,["img"=> $skill["workImg"],
"workUrl"=>$skill["workUrl"], 
"title"=>$skill["title"], "content"=>$skill["content"],
"keyword"=>$skill["keywords"]
]);

};
       $tabFinal=["web"=>printStars("skillsweb", "view", "ASC",10),"formation"=>printStars("skillsform", "view", "ASC",10), "autre"=> printStars("skillsother", "view", "ASC",10),"portfolio"=>$json];
        echo(json_encode($tabFinal));

?>