<?php
// Connexion à la base de données
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "petadop";

// Création de la connexion
$conn = new mysqli($servername, $username, $password, $dbname);

// Vérification de la connexion
if ($conn->connect_error) {
    die("Erreur de connexion à la base de données : " . $conn->connect_error);
}

// Requête SQL pour récupérer toutes les publications
$sql = "SELECT * FROM publication";
$result = $conn->query($sql);

// Vérification s'il y a des résultats à afficher
if ($result->num_rows > 0) {
    // Créer un tableau associatif pour stocker les données des publications
    $publications = array();
    while ($row = $result->fetch_assoc()) {
        $publications[] = $row;
    }
    // Convertir le tableau associatif en JSON
    $publicationsJSON = json_encode($publications);
    echo $publicationsJSON;
} else {
    echo "Aucune publication trouvée.";
}

// Fermeture de la connexion à la base de données
$conn->close();
?>
