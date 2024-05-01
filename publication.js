document.addEventListener("DOMContentLoaded", function () {
  const venteRadio = document.getElementById("vente");
  const prixInput = document.getElementById("prix");

  // Écouteur d'événements pour détecter le changement de sélection du bouton radio "Vente"
  venteRadio.addEventListener("change", function () {
    // Vérifie si "Vente" est sélectionné
    if (this.checked) {
      prixInput.disabled = false; // Active le champ de prix
    } else {
      prixInput.disabled = true; // Désactive le champ de prix
    }
  });
});

document.addEventListener("DOMContentLoaded", function () {
  const venteRadio = document.getElementById("adoption");
  const prixInput = document.getElementById("prix");

  // Écouteur d'événements pour détecter le changement de sélection du bouton radio "Vente"
  venteRadio.addEventListener("change", function () {
    // Vérifie si "Vente" est sélectionné
    if (this.checked) {
      prixInput.disabled = true; // Active le champ de prix
    }
  });
});
