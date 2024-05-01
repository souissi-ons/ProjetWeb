document.addEventListener("DOMContentLoaded", function () {
  // Récupérer l'élément conteneur pour les publications
  var publicationsContainer = document.getElementById("publicationsContainer");

  // Faire une requête AJAX pour récupérer les publications depuis le fichier PHP
  var xhr = new XMLHttpRequest();
  xhr.onreadystatechange = function () {
    if (xhr.readyState === XMLHttpRequest.DONE) {
      if (xhr.status === 200) {
        var publications = JSON.parse(xhr.responseText);
        if (publications.length > 0) {
          // Construire le HTML pour afficher les publications
          var publicationsHTML = "";
          publications.forEach(function (publication) {
            publicationsHTML += '<div class="card cardcontainer ">';
            publicationsHTML +=
              '<div class="photo" style="background-image: url(' +
              publication.image_path +
              ')"></div>';
            publicationsHTML += '<div class="content">';
            publicationsHTML +=
              '<p class="title mt-2 text-truncate">' +
              publication.titre +
              "</p>";
            publicationsHTML += "<div>";
            publicationsHTML += '<span class="text-truncate autre-contect ">';
            publicationsHTML +=
              '<i class="bi bi-person-fill"></i> Statut: ' + publication.choix;
            publicationsHTML += "</span>";
            publicationsHTML += "</div>";
            publicationsHTML += "<div>";
            publicationsHTML += '<i class="bi bi-geo-alt-fill"></i>';
            publicationsHTML +=
              '<span  class= "autre-contect"> Age: ' +
              publication.age +
              " mois</span>";
            publicationsHTML += "</div>";
            publicationsHTML += "<div>";
            publicationsHTML += '<i class="bi bi-geo-alt-fill"></i>';
            publicationsHTML +=
              '<span  class= "autre-contect"> Numéro de téléphone: ' +
              publication.num +
              "</span>";
            publicationsHTML += "</div>";
            publicationsHTML += "<div>";
            publicationsHTML += '<i class="bi bi-clock-fill"></i>';
            publicationsHTML +=
              '<span class="time autre-contect"> Description: ' +
              publication.description +
              "</span>";
            publicationsHTML += "</div>";

            if (publication.choix === "vente") {
              publicationsHTML += "<div>";
              publicationsHTML += '<i class="bi bi-cash"></i>';
              publicationsHTML +=
                '<span class="prix autre-contect"> Prix: ' +
                publication.prix +
                " Dt</span>";
              publicationsHTML += "</div>";
            }

            publicationsHTML += "</div>";
            publicationsHTML += "</div>";
          });
          // Injecter le HTML dans le conteneur des publications
          publicationsContainer.innerHTML = publicationsHTML;
        } else {
          publicationsContainer.innerHTML = "Aucune publication trouvée.";
        }
      } else {
        publicationsContainer.innerHTML =
          "Erreur lors de la récupération des publications.";
      }
    }
  };
  xhr.open("GET", "accueil.php", true);
  xhr.send();
});
