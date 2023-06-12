<?php

// Connexion à la base de données
require 'lib.inc.php';

$mabd = connexionBD();

// Vérification si le formulaire de création de trajet a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $depart = $_POST['depart'];
    $arrivee = $_POST['arrivee'];
    $date = $_POST['date'];
    $heure = $_POST['heure'];
    $nombrePlaces = $_POST['nombre_places'];

    // Vérification si la date sélectionnée est antérieure à la date d'aujourd'hui
    $dateActuelle = date('Y-m-d');
    if ($date < $dateActuelle) {
        echo "La date sélectionnée est antérieure à la date d'aujourd'hui.";
    } else {
        // Requête SQL pour insérer le nouveau trajet dans la base de données
        $sqlInsert = "INSERT INTO Trajets (depart, arrivee, date, heure, nombre_de_places) VALUES (:depart, :arrivee, :date, :heure, :nombre_places)";
        $stmt = $mabd->prepare($sqlInsert);
        $stmt->bindValue(':depart', $depart);
        $stmt->bindValue(':arrivee', $arrivee);
        $stmt->bindValue(':date', $date);
        $stmt->bindValue(':heure', $heure);
        $stmt->bindValue(':nombre_places', $nombrePlaces);
        $stmt->execute();

        // Vérification si l'insertion a réussi
        if ($stmt->rowCount() > 0) {
            echo "Le trajet a été créé avec succès.";
        } else {
            echo "Erreur lors de la création du trajet.";
        }
    }
}

// Fermeture de la connexion à la base de données
deconnexionBD($mabd);

