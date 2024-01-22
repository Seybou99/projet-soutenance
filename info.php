<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Informations des inscriptions</title>
</head>
<body>

<h2>Informations des inscriptions</h2>

<table border="1">
    <tr>
        <th>Nom</th>
        <th>Prénom</th>
        <th>Numéro de Téléphone</th>
        <th>Adresse E-mail</th>
        <th>Date de Naissance</th>
    </tr>

   <?php
    include 'connecte.php'; // Inclure le fichier de connexion

    // Sélectionner toutes les entrées de la table inscription
    $result = $dbh->query("SELECT * FROM inscription");

    // Parcourir les résultats et afficher chaque ligne dans le tableau HTML
    foreach ($result as $row) {
        echo "<tr>";
        echo "<td>" . htmlspecialchars($row['nom']) . "</td>";
        echo "<td>" . htmlspecialchars($row['prenom']) . "</td>";
        echo "<td>" . htmlspecialchars($row['telephone']) . "</td>";
        echo "<td>" . htmlspecialchars($row['email']) . "</td>";
        echo "<td>" . htmlspecialchars($row['date_naissance']) . "</td>";
    }
    ?>
</table>
<a href="article.html">ajout article</a>
</body>
</html>
