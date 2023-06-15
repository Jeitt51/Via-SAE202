<?php
// Connexion à la base de données
require '../lib.inc.php';

$mabd = connexionBD();

// Vérification si l'ID du parking à supprimer est passé dans l'URL
if (isset($_GET['id'])) {
    $parkingId = $_GET['id'];

    // Requête SQL pour supprimer le parking avec l'ID spécifié
    $sqlDelete = "DELETE FROM Parking WHERE parking_id = :parking_id";
    $stmt = $mabd->prepare($sqlDelete);
    $stmt->bindValue(':parking_id', $parkingId);
    $stmt->execute();

    // Vérification si la suppression a réussi
    if ($stmt->rowCount() > 0) {
        echo "Le parking a été supprimé avec succès.";
    } else {
        echo "Erreur lors de la suppression du parking.";
    }
}

// Requête SQL pour récupérer les informations des parkings
$sql = "SELECT * FROM Parking";
$result = $mabd->query($sql);
$parkings = $result->fetchAll(PDO::FETCH_ASSOC);

// Affichage des informations des parkings sous forme de tableau
echo '<table>
        <tr>
            <th>Nom du parking</th>
            <th>Commentaire</th>
            <th>Action</th>
        </tr>';

foreach ($parkings as $parking) {
    echo '<tr>';
    echo '<td>' . $parking['parking_nom'] . '</td>';
    echo '<td>' . $parking['parking_comm'] . '</td>';
    echo '<td>
            <a href="delete_parking.php?id=' . $parking['parking_id'] . '" onclick="return confirm(\'Êtes-vous sûr de vouloir supprimer ce parking ?\')">Supprimer</a> |
            <a href="edit_parking.php?id=' . $parking['parking_id'] . '">Modifier</a>
          </td>';
    echo '</tr>';
}

echo '</table>';

// Fermeture de la connexion à la base de données
deconnexionBD($mabd);
?>
