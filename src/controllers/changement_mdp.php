<?php
use src\controllers\Database;
$bdd = Database::getConnection();

$id = $_POST['ident'];
$new_mdp = $_POST['new-passwd'];
$confirm_mdp = $_POST['confirm-passwd'];

$reqType = $bdd->prepare('SELECT typeU, mdp FROM UTILISATEUR WHERE iden=:id');
$reqType->bindParam(":id", $id, PDO::PARAM_STR);
$reqType->execute();

$row = $reqType->fetch();
$role = $row["typeU"];
$mdp_code = $row["mdp"];

if ($new_mdp != $confirm_mdp) {
    header("Location: /rate-diff-mdp");
} elseif (password_verify($new_mdp, $mdp_code)) {
    header("Location: /rate-meme-mdp");
} else {
    $hash_mdp = password_hash($new_mdp, PASSWORD_DEFAULT);
    $reqUpdateMDP = $bdd->prepare('UPDATE UTILISATEUR SET mdp=:mdp WHERE iden=:id');
    $reqUpdateMDP->bindParam(":id", $id, PDO::PARAM_STR);
    $reqUpdateMDP->bindParam(":mdp", $hash_mdp, PDO::PARAM_STR);
    $reqUpdateMDP->execute();
    error_log("mdp change");
    header("Location: /chan-mdp-reussi");
}
