<?php
// Démarrer la session
session_start();

// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si les champs email et password sont envoyés
    if (!empty($_POST['email']) && !empty($_POST['password'])) {
        // Connexion à la base de données
        $conn = new mysqli('localhost', 'root', '', 'petadop');

        // Vérifier la connexion
        if ($conn->connect_error) {
            die("La connexion à la base de données a échoué : " . $conn->connect_error);
        }

        // Échapper les entrées pour éviter les attaques par injection SQL
        $email = $conn->real_escape_string($_POST['email']);
        $password = $conn->real_escape_string($_POST['password']);

        // Requête SQL pour récupérer l'utilisateur avec l'email fourni
        $sql = "SELECT * FROM utilisateur WHERE email='$email'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Utilisateur trouvé, vérifier le mot de passe
            $row = $result->fetch_assoc();
            if (password_verify($password, $row['password'])) {
                // Mot de passe correct, connectez l'utilisateur
                // Ajoutez votre code de connexion ici si nécessaire

                // Définir des variables de session pour l'utilisateur connecté
                $_SESSION['user_id'] = $row['id'];
                $_SESSION['user_email'] = $row['email'];
                // Ajoutez d'autres données utilisateur si nécessaire

                // Redirection vers la page home.html après la connexion réussie
                header("Location: home.html");
                exit();
            } else {
                // Mot de passe incorrect
                // Affichage d'une alerte en utilisant JavaScript
                echo '<script>alert("Mot de passe incorrect !");</script>';
                // Restez sur la même page
                echo '<script>window.history.back();</script>';
                exit();
            }
        } else {
            // Aucun utilisateur trouvé avec cet email
            echo '<script>alert("Aucun utilisateur trouvé avec cet email !");</script>';
            // Restez sur la même page
            echo '<script>window.history.back();</script>';
            exit();
        }

        // Fermer la connexion
        $conn->close();
    } else {
        // Champ(s) vide(s) dans le formulaire
        echo '<script>alert("Veuillez remplir tous les champs !");</script>';
        // Restez sur la même page
        echo '<script>window.history.back();</script>';
        exit();
    }
} else {
    // Rediriger vers la page de connexion si l'accès direct à ce fichier est tenté

    header("Location: login.html");

    exit();
}
?>
