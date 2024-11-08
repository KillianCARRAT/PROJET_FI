<?php
try {
    $bdd = new PDO('mysql:host=servinfo-maria;dbname=DBlepage', 'lepage', 'lepage');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

session_start();

$id = $_POST['ident'];
$mdp = $_POST['passwd'];

$reqType = $bdd->prepare('SELECT type FROM UTILISATEUR WHERE iden=:id AND mdp=:mdp');
$reqType->bindParam(":id", $id, PDO::PARAM_STR);
$reqType->bindParam(":mdp", $mdp, PDO::PARAM_STR);
$reqType->execute();

$role = $reqType->fetchColumn();

$_SESSION["idUser"]=$id;

if ($role == "ART") {
    header('Location: /src/Views/Liste_Spec_Art.php');
    exit;
} elseif ($role == "ORG") {
    header('Location: /src/Views/Liste_Spec_Orga.php');
    exit;
} elseif ($role == "TEC") {
    header("Location: /src/Views/Liste_Spec_Tech.php");
    exit;
}else{include "connexion.php";}
?>
