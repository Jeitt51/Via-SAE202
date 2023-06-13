<?php
require 'lib.inc.php';
session_start();
// Récupération des trajets de l'utilisateur à partir de la base de données
$mabd = connexionBD();

// Le nom de l'utilisateur connecté
$prenom = 'prenom';

$sqlTrajets = "SELECT * FROM Trajets INNER JOIN Usagers ON Trajets.user_id = Usagers.user_id WHERE prenom = :prenom";

$stmt = $mabd->prepare($sqlTrajets);
$stmt->bindParam(':prenom', $prenom);
$stmt->execute();
$trajets = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Vérifie si des trajets ont été trouvés
if ($trajets) {
    // Affichage des trajets
    foreach ($trajets as $trajet) {
        echo '<p>';
        echo 'Départ : ' . $trajet['depart'] . '<br>';
        echo 'Arrivée : ' . $trajet['arrivee'] . '<br>';
        echo 'Date : ' . $trajet['date'] . '<br>';
        echo 'Heure : ' . $trajet['heure'] . '<br>';
        echo 'Nombre de places : ' . $trajet['nombre_places'] . '<br>';
        echo '<a href="modifier_trajet.php?id=' . $trajet['id'] . '">Modifier</a>';
        echo ' | ';
        echo '<a href="supprimer_trajet.php?id=' . $trajet['id'] . '">Supprimer</a>';
        echo '</p>';
    }
} else {
    echo 'Aucun trajet trouvé.';
}

// Fermeture de la connexion à la base de données
deconnexionBD($mabd);
?>
