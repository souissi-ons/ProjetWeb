<?php
// Démarrez la session
session_start();

// Détruire toutes les données de session
if(session_destroy()) {
    echo "Déconnexion réussie."; // Message de débogage
} else {
    echo "Erreur lors de la déconnexion."; // Message de débogage
}
header("Location: login.html");
exit();
?>
