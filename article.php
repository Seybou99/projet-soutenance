<?php
include 'connecte.php'; // Inclure le fichier de connexion

session_start(); // Assurez-vous que la session est démarrée

try {
    if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_SESSION['id_user'])) {
        // Récupérer les données du formulaire
        $titre = isset($_POST["titre"]) ? $_POST["titre"] : "";
        $contenu = isset($_POST["contenu"]) ? $_POST["contenu"] : "";
        $date_publication = isset($_POST["date_publication"]) ? $_POST["date_publication"] : "";
        $id_user = $_SESSION['id_user']; // Utilisateur actuel

        // Préparer la requête d'insertion
        $insertQuery = $dbh->prepare("INSERT INTO article (titre, contenu, date_publication, id_user) VALUES (?, ?, ?, ?)");

        // Exécuter la requête avec les valeurs du formulaire
        $success = $insertQuery->execute([$titre, $contenu, $date_publication, $id_user]);

        if ($success) {
            echo "Ajout réussi";
        } else {
            echo "Échec de l'ajout";
        }

        exit(); // Assurez-vous de terminer le script après la redirection pour éviter toute exécution supplémentaire non souhaitée
    } else {
        // Rediriger vers la page de connexion si l'utilisateur n'est pas connecté
        echo "Erreur : Utilisateur non connecté";
        var_dump($_SERVER["REQUEST_METHOD"]);
        var_dump(isset($_SESSION['id_user']));
        exit();
    }
} catch (PDOException $e) {
    echo "Erreur : " . $e->getMessage();
    // Gérer l'erreur de manière appropriée, rediriger ou afficher un message d'erreur convivial
}
?>
