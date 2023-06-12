<?php
session_start();
require 'lib.inc.php';

$compteurConnexions = 0;

if (empty($_POST)) {
    header('Location: connexion.php');
}

$email=$_POST['email'];
$mdp=$_POST['mdp'];

$mabd=connexionBD();
$req='SELECT * FROM Usagers WHERE usagers_email LIKE "'.$email.'"';
//echo '<p>'.$req.'</p>';

// on lance la requête
$resultat=$mabd->query($req);

// on calcule le nombre de lignes renvoyées
$lignes_resultat=$resultat->rowCount();

if ($lignes_resultat>0) { // y a-t-il des résultats ?
// oui : pour chaque résultat : afficher
    $ligne = $resultat->fetch(PDO::FETCH_ASSOC);

    if ($mdp == $ligne['usagers_mdp']) {
        $_SESSION['prenom'] = $ligne['prenom'];
        $_SESSION['numero'] = $ligne['user_id'];
        header('Location: index.php');
        exit(); // Ajoutez cette ligne pour terminer l'exécution du script après la redirection
    } else {
        $_SESSION['erreur'] = '<h1>Le mot de passe saisi est incorrect.</h1>';
        header('Location: connexion.php');
        exit(); // Ajoutez cette ligne pour terminer l'exécution du script après la redirection
    }
}