<?php
try {
    $bdd = new PDO('mysql:host=servinfo-maria;dbname=DBlepage', 'lepage', 'lepage');
} catch (Exception $e) {
    die('Erreur : ' . $e->getMessage());
}

session_start();

$id = $_POST['ident'];
$mdp_code = $_POST['passwd'];


$reqType = $bdd->prepare('SELECT typeU, mdp FROM UTILISATEUR WHERE iden=:id');
$reqType->bindParam(":id", $id, PDO::PARAM_STR);
$reqType->execute();
$row = $reqType->fetch();
$role = $row["typeU"];
$bd_mdp = $row["mdp"];

$_SESSION["idUser"] = $id;


if (password_verify($mdp_code, $bd_mdp)) {
    switch ($role) {
        case "ART":
            header('Location: /Ac_Art');
            exit;
        case "ORG":
            header('Location: /Ac_Orga');
            exit;
        case "TEC":
            header('Location: /Ac_Tech');
            exit;
        case "ADM":
            header('Location: /ADM');
            exit;
    }
} else {
    header("Location: /connexion_fail");
}
