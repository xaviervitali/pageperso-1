
$(".htmlcss").animate({ width: "60%" }, 2100);
$(".angular").animate({ width: "30%" }, 2100);
$(".jquery").animate({ width: "40%" }, 2100);
$(".js").animate({ width: "70%" }, 2100);
$(".symfony").animate({ width: "60%" }, 2100);
$(".php").animate({ width: "60%" }, 2100);
$(".bootstrap").animate({ width: "15%" }, 2100);
$(".cordova").animate({ width: "15%" }, 2100);
$(".opquast").animate({ width: "69%" }, 2100);
$(".wordpress").animate({ width: "30%" }, 2100);

$(".htmlcss").hover(affichePourcentage, Valeur);
$(".jquery").hover(affichePourcentage, Valeur);
$(".js").hover(affichePourcentage, Valeur);
$(".bootstrap").hover(affichePourcentage, Valeur);
$(".opquast").hover(affichePourcentage, Valeur);
$(".cordova").hover(affichePourcentage, Valeur);
$(".symfony").hover(affichePourcentage, Valeur);

$(".angular").hover(affichePourcentage, Valeur);
$(".wordpress").hover(affichePourcentage, Valeur);
$(".php").hover(affichePourcentage, Valeur);

let valeurParDefaut = "";
let valeurStyle = "";

function affichePourcentage() {
  valeurParDefaut = this.textContent;
  
  this.innerHTML = "<span style='color:red'>" + this.style.width + "</span>";
}

function Valeur() {
  this.innerHTML =valeurParDefaut;
  
}
