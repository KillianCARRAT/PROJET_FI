<?php $title = 'Crea_ART';
$lesCSS = ["basPage", "cote", "valid-salle"];
require_once 'head.php';


$idma = $bdd->query('SELECT MAX(idS) FROM SALLE');

$idF = $idma->fetch();


$id = $idF[0] + 1;
$nom = $_POST["nom-Salle"];
$nbPlace = $_POST["nb_place"];
$typePlace = $_POST["typePlace"];
$adresse = $_POST["adresse"];
$largeur = $_POST["largeur"];
$Longeur = $_POST["Longeur"];
$nbT = $_POST["nb_Tec"];
$loges = $_POST["loges"];



$reqType = $bdd->prepare('INSERT INTO SALLE (idS, nomS, nbPlaceS, typePlaceS, adresseS, largeurS, longueurS, nbPlacesLo, nbTechS)
VALUES (:id, :nom, :nbPlace, :types, :adresse, :largeur, :longueur, :loges, :nbTec);');

$reqType->bindParam(":id", $id, PDO::PARAM_STR);
$reqType->bindParam(":nom", $nom, PDO::PARAM_STR);
$reqType->bindParam(":nbPlace", $nbPlace, PDO::PARAM_STR);
$reqType->bindParam(":types", $typePlace, PDO::PARAM_STR);
$reqType->bindParam(":adresse", $adresse, PDO::PARAM_STR);
$reqType->bindParam(":largeur", $largeur, PDO::PARAM_STR);
$reqType->bindParam(":longueur", $Longeur, PDO::PARAM_STR);
$reqType->bindParam(":loges", $loges, PDO::PARAM_STR);
$reqType->bindParam(":nbTec", $nbT, PDO::PARAM_STR);
$reqType->execute();

require_once 'head.php'; ?>

<body>
    <?php require_once "cote.php" ?>
    <main id="create-salle">
        <a href="/Ac_Orga">Retour</a>
        <div id="info-salle">
            <h1>La salle a été créé avec succés</h1>
        </div>
    </main>
    <?php require_once "basPage.php" ?>
</body>

</html>
