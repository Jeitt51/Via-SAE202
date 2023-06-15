<?php
// Connexion à la base de données
require '../lib.inc.php';

$mabd = connexionBD();

// Requête SQL pour récupérer les informations des parkings
$sql = "SELECT * FROM Parking";
$result = $mabd->query($sql);
$parkings = $result->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Liste des parkings</title>
</head>
<body>
<h1>Liste des parkings</h1>
<table>
    <tr>
        <th>Nom du parking</th>
        <th>Lien Google Maps</th>
        <th>Commentaire</th>
        <th>Action</th>
    </tr>

    <?php foreach ($parkings as $parking): ?>
        <tr>
            <td><?php echo $parking['parking_nom']; ?></td>
            <td><?php echo $parking['parking_map']; ?></td>
            <td><?php echo $parking['parking_comm']; ?></td>
            <td>
                <a href="update_parking.php?id=<?php echo $parking['parking_id']; ?>">Ajouter</a> |
                <a href="edit_parking.php?id=<?php echo $parking['parking_id']; ?>">Modifier</a> |
                <a href="delete_parking.php?id=<?php echo $parking['parking_id']; ?>" onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce parking ?')">Supprimer</a>
            </td>
        </tr>
    <?php endforeach; ?>
</table>

<?php
// Fermeture de la connexion à la base de données
deconnexionBD($mabd);
?>
</body>
</html>
