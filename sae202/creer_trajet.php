<?php

// Connexion à la base de données
require 'lib.inc.php';

$mabd = connexionBD();


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

<!-- Formulaire de création de trajet -->
<form method="post" action="valid_trajet.php">
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

    <label for="date">Date :</label>
    <input type="date" id="date" name="date" min="<?php echo date('Y-m-d'); ?>" required><br><br>

    <label for="heure">Heure :</label>
    <input type="time" id="heure" name="heure" required><br><br>

    <label for="nombre_places">Nombre de places :</label>
    <input type="number" id="nombre_places" name="nombre_places" required><br><br>

    <input type="submit" value="Créer trajet">
</form>
</body>
</html>