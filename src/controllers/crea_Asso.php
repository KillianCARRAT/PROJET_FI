<?php try {
        $bdd = new PDO('mysql:host=servinfo-maria;dbname=DBlepage', 'lepage', 'lepage');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    session_start();



$iden = $_POST["identifiant"];
$mdp = $_POST["mot_de_passe"];
$mdp = password_hash($mdp, PASSWORD_DEFAULT);
$type = $_POST["association_type"];
if($type == "organisatrice"){
    $type = 'ORG';}
else{
    $type = 'TEC';
}





$reqType = $bdd->prepare("INSERT INTO UTILISATEUR (iden, mdp, typeU) VALUES (:id, :mdp, :typ);3");

    $reqType->bindParam(":id", $iden, PDO::PARAM_STR);
    $reqType->bindParam(":mdp", $mdp, PDO::PARAM_STR);
    $reqType->bindParam(":typ", $type, PDO::PARAM_STR);

    $reqType->execute();



 ?>