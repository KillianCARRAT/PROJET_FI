<?php
use src\controllers\Database;
$bdd = Database::getConnection();

$id = $_POST['ident'];
$mdp_code = $_POST['passwd'];


$reqType = $bdd->prepare('SELECT typeU, mdp FROM UTILISATEUR WHERE iden=:id');
$reqType->bindParam(":id", $id, PDO::PARAM_STR);
$reqType->execute();
$row = $reqType->fetch();
$role = $row["typeU"];
$bd_mdp = $row["mdp"];

$_SESSION["idUser"] = $id;

error_log("\n\n" . 'idUser : ');


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
        default:
            header('Location: /');
            exit;
    }
} else {
    header("Location: /connexion_fail");
}
