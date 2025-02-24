<?php

// Connexion à la base de données
use src\controllers\Database;
$bdd = Database::getConnection();

// Vérifie si les données du formulaire existent
if (isset($_POST['nom-Art'], $_POST['date-Rep'], $_POST['heure-Rep'])) {
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
        header("Location: Create_Spec");
        exit;
    }
} else {
    echo "Erreur : tous les champs requis n'ont pas été remplis.";
}
?>
