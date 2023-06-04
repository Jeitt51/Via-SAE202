<?php
// Connexion à la base de données
require 'lib.inc.php';


$mabd=connexionBD();

// Vérification de la connexion

// Récupération des options de départ et d'arrivée depuis la base de données
$optionsDepart = [];
$optionsArrivee = [];

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

    <input type="submit" value="Rechercher">
</form>
</body>
</html>
