<?php
// Connexion à la base de données (à remplacer par vos propres paramètres)
$dsn = "mysql:host=localhost;dbname=exemple";
$username = "root";
$password = "";

try {
    $dbh = new PDO($dsn, $username, $password);
} catch (PDOException $e) {
    die("Erreur de connexion à la base de données : " . $e->getMessage());
}
?>
