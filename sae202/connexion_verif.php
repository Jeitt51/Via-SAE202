<?php
session_start();
require 'lib.inc.php';

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
$ligne=$resultat->fetch(PDO::FETCH_ASSOC);


    if ($mdp == $ligne['usagers_mdp']) {
        echo '<p>OK... :)</p>';
        $_SESSION['prenom']=$ligne['prenom'];
        $_SESSION['numero']=$ligne['user_id'];
        header('location:index.php');
    } else {
//echo '<p>KO... :(</p>';
        $_SESSION['erreur']='<h1 class="erreur">Le mot de passe saisi est incorrect.</h1>';
        header('location:connexion.php');
    }
}
deconnexionBD($mabd);