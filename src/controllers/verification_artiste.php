<?php
use src\controllers\Database;
$bdd = Database::getConnection();

$nom = $_POST['nom-Art'];
$date = $_POST['date-Rep'];
$heure = $_POST['heure-Rep'];
$duree = $_POST["duree-Rep"];
$arrive = $_POST["heure-arrivé"];

$_SESSION["id-art-spec"] = $nom;
$_SESSION["date-art-spec"] = $date;
$_SESSION["heure-art-spec"] = $heure;
$_SESSION["duree-rep"] = $duree;
$_SESSION["heure-arrivé"] = $arrive;

header("Location: Create_Spec2");
