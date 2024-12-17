<?php $title = 'Crea_ART';
$lesCSS = ["crationART", "basPage", "cote","Create_Spec"];
include 'head.php';


$idma = $bdd->query('SELECT MAX(idG) FROM GROUPE');
$id = $idma->fetch();
$id += 1;
$nom = $_POST["nom-ART"];
$mail = $_POST["nom-ART"];
$nbT = $_POST["nb_Tec"];
$nbP = $_POST["nb_ART"];



    $reqType = $bdd->prepare('INSERT INTO GROUPE (:id, ":nom", ":mail" :nbT, nbP)');
    $reqType->bindParam(":id", $id, PDO::PARAM_STR);
    $reqType->bindParam(":nom", $nom, PDO::PARAM_STR);
    $reqType->bindParam(":mail", $mail, PDO::PARAM_STR);
    $reqType->bindParam(":nbT", $nbT, PDO::PARAM_STR);
    $reqType->bindParam(":nbP", $nbP, PDO::PARAM_STR);
    $reqType->execute();

    $iden = $bdd->query('SELECT MAX(iden) FROM UTILISATEUR WHERE type = "ART";');
    $ident = $iden->fetch();
    $nbiden=(intval(substr($ident, 1))) + 1;
    $iden = "A" . $nbiden;
    $Chaine = "abcdefghijklmnopqrstuvwxyz0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $Chaine = str_shuffle($Chaine);
    $mdp = substr($Chaine,0,7);
    $mdp = password_hash($mdp, PASSWORD_DEFAULT);
    $reqType = $bdd->prepare('INSERT INTO UTILISATEUR (:iden, :mdp, ART)');
    $reqType->bindParam(":iden", $iden, PDO::PARAM_STR);
    $reqType->bindParam(":mdp", $mdp, PDO::PARAM_STR);
    $reqType->execute();

    $reqType = $bdd->prepare('INSERT INTO LIEN (:idG,:iden)');
    $reqType->bindParam(":iden", $iden, PDO::PARAM_STR);
    $reqType->bindParam(":idG", $id, PDO::PARAM_STR);
    $reqType->execute();



 ?>