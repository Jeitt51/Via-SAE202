<?php
// Connexion à la base de données
require 'lib.inc.php';

$mabd = connexionBD();

// Vérification si le formulaire de réservation a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs du formulaire
    $trajet_id = $_POST["trajet_id"];
    $echange = isset($_POST["echange"]) ? $_POST["echange"] : "";
    $bagages = isset($_POST["bagages"]) ? $_POST["bagages"] : "";

    // Vérification si l'utilisateur est connecté
    session_start();
    if (isset($_SESSION['user_id'])) {
        // Récupération de l'identifiant de l'utilisateur
        $user_id = $_SESSION['user_id'];

        // Requête SQL pour insérer la réservation dans la table
        $sqlInsert = "INSERT INTO Reservations (echange, bagages, user_id, trajet_id) VALUES (:echange, :bagages, :user_id, :trajet_id)";
        $stmt = $mabd->prepare($sqlInsert);
        $stmt->bindValue(':echange', $echange);
        $stmt->bindValue(':bagages', $bagages);
        $stmt->bindValue(':user_id', $user_id);
        $stmt->bindValue(':trajet_id', $trajet_id);
        $stmt->execute();

        // Vérification si l'insertion a réussi
        if ($stmt->rowCount() > 0) {
            echo "Votre trajet a bien été réservé.";
        } else {
            echo "Erreur lors de la réservation du trajet.";
        }
    } else {
        echo "Utilisateur non connecté.";
    }
}

// Fermeture de la connexion à la base de données
deconnexionBD($mabd);
?>
