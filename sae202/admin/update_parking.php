<?php
// Connexion à la base de données
require '../lib.inc.php';

$mabd = connexionBD();

// Vérification si le formulaire d'ajout a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $nom = $_POST['nom'];
    $map = $_POST['map'];
    $commentaire = $_POST['commentaire'];

    // Requête SQL pour insérer le nouveau parking dans la base de données
    $sql = "INSERT INTO Parking (parking_nom, parking_map, parking_comm) VALUES (:nom, :map, :commentaire)";
    $stmt = $mabd->prepare($sql);
    $stmt->bindValue(':nom', $nom);
    $stmt->bindValue(':map', $map);
    $stmt->bindValue(':commentaire', $commentaire);
    $stmt->execute();

    // Vérification si l'insertion a réussi
    if ($stmt->rowCount() > 0) {
        echo "Le parking a été ajouté avec succès.";
    } else {
        echo "Erreur lors de l'ajout du parking.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Ajouter un parking</title>
</head>
<body>
<h1>Ajouter un parking</h1>
<form method="POST">
    <label for="nom">Nom du parking:</label>
    <input type="text" name="nom"><br><br>

    <label for="map">Lien google map :</label>
    <textarea name="map"></textarea><br><br>

    <label for="commentaire">Commentaire:</label>
    <textarea name="commentaire"></textarea><br><br>

    <input type="submit" value="Ajouter">
</form>

<a href="gestion_parking.php">Retourner à la liste des parkings</a>

<?php
// Fermeture de la connexion à la base de données
deconnexionBD($mabd);
?>
</body>
</html>
