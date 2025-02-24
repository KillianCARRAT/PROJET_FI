<?php

// Connexion à la base de données

use src\controllers\Database;
$bdd = Database::getConnection();


// Vérifie si les données du formulaire existent

$nom = $_POST['nom-Art'];
$date = $_POST['date-Rep'];
$heure = $_POST['heure-Rep'];
$duree = $_POST["duree-Rep"];
$arrive = $_POST["heure-arrivé"];


// Stocke les données dans la session
$_SESSION["nom-art-spec"] = $nom;
$_SESSION["date-art-spec"] = $date;
$_SESSION["heure-art-spec"] = $heure;
$_SESSION["duree-rep"] = $duree;
$_SESSION["heure-arrivé"] = $arrive;

header("Location: Create_Spec2");



?>
