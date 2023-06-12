<?php

require 'lib.inc.php';

$usagers_email = $_POST['email'];

$mabd = connexionBD();
$req =  'SELECT * FROM Usagers WHERE usagers_email LIKE ".$usagers_email"';
$resultat = $mabd->query($req);

?>

<html>

<li><a href='index.php'> retour à la page d'accueil </a></li>"

</html>