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

$updateConcert = $bdd->prepare('UPDATE CONCERT SET besoinTransport=:bTransport, besoinHotel=:bHotel WHERE idC=:idC');
$updateConcert->bindParam("bTransport", $adresseV, PDO::PARAM_STR);
$updateConcert->bindParam("bHotel", $demandeH, PDO::PARAM_STR);
$updateConcert->bindParam("idC", $idC, PDO::PARAM_INT);
$updateConcert->execute();

// DIV DROITE

$infoRider = array_filter($_POST, 'is_array');

if (isset($infoRider['type']) && is_array($infoRider['type'])) {
    for ($i = 0; $i < count($infoRider['type']); $i++) {
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

        if ($infoRider['besoin'][$i] == 1) {
            $reqInserAvoirGroupe = $bdd->prepare('INSERT INTO AVOIRGROUPE (idM, qte, idG) VALUES (:idM, :qte, :idG)');
            $reqInserAvoirGroupe->bindParam(":idM", $idM, PDO::PARAM_STR);
            $reqInserAvoirGroupe->bindParam(":qte", $qte, PDO::PARAM_INT);
            $reqInserAvoirGroupe->bindParam(":idG", $idG, PDO::PARAM_INT);
            $reqInserAvoirGroupe->execute();
        }

        $insererBesoin = $bdd->prepare('INSERT INTO BESOIN (idC, idM, nbBesoin) VALUES (:idC, :idM, :nbBesoin)');
        $insererBesoin->bindParam(":idC", $idC, PDO::PARAM_INT);
        $insererBesoin->bindParam(":idM", $idM, PDO::PARAM_INT);
        $insererBesoin->bindParam(":nbBesoin", $qte, PDO::PARAM_INT);
        $insererBesoin->execute();
    }
} else {
    echo "Le tableau 'type' n'existe pas ou n'est pas un tableau.";
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
