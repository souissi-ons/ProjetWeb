<?php


// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs sont vides
    if (!empty($_POST['nom']) && !empty($_POST['prenom']) && !empty($_POST['email']) && !empty($_POST['password'])) {
        // Connexion à la base de données
        $conn = new mysqli('localhost', 'root', '', 'petadop');

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("La connexion a échoué : " . $conn->connect_error);
        }

        // Échapper les entrées pour éviter les attaques par injection SQL
        $nom = $conn->real_escape_string($_POST['nom']);
        $prenom = $conn->real_escape_string($_POST['prenom']);
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        // Hasher le mot de passe avant de l'enregistrer dans la base de données
        $hashed_password = password_hash($password, PASSWORD_DEFAULT);

        // Requête SQL pour insérer un nouvel utilisateur
        $sql = "INSERT INTO utilisateur (email, password, nom, prenom) VALUES ('$email', '$hashed_password', '$nom', '$prenom')";

        if ($conn->query($sql) === TRUE) {
            // Rediriger vers la page de connexion après l'inscription
            header("Location: login.html");
            exit();
        } else {
            // Erreur lors de l'insertion, rediriger vers la page d'inscription avec un message d'erreur
            header("Location: register.html?error=1");
            exit();
        }
    } else {
        // Champ(s) vide(s), rediriger vers la page d'inscription avec un message d'erreur
        header("Location: register.html?error=2");
        exit();
    }
} else {
    // Rediriger vers la page d'inscription si l'accès direct à ce fichier est tenté
    header("Location: register.html");
    exit();
}
?>
