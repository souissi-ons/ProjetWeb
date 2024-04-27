document.addEventListener("DOMContentLoaded", function () {
  var xhr = new XMLHttpRequest();
  xhr.open("GET", "./header.php", true);
  xhr.onreadystatechange = function () {
    if (xhr.readyState === 4 && xhr.status === 200) {
      var response = JSON.parse(xhr.responseText);
      var isConnected = response.isConnected;
      console.log(isConnected);
      // Cibler les éléments du menu que vous voulez contrôler
      var loginLink = document.getElementById("login");
      var registerLink = document.getElementById("register");
      var separatorLink = document.getElementById("separateur");
      var publicationLink = document.getElementById("publication");
      var logoutLink = document.getElementById("logout");

      // Si l'utilisateur est connecté, afficher les éléments du menu appropriés
      if (isConnected) {
        loginLink.style.display = "none"; // Masquer le lien de connexion
        registerLink.style.display = "none"; // Masquer le lien d'inscription
        separatorLink.style.display = "none"; // Masquer le lien de separator
        publicationLink.style.display = "block"; // Afficher le lien de publication
        logoutLink.style.display = "block"; // Afficher le lien de déconnexion
      } else {
        loginLink.style.display = "block"; // Masquer le lien de connexion
        registerLink.style.display = "block"; // Masquer le lien d'inscription
        separatorLink.style.display = "block"; // Masquer le lien de separator
        publicationLink.style.display = "none"; // Masquer le lien de publication
        logoutLink.style.display = "none"; // Masquer le lien de déconnexion
      }
    }
  };
  xhr.send();
});
