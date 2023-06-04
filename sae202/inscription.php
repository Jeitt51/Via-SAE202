<?php

require 'lib.inc.php';

// Vérification si le formulaire a été soumis
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Récupération des valeurs saisies dans le formulaire
    $nom = $_POST["nom"];
    $email = $_POST["email"];
    $mdp = $_POST["mdp"];

    // Connexion à la base de données
    $mabd=connexionBD();

    // Requête SQL pour insérer les informations dans la base de données
    $req = "INSERT INTO Usagers (nom, usagers_email, usagers_mdp) VALUES ('$nom', '$email', '$mdp')";

    if ($mabd->query($req)) {
        // Enregistrement réussi
        echo "Enregistrement réussi !";
        // Autres actions à effectuer après l'enregistrement

    } else {
        // Erreur lors de l'enregistrement
        echo "Erreur lors de l'enregistrement : ";
    }

    // Fermeture de la connexion à la base de données
    deconnexionBD($mabd);
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Page d'inscription</title>
</head>
<body>
<h1>Inscription</h1>

<form method="post" action="">
    <label for="nom">Nom:</label>
    <input type="text" id="nom" name="nom" required><br><br>

    <label for="email">Email:</label>
    <input type="email" id="email" name="email" required><br><br>

    <label for="mdp">Mot de passe:</label>
    <input type="password" id="mdp" name="mdp" required><br><br>

    <input type="submit" value="S'inscrire">
</form>
</body>
</html>
