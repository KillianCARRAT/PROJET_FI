<?php session_start();
$id_cpt = $_SESSION['idUser'];
$title = 'Compte';
$lesCSS = ["basPage", "cote"];
include 'head.php';

$idUser = $_SESSION["idUser"];
$reqType = $bdd->prepare('SELECT typeU FROM UTILISATEUR WHERE iden=:id');
$reqType->bindParam(":id", $idUser, PDO::PARAM_STR);
$reqType->execute();
$tout = $reqType->fetchAll();
$role = $tout[0][0]; ?>

<body>
    <?php include "cote.php" ?>
    <main><?php
if ($role == "ART") {
    $rec_user = $bdd->prepare('SELECT * FROM UTILISATEUR NATURAL JOIN LIEN NATURAL JOIN GROUPE WHERE iden=:id');
    $rec_user->bindParam(":id", $idUser, PDO::PARAM_STR);
    $rec_user->execute();




} elseif ($role == "ORG" || $role == "TEC") {
    $rec_user = $bdd->prepare('SELECT * FROM UTILISATEUR WHERE iden=:id');
    $rec_user->bindParam(":id", $idUser, PDO::PARAM_STR);
    $rec_user->execute();
}

    ?>
    </main>
    <?php include "basPage.php"; ?>
</body>

</html>