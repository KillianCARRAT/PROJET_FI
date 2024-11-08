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
$_SESSION["mdpUser"]=$mdp;

if ($role == "ART") {
    header('Location: Ac_Art');
    exit;
} elseif ($role == "ORG") {
    header('Location: Ac_Orga');
    exit;
} elseif ($role == "TEC") {
    header("Location: /Ac_Tech");
    exit;
} else {
    header("Location: /connexion_fail");
}
?>