<?php
session_start(); // Démarre la session

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

error_log($_SESSION["nom-art-spec"]);
error_log($_SESSION["date-art-spec"]);
error_log($_SESSION["heure-art-spec"]);
error_log($_SESSION["duree-rep"]);
error_log($_SESSION["heure-arrivé"]);



// Vérifie si le groupe existe dans la base de données
$reqType = $bdd->prepare('SELECT nomG FROM GROUPE WHERE nomG = :nom');
$reqType->bindParam(":nom", $nom, PDO::PARAM_STR);
$reqType->execute();

$resultat = $reqType->fetch();

if ($resultat) {
    // Le groupe existe : redirige vers la page suivante
    header("Location: Create_Spec2");
    exit;
} else {
    // Le groupe n'existe pas : redirige avec un indicateur d'erreur

    $_SESSION["mauvais_art"] = true;
    print_r($_SESSION);
    header("Location: Create_Spec");
    exit;
}

?>
