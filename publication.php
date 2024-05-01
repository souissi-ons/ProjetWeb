<?php
// Vérifier si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Vérifier si le champ de titre est vide
    if (empty($_POST['choix'])) {
        echo '<script>alert("Veuillez sélectionner une option (Adoption ou Vente).");</script>';
        // Restez sur la même page
        echo '<script>window.history.back();</script>';
        exit();
    }
    else if (empty($_POST['titre'])) {
        echo '<script>alert("Le champ titre est requis.");</script>';
        // Restez sur la même page
        echo '<script>window.history.back();</script>';
        exit();
    }
    else if (empty($_POST['num'])) {
        echo '<script>alert("Le champ numéro de téléphone est requis.");</script>';
        // Restez sur la même page
        echo '<script>window.history.back();</script>';
        exit();
    }
    else {
        // Récupérer les données du formulaire
        $choix = $_POST['choix'];
        $titre = $_POST['titre'];
        $age = $_POST['age'];
        $num = $_POST['num'];
        $description = $_POST['description'];
        if (isset($_POST['prix'])) {
        // Le champ "prix" existe dans la requête POST
        $prix = $_POST['prix'];
        }


        // Vérifier si un fichier a été uploadé
        if (isset($_FILES['imageUpload']) && $_FILES['imageUpload']['error'] === UPLOAD_ERR_OK) {
            $image_tmp_name = $_FILES['imageUpload']['tmp_name'];
            $image_name = $_FILES['imageUpload']['name'];
            $image_extension = pathinfo($image_name, PATHINFO_EXTENSION);

            // Définir le chemin de destination pour l'image uploadée
            $upload_directory = 'uploads/';
            $image_path = $upload_directory . uniqid() . '.' . $image_extension;

            // Déplacer le fichier uploadé vers le répertoire de destination
            if (move_uploaded_file($image_tmp_name, $image_path)) {
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "petadop";

                $conn = new mysqli('localhost', 'root', '', 'petadop');

                // Vérifier la connexion
                if ($conn->connect_error) {
                    die("Erreur de connexion à la base de données : " . $conn->connect_error);
                }

                // Préparer et exécuter la requête SQL d'insertion
               // Vérifier si le champ "prix" existe dans la requête POST
                if (isset($_POST['prix'])) {
                    // Le champ "prix" existe, récupérer sa valeur
                    $prix = $_POST['prix'];
                    // Ajouter la valeur de $prix dans la requête SQL d'insertion
                    $sql = "INSERT INTO publication (choix, titre, age, num, description, image_path, prix)
                            VALUES ('$choix', '$titre', '$age', '$num', '$description', '$image_path', '$prix')";
                } else {
                    // Le champ "prix" n'existe pas, insérer NULL dans la base de données pour ce champ
                    $sql = "INSERT INTO publication (choix, titre, age, num, description, image_path, prix)
                            VALUES ('$choix', '$titre', '$age', '$num', '$description', '$image_path', NULL)";
                }


                if ($conn->query($sql) === TRUE) {
                    echo '<script>alert("Publication enregistrée avec succès.");</script>';
                    // Restez sur la même page
                    header("Location: ./accueil.html");
                    exit();
                } else {
                    echo '<script>alert("Erreur lors de l\'enregistrement de la publication : " .' +  $conn->error + '");</script>';
                    // Restez sur la même page
                    echo '<script>window.history.back();</script>';
                    exit();
                }

                // Fermer la connexion à la base de données
                $conn->close();
            } else {
                echo '<script>alert("Erreur lors de l\'upload de l\'image.");</script>';
                // Restez sur la même page
                echo '<script>window.history.back();</script>';
                exit();
            }
        } else {
            echo '<script>alert("Veuillez sélectionner une image.");</script>';
            // Restez sur la même page
            echo '<script>window.history.back();</script>';
            exit();
        }
    }
} else {
    // Redirection si le formulaire n'a pas été soumis
    header("Location: publication.html");
    exit();
}
?>
