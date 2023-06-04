<?php
// Connexion à la base de données
require 'lib.inc.php';

$mabd = connexionBD();

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs sélectionnées dans le formulaire
    $depart = $_POST["depart"];
    $arrivee = $_POST["arrivee"];

    // Requête SQL pour récupérer les trajets correspondants
    $sql = "SELECT Trajets.*, nom 
            FROM Trajets 
            INNER JOIN Usagers ON Trajets.user_id = Usagers.user_id
            WHERE depart = :depart AND arrivee = :arrivee";
    $stmt = $mabd->prepare($sql);
    $stmt->bindParam(':depart', $depart);
    $stmt->bindParam(':arrivee', $arrivee);
    $stmt->execute();
    $resultats = $stmt->fetchAll(PDO::FETCH_ASSOC);

    // Affichage des résultats
if (count($resultats) > 0) {
    foreach ($resultats as $resultat) {
        echo "Trajet de " . $resultat['depart'] . " à " . $resultat['arrivee'] . "<br>";
        echo "Nom de la personne : " . $resultat['nom'] . "<br>";
        echo "Nombre de places disponibles : " . $resultat['nombre_places'] . "<br>";
        echo "Date et heure : " . $resultat['date'] . "à" . $resultat['heure'] . "<br><br>";
    }
     } else {
    echo "Aucun trajet disponible pour cette recherche.";
    }
}

// Fermeture de la connexion à la base de données
deconnexionBD($mabd);
?>

