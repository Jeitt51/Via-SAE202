<?php
// Connexion à la base de données
require 'lib.inc.php';

$mabd = connexionBD();

// Vérification de la connexion

// Récupération des options de départ, d'arrivée et d'heure depuis la base de données
$optionsDepart = [];
$optionsArrivee = [];
$optionsHeure = [];

// Requête pour récupérer les options de départ
$sqlDepart = "SELECT DISTINCT depart FROM Trajets";
$resultDepart = $mabd->query($sqlDepart);
if ($resultDepart !== false) {
    $optionsDepart = [];
    while ($row = $resultDepart->fetch(PDO::FETCH_ASSOC)) {
        $optionsDepart[] = $row["depart"];
    }
}

// Requête pour récupérer les options d'arrivée
$sqlArrivee = "SELECT DISTINCT arrivee FROM Trajets";
$resultArrivee = $mabd->query($sqlArrivee);
if ($resultArrivee !== false) {
    $optionsArrivee = [];
    while ($row = $resultArrivee->fetch(PDO::FETCH_ASSOC)) {
        $optionsArrivee[] = $row["arrivee"];
    }
}

// Requête pour récupérer les options d'heure
$sqlHeure = "SELECT DISTINCT heure FROM Trajets";
$resultHeure = $mabd->query($sqlHeure);
if ($resultHeure !== false) {
    $optionsHeure = [];
    while ($row = $resultHeure->fetch(PDO::FETCH_ASSOC)) {
        $optionsHeure[] = $row["heure"];
    }
}

// Fermeture de la connexion à la base de données
deconnexionBD($mabd);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Sélection de trajet</title>
</head>
<body>
<h1>Sélection de trajet</h1>

<!-- Formulaire de recherche de trajet -->
<form method="post" action="resultats_trajet.php">
    <label for="depart">Départ :</label>
    <select id="depart" name="depart" required>
        <option value="">Choisir une option</option>
        <?php
        foreach ($optionsDepart as $option) {
            echo '<option value="' . $option . '">' . $option . '</option>';
        }
        ?>
    </select><br><br>

    <label for="arrivee">Arrivée :</label>
    <select id="arrivee" name="arrivee" required>
        <option value="">Choisir une option</option>
        <?php
        foreach ($optionsArrivee as $option) {
            echo '<option value="' . $option . '">' . $option . '</option>';
        }
        ?>
    </select><br><br>

    <label for="heure">Heure :</label>
    <select id="heure" name="heure" required>
        <option value="">Choisir une option</option>
        <?php
        foreach ($optionsHeure as $option) {
            echo '<option value="' . $option . '">' . $option . '</option>';
        }
        ?>
    </select><br><br>

    <input type="submit" value="Rechercher">
</form>

<br><br>
