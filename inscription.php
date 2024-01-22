<?php
include 'connecte.php'; // Inclure le fichier de connexion
session_start(); // Assurez-vous que la session est démarrée
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupérer les données du formulaire
    $nom = isset($_POST["nom"]) ? $_POST["nom"] : "";
    $prenom = isset($_POST["prenom"]) ? $_POST["prenom"] : "";
    $telephone = isset($_POST["telephone"]) ? $_POST["telephone"] : "";
    $email = isset($_POST["email"]) ? $_POST["email"] : "";
    $date_naissance = isset($_POST["date_naissance"]) ? $_POST["date_naissance"] : "";
    $mot_de_passe = isset($_POST["mot_de_passe"]) ? $_POST["mot_de_passe"] : "";

    // Validation des données (ajoutez des vérifications supplémentaires si nécessaire)

    // Vérification du format du numéro de téléphone
    if (!preg_match("/^[0-9]{10}$/", $telephone)) {
        die("Erreur : Format invalide pour le numéro de téléphone");
    }

    // Vérification du format de l'adresse e-mail
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        die("Erreur : Format invalide pour l'adresse e-mail");
    }

    // Vérification si l'e-mail existe déjà
    $existingEmailQuery = $dbh->prepare("SELECT COUNT(*) FROM inscription WHERE email = ?");
    $existingEmailQuery->execute([$email]);
    $emailExists = $existingEmailQuery->fetchColumn();

    if ($emailExists) {
        die("Erreur : Cette adresse e-mail est déjà utilisée.");
    }

    try {
        // Hachage sécurisé du mot de passe
        $mot_de_passe_hash = password_hash($mot_de_passe, PASSWORD_BCRYPT);

        // Préparer la requête d'insertion
        $insertQuery = $dbh->prepare("INSERT INTO inscription (nom, prenom, telephone, email, date_naissance, mot_de_passe) VALUES (?, ?, ?, ?, ?, ?)");

        // Exécuter la requête avec les valeurs du formulaire
        $insertQuery->execute([$nom, $prenom, $telephone, $email, $date_naissance, $mot_de_passe_hash]);

        // Rediriger vers info.php après une inscription réussie
        header("Location: info.php");
        exit(); // Assurez-vous de terminer le script après la redirection pour éviter toute exécution supplémentaire non souhaitée
    } catch (PDOException $e) {
        echo "Erreur : " . $e->getMessage();
    }
}
?>