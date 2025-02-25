<?php
$bdd = $_SESSION["bd"];

// tant que ce controlleur ne renvoi pas vers une autre page avec les infos

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

// DIV GAUCHE (pratiquement fini)

$nom = $_POST["nom"];
$date = $_POST["date"];
$demandeP = $_POST["demandeP"];

error_log("\n\n");
error_log(print_r($nom));
error_log("\n\n");

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

// DIV DROITE (a faire : recuperation données; insertion BD; etc.)

?>
