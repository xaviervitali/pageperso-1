var cube = document.getElementById("cube");

const rot = "1turn";
const duree = 6000;
let i = rot;

// document
//   .querySelectorAll(".face")
//   .forEach(e => e.addEventListener("click", quelleface));

// function quelleface() {
//   const faceClique = this.getAttribute("data-face");
//   const codeHtml = `<h2><img style="width:100px" src=${
//     competences[faceClique].icone
//   }>${competences[faceClique].title}</h2>
//     ${competences[faceClique].content}`;

//   document.getElementById("infoCompetence").innerHTML = codeHtml;
// }

function rotation() {
  i == 0 ? (i = rot) : (i = 0);
  const yturn = 2160 * Math.random();
  cube.style.transform = "rotateX(" + i + ") rotateY(" + yturn + "deg)";
  cube.style.transitionDuration = duree + "ms";
}

rotation();

window.setInterval(rotation, duree);

/************* Smooth scroll  *********** */
//
$(document).ready(function() {
  $(".smooth-scroll").on("click", function(event) {
    // console.log(this.hash)

    if (this.hash !== "") {
      event.preventDefault();

      var hash = this.hash;

      $("html, body").animate(
        {
          scrollTop: $(hash).offset().top
        },
        1000,
        function() {
          window.location.hash = hash;
        }
      );
    }
  });
});

/**
 * On test la position dans la page
 */

$(document).ready(function() {
  $(window).scroll(function(e) {
    var scrollTop = $(window).scrollTop();
    var docHeight = $(document).height();
    var winHeight = $(window).height();
    var scrollPercent = scrollTop / (docHeight - winHeight);
    var scrollPercentRounded = Math.round(scrollPercent * 100);

    $("header").addClass("minHeigth");
    if (scrollPercentRounded > 0) {
      $(".back-to-top").fadeIn();
    } else {
      $(".back-to-top").fadeOut();
    }
  });
  // document.getElementById("pourcentage").addEventListener("click", setAjax);
});


//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//Partie portfolio
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
window.setInterval(normalWay, 10000);
let currentImg = 50; // je fixe une valeur >> au max du portfolio

function normalWay() {
  currentImg >= 0 ? currentImg++ : (currentImg = 0);

  slider("fadeInLeft");
}
function backWay() {
  currentImg--;
  slider("fadeInRight");
}

$(".previousWork").click(backWay);
$(".nextWork").click(normalWay);

async function slider(animation) {
  document.querySelector(".overlay").classList.remove("fadeInRight");
  document.querySelector(".overlay").classList.remove("fadeInLeft");

  ajax = await skills();
  const nbWorks = ajax.portfolio.length;
  if (currentImg < nbWorks && currentImg >= 0) {
    const information = ajax.portfolio[currentImg];

    $(".portfolio a").attr("href", information.workUrl);
    $(".portfolio img").attr("src", information.img);
    $(".portfolio img").attr("alt", information.title);

    $(".keywords").text(information.keyword.toUpperCase());
    $(".titre").text(information.title.toUpperCase());
    $(".description").text(information.content);
  } else if (currentImg >= nbWorks) {
    currentImg = -1;
    normalWay();
  } else {
    currentImg = nbWorks;
    backWay();
  }

  document.querySelector(".overlay").classList.add(animation);
}

//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
// Partie Skill
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////

let minStars = 0
setAjax();

async function setAjax() {
  ajax = await skills();
  // console.log(minStars)
  // $(".category span").text(minStars);

  document.querySelector(".web").innerHTML = await fillFields(
    ajax["web"],
    minStars
  );
  document.querySelector(".formation").innerHTML = await fillFields(
    ajax["formation"],
    minStars,
    5
  );
  document.querySelector(".autre").innerHTML = await fillFields(
    ajax["autre"],
    minStars,
    5
  );
}

async function skills() {
  return fetch(
    location.href.slice(0, location.href.lastIndexOf("/")) + "/json.php"
  ).then(function(reponse) {
    return reponse.json();
  });
}

async function fillFields(field, minStars = 0, maxStars = 10) {
  var codeHtml = "";
  // console.log(minStars)

  field.forEach(e => {
    // console.log(e.note)
    htmlStarFull = "";
    htmlStarEmpty = "";
    starsFull = Math.trunc((e.note * maxStars) / 100);
    // console.log(starsFull)
    if (e.note >= minStars) {
      for (i = 0; i < starsFull; i++) {
        htmlStarFull += "<i class='fas fa-star'></i>";
      }

      for (j = maxStars; j > starsFull; j--) {
        htmlStarEmpty += '<i class="far fa-star"></i>';
      }

      // console.log(htmlStarFull)
      codeHtml +=
        "<div class='skillContent'><p><strong>" +
        e.nom +
        "</strong></p><p>" +
        htmlStarFull +
        htmlStarEmpty +
        "</p></div>";
    }
  });
  return codeHtml;
}

document
  .querySelectorAll(".skills  i")
  .forEach(e => e.addEventListener("click", skillLevel));
 function skillLevel() {
  // console.log(this)
  const level = $(this).attr("indexId");

  if (parseInt(level) >= 20) {
    document.querySelectorAll(" i").forEach(function(e) {
      if (parseInt(e.getAttribute("indexId")) <= level) {
        // console.log(e);
        e.classList.add("fas");
        e.classList.remove("far");
      }
      else
      {
        e.classList.add("far");
        e.classList.remove("fas");
      }
    });
  }
  minStars=level
   setAjax()
}

/// WYSIWYG
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
// Footer
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////

$("footer form input").click(changeBackground)


function changeBackground(){
 const urlThumbnails = this.value
newBackground = urlThumbnails.replace("/thumbnails","")
$('.category').css({"background":"url("+newBackground+")", "background-size":"cover"})
}