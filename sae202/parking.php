<?php
// Connexion à la base de données
require 'lib.inc.php';

$mabd = connexionBD();

// Requête SQL pour récupérer les informations des parkings
$sql = "SELECT * FROM Parking";
$result = $mabd->query($sql);
$parkings = $result->fetchAll(PDO::FETCH_ASSOC);

// Affichage des informations des parkings
foreach ($parkings as $parking) {
    echo "Nom du parking : " . $parking['parking_nom'] . "<br>";
    echo "Commentaire : " . $parking['parking_comm'] . "<br>";

    // Affichage de l'image de Google Maps
    echo '<iframe src="https://www.google.com/maps/embed?pb=' . $parking['parking_map'] . '"
    width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade">
    </iframe><br><br>';

    // Ajout du lien de suppression
    // echo '<a href="admin/delete-parking.php?id=' . $parking['parking_id'] . '">Supprimer ce parking</a>';

}

// Fermeture de la connexion à la base de données
deconnexionBD($mabd);
?>
