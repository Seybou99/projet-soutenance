<?php
include 'connecte.php'; // Inclure le fichier de connexion
session_start(); // Assurez-vous que la session est démarrée

// Vérifier si l'utilisateur est déjà connecté
if (isset($_SESSION['id_user'])) {
    // Rediriger vers une page sécurisée
    header("Location: index.html");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $mot_de_passe = isset($_POST["mot_de_passe"]) ? $_POST["mot_de_passe"] : "";

    // Vérification si les informations de connexion sont valides
    $query = $dbh->prepare("SELECT * FROM inscription WHERE email = ?");
    $query->execute([$email]);
    $user = $query->fetch(PDO::FETCH_ASSOC);

    if ($user && password_verify($mot_de_passe, $user['mot_de_passe'])) {
        // Utilisateur authentifié, vous pouvez rediriger vers une page sécurisée ou afficher un message de bienvenue
        $_SESSION['id_user'] = $user['id_user'];
        echo "Bienvenue, " . $user['prenom'] . " " . $user['nom'] . "!";
        // Rediriger vers une page sécurisée
        header("Location: article.html");
        exit();
    } else {
        // Informations de connexion invalides, afficher un message d'erreur générique
        echo "Erreur : Adresse e-mail ou mot de passe incorrect.";
    }
}
?>
