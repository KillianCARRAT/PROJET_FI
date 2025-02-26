<?php
use src\controllers\Database;
$bdd = Database::getConnection();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $idS = $_POST['idS'];
    $nomS = $_POST['nomS'];
    $nbPlaceS = $_POST['nbPlaceS'];
    $nbTechS = $_POST['nbTechS'];
    $adresseS = $_POST['adresseS'];

    $reqUpdate = $bdd->prepare('UPDATE SALLE SET nomS = :nomS, nbPlaceS = :nbPlaceS, nbTechS = :nbTechS, adresseS = :adresseS WHERE idS = :idS');
    $reqUpdate->bindParam(':nomS', $nomS, PDO::PARAM_STR);
    $reqUpdate->bindParam(':nbPlaceS', $nbPlaceS, PDO::PARAM_INT);
    $reqUpdate->bindParam(':nbTechS', $nbTechS, PDO::PARAM_INT);
    $reqUpdate->bindParam(':adresseS', $adresseS, PDO::PARAM_STR);
    $reqUpdate->bindParam(':idS', $idS, PDO::PARAM_INT);
    $reqUpdate->execute();
}

header('Location: /Liste_S');