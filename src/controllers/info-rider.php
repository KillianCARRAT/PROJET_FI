<?php
use src\controllers\Database;
$bdd = Database::getConnection();

// DIV GAUCHE

$nom = $_POST["nom"];
$date = $_POST["date"];
$demandeP = $_POST["demandeP"];
$idC = $_POST["idC"];
$idG = $_POST["idG"];


$checkVehicule = $_POST["vehicule"] ?? NULL;
$checkHotel = $_POST["hotel"] ?? NULL;

if ($checkVehicule == "on") {
    $adresseV = $_POST["adresse"];
} else {
    $adresseV = null;
}

if ($checkHotel == "on") {
    $demandeH = $_POST["demande-hotel"];
} else {
    $demandeH = null;
}
if(empty($_POST['message'])) {

} else {
    $insereCommentaire = $bdd->prepare('INSERT INTO COMMENTAIRE VALUES (:msg)');
    $insereCommentaire->bindParam("msg", $demandeP, PDO::PARAM_STR);
    $insereCommentaire->execute();
    
    $updateCom = $bdd->prepare('UPDATE CONCERT SET idCom=:idCom WHERE idC=:idC');
    $updateCom->bindParam("idCom", $idCom, PDO::PARAM_STR);
    $updateCom->execute();
}

$updateConcert = $bdd->prepare('UPDATE CONCERT SET besoinTransport=:bTransport, besoinHotel=:bHotel WHERE idC=:idC');
$updateConcert->bindParam("bTransport", $adresseV, PDO::PARAM_STR);
$updateConcert->bindParam("bHotel", $demandeH, PDO::PARAM_STR);
$updateConcert->bindParam("idC", $idC, PDO::PARAM_INT);
$updateConcert->execute();

// DIV DROITE

$deleteBesoin = $bdd->prepare('DELETE FROM BESOIN WHERE idC=:idC');
$deleteBesoin->bindParam(":idC", $idC, PDO::PARAM_INT);
$deleteBesoin->execute();

$deleteAvoirGroupe = $bdd->prepare('DELETE FROM AVOIRGROUPE WHERE idG=:idG');
$deleteAvoirGroupe->bindParam(":idG", $idG, PDO::PARAM_INT);
$deleteAvoirGroupe->execute();

$infoRider = array_filter($_POST, 'is_array');

if (isset($infoRider['type']) && is_array($infoRider['type'])) {
    for ($i = 0; $i < count($infoRider['type']); $i++) {
        error_log("i = " . $i);
        $typeM = $infoRider['type'][$i];
        $nomM = $infoRider['nom'][$i];
        $qte = $infoRider['quantite'][$i];

        $reqB = $bdd->prepare('SELECT * FROM MATERIEL WHERE :nomM=nomM AND :typeM=typeM');
        $reqB->bindParam(":typeM", $typeM, PDO::PARAM_STR);
        $reqB->bindParam(":nomM", $nomM, PDO::PARAM_STR);
        $reqB->execute();
        $nu = $reqB->fetch();

        if ($nu === false) {
            $reqType = $bdd->prepare('INSERT INTO MATERIEL (nomM, typeM) VALUES (:nomM, :typeM)');
            $reqType->bindParam(":nomM", $nomM, PDO::PARAM_STR);
            $reqType->bindParam(":typeM", $typeM, PDO::PARAM_STR);
            $reqType->execute();
        }

        $reqId = $bdd->prepare('SELECT idM FROM MATERIEL WHERE :nomM=nomM AND :typeM=typeM');
        $reqId->bindParam(":typeM", $typeM, PDO::PARAM_STR);
        $reqId->bindParam(":nomM", $nomM, PDO::PARAM_STR);
        $reqId->execute();
        $idM = $reqId->fetch();
        $idM = $idM["idM"];

        error_log("\n\n" . $infoRider['besoin'][$i] . "\n\n");
        if ($infoRider['besoin'][$i] == 1) {
            $checkAvoirGroupe = $bdd->prepare('SELECT * FROM AVOIRGROUPE WHERE idM=:idM AND idG=:idG');
            $checkAvoirGroupe->bindParam(":idM", $idM, PDO::PARAM_STR);
            $checkAvoirGroupe->bindParam(":idG", $idG, PDO::PARAM_INT);
            $checkAvoirGroupe->execute();
            $existingAvoirGroupe = $checkAvoirGroupe->fetch();

            if ($existingAvoirGroupe) {
                $newQte = $existingAvoirGroupe['qte'] + $qte;
                $updateAvoirGroupe = $bdd->prepare('UPDATE AVOIRGROUPE SET qte=:qte WHERE idM=:idM AND idG=:idG');
                $updateAvoirGroupe->bindParam(":qte", $newQte, PDO::PARAM_INT);
                $updateAvoirGroupe->bindParam(":idM", $idM, PDO::PARAM_STR);
                $updateAvoirGroupe->bindParam(":idG", $idG, PDO::PARAM_INT);
                $updateAvoirGroupe->execute();
            } else {
                $reqInserAvoirGroupe = $bdd->prepare('INSERT INTO AVOIRGROUPE (idM, qte, idG) VALUES (:idM, :qte, :idG)');
                $reqInserAvoirGroupe->bindParam(":idM", $idM, PDO::PARAM_STR);
                $reqInserAvoirGroupe->bindParam(":qte", $qte, PDO::PARAM_INT);
                $reqInserAvoirGroupe->bindParam(":idG", $idG, PDO::PARAM_INT);
                $reqInserAvoirGroupe->execute();
            }
        }
        
        $checkBesoin = $bdd->prepare('SELECT nbBesoin FROM BESOIN WHERE idC=:idC AND idM=:idM');
        $checkBesoin->bindParam(":idC", $idC, PDO::PARAM_INT);
        $checkBesoin->bindParam(":idM", $idM, PDO::PARAM_INT);
        $checkBesoin->execute();
        $existingBesoin = $checkBesoin->fetch();

        if ($existingBesoin) {
            $newNbBesoin = $existingBesoin['nbBesoin'] + $qte;
            $updateBesoin = $bdd->prepare('UPDATE BESOIN SET nbBesoin=:nbBesoin WHERE idC=:idC AND idM=:idM');
            $updateBesoin->bindParam(":nbBesoin", $newNbBesoin, PDO::PARAM_INT);
            $updateBesoin->bindParam(":idC", $idC, PDO::PARAM_INT);
            $updateBesoin->bindParam(":idM", $idM, PDO::PARAM_INT);
            $updateBesoin->execute();
        } else {
            $insererBesoin = $bdd->prepare('INSERT INTO BESOIN (idC, idM, nbBesoin) VALUES (:idC, :idM, :nbBesoin)');
            $insererBesoin->bindParam(":idC", $idC, PDO::PARAM_INT);
            $insererBesoin->bindParam(":idM", $idM, PDO::PARAM_INT);
            $insererBesoin->bindParam(":nbBesoin", $qte, PDO::PARAM_INT);
            $insererBesoin->execute();
        }
    }
}

// redirection en fonction du type

$id = $_SESSION["idUser"];
$selectTypeById = $bdd->prepare('SELECT typeU FROM UTILISATEUR WHERE iden=:id');
$selectTypeById->bindParam(":id", $id, PDO::PARAM_STR);
$selectTypeById->execute();

$row = $selectTypeById->fetch();
$role = $row["typeU"];

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
        header("Location : /");
        exit;
}
?>