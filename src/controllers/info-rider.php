<?php
$bdd = $_SESSION["bd"];

// DIV GAUCHE

$nom = $_POST["nom"];
$date = $_POST["date"];
$demandeP = $_POST["demandeP"];

$checkVehicule = $_POST["vehicule"];
$checkHotel = $_POST["hotel"];

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

// DIV DROITE

$infoRider = array_filter($_POST, 'is_array');

for($i = 0; $i <count($infoRider); ++$i) {

    $typeM = $infoRider['type'][0];
    $nomM = $infoRider['nom'][0];
    $qte = $infoRider['quantite'][0];

    if($infoRider['besoin'] = 1) {

        $reqType = $bdd->prepare('INSERT INTO MATERIEL VALUES (:nomM, :typeM, :idG, null, null)');
        $reqType->bindParam(":typeM", $typeM, PDO::PARAM_STR);
        $reqType->bindParam(":nomM", $nomM, PDO::PARAM_STR);
        $reqType->bindParam(":qte", $qte, PDO::PARAM_STR);
        $reqType->bindParam(":idG", $idG, PDO::PARAM_STR);
        $reqType->execute();

    } else {

        $reqB = $bdd->prepare('SELECT qte FROM MATERIEL WHERE :nomM=nomM AND :typeM=typeM');
        $reqB->bindParam(":typeM", $typeM, PDO::PARAM_STR);
        $reqB->bindParam(":nomM", $nomM, PDO::PARAM_STR);
        $reqB->execute();
        $qteMat = $reqB->fetch();

        if ($qteMat > $qte) {
            $qteAjoute = $qte-$qteMat;

            $reqType = $bdd->prepare('INSERT INTO MATERIEL VALUES (:nomM, :typeM, null, null, null)');
            $reqType->bindParam(":nomM", $nomM, PDO::PARAM_STR);
            $reqType->bindParam(":typeM", $typeM, PDO::PARAM_STR);
            $reqType->execute();

            $reqType = $bdd->prepare('SELECT idM FROM MATERIEL WHERE nomM=:nomM');
            $reqType->bindParam(":nomM", $nomM, PDO::PARAM_STR);
            $reqType->execute();
            $idM = $reqType->fetch();

            $reqType = $bdd->prepare('INSERT INTO BESOIN VALUES (:idC, :idM, :nbBesoin)');
            $reqType->bindParam(":idC", $idC, PDO::PARAM_STR);
            $reqType->bindParam(":idM", $idM, PDO::PARAM_STR);
            $reqType->bindParam(":nbBesoin", $qteAjoute, PDO::PARAM_STR);
            $reqType->execute();
        }
    }
}
// redirection en fonction du type

$id = $_SESSION["idUser"];
$reqType = $bdd->prepare('SELECT typeU FROM UTILISATEUR WHERE iden=:id');
$reqType->bindParam(":id", $id, PDO::PARAM_STR);
$reqType->execute();

$row = $reqType->fetch();
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
