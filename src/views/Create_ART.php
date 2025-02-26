<?php $title = 'Create_ART';
$lesCSS = ["basPage", "cote", "affiche_id_mdp"];
require_once 'head.php';


$idma = $bdd->query('SELECT MAX(idG) FROM GROUPE');

$idF = $idma->fetch();
$id = $idF[0] + 1;
$nom = $_POST["nom-Art"];
$mail = $_POST["mail-Art"];

$nbT = $_POST["nb_Tec"];
$nbP = $_POST["nb_ART"];



$reqType = $bdd->prepare('INSERT INTO GROUPE (idG, nomG,mail, nbTechG, nbPersG)  VALUES (:id, :nom, :mail, :nbT, :nbP)');

$reqType->bindParam(":id", $id, PDO::PARAM_STR);
$reqType->bindParam(":nom", $nom, PDO::PARAM_STR);
$reqType->bindParam(":mail", $mail, PDO::PARAM_STR);
$reqType->bindParam(":nbT", $nbT, PDO::PARAM_STR);
$reqType->bindParam(":nbP", $nbP, PDO::PARAM_STR);
$reqType->execute();



$iden = $bdd->query('SELECT MAX(iden) FROM UTILISATEUR WHERE typeU = "ART";');
$ident = ($iden->fetch())[0];

$nbiden = (intval(substr($ident, 1))) + 1;
$iden = "A" . $nbiden;
$Chaine = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
$Chaine = str_shuffle($Chaine);
$mdp = substr($Chaine, 0, 7);


$mdp_code = password_hash($mdp, PASSWORD_DEFAULT);
$reqType = $bdd->prepare('INSERT INTO UTILISATEUR (iden, mdp, typeU) VALUES (:iden, :mdp, "ART")');

$reqType->bindParam(":iden", $iden, PDO::PARAM_STR);
$reqType->bindParam(":mdp", $mdp_code, PDO::PARAM_STR);
$reqType->execute();



$reqType = $bdd->prepare('INSERT INTO LIEN (idG, iden) VALUES (:idG, :iden)');

$reqType->bindParam(":iden", $iden, PDO::PARAM_STR);
$reqType->bindParam(":idG", $id, PDO::PARAM_STR);
$reqType->execute();


require_once "cote.php";
echo "<body><main id='info-art'><a href='/Ac_Orga'>RETOUR</a>";
echo "<div id='info'><p>Identifiant : " . $iden . "<br>
    Mot de passe : " . $mdp . "</div>";


echo "</main></body>";
require_once "basPage.php";
