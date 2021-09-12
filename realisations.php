<?php
$pageActive="realisations";
require_once("private/view/header.php");
require_once("private/functions.php");?>
<section class="container">
        <div id="cube">
          <div class="face bottom" data-face="html">
            <img src="assets/img/htmlCssJs.jpg" alt="logo HTML/CSS/Javascript" />
          </div>
          <div class="face back" data-face="symfony">
            <img src="assets/img/symfony.png" alt="logo Symfony" />
          </div>
          <div class="face right" data-face="angular">
            <img src="assets/img/angular.png" alt="logo Angular" />
          </div>
          <div class="face left" data-face="opquast">
            <img src="assets/img/opquast.png" alt="logo opquast" />
          </div>
          <div class="face top" data-face="sql">
            <img src="assets/img/sql.png" alt="logo PHP/mySQL" />
          </div>
          <div class="face front" data-face="jquery" style="background-color:white;text-align: center;  margin: auto; opacity: 1;">
            <img src="assets/img/cordova.jpg" alt="logo Jquery" />
            </span>
          </div>
        </section>
        <?php
require_once("private/view/sectionRealisations.php");
require_once("private/view/footer.php")
?>
