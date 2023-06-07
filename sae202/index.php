<!DOCTYPE html>
<html>
<head>
    <title>Page d'accueil</title>
</head>
<body>
<h1>Bienvenue sur ma page d'accueil</h1>

<?php
// Ton code PHP ici

// Exemple d'affichage de la date actuelle
$date = date('d/m/Y');
echo "<p>Aujourd'hui, nous sommes le $date.</p>";
?>

<p>Voici quelques exemples de liens :</p>
<ul>
    <li><a href="connexion.php">Page 1</a></li>
    <li><a href="inscription.php">Page 2</a></li>
    <li><a href="trajet.php">Page 3</a></li>
    <li><a href="parking.php">Parking</a> </li>
    <li><a href="profil.php">Voir/Mettre à jour mon profil</a></li>
</ul>
</body>
</html>
