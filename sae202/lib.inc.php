<?php

require 'secret.php';
function connexionBD(){
    $mabd=null;
    try {
        $mabd = new PDO('mysql:host=localhost;
    dbname=sae202;charset=UTF8;',
            UTILISATEUR, LEMOTDEPASSE);
        $mabd->query('SET NAMES utf8;');
    }catch (PDOException $e) {
        print "Erreur : ".$e->getMessage().'<br />'; die();
    }
    return $mabd;

}

//fonction de déconnexion
function deconnexionBD(&$mabd) {

    $mabd=null;
}

