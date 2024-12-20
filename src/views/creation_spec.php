<?php
$lesCSS = ["listeSalleDispo", "basPage", "cote"];
require_once 'head.php';
require_once "cote.php";


$date = $_POST["date"];
$heure = $_POST["heure"];
$nomG = $_POST["nom"];
$nomS = $_POST["nomS"];
$duree = $_POST["duree"];
$arrive = $_POST["arrive"];


$execution = $bdd->prepare("Select idG from GROUPE where nomG=:nomG");
$execution->bindParam(':nomG', $nomG, PDO::PARAM_STR);
$execution->execute();
$idG = $execution->fetchColumn();

$execution = $bdd->prepare("Select idS from SALLE where nomS=:nomS");
$execution->bindParam(':nomS', $nomS, PDO::PARAM_STR);
$execution->execute();
$idS = $execution->fetchColumn();

$idma = $bdd->prepare("SELECT MAX(idC) FROM CONCERT");
$idma->execute();
$idF = $idma->fetch();
$idC = $idF[0] + 1;



try {
    $execution = $bdd->prepare("INSERT INTO CONCERT(idC, dateC,heureArrive, debutConcert,dureeConcert, idG, idS) VALUES (:idC, :dateC,:arrive, :heure,:duree, :idG, :idS)");
    $execution->bindParam(':idC', $idC, PDO::PARAM_STR);
    $execution->bindParam(':dateC', $date, PDO::PARAM_STR);
    $execution->bindParam(':heure', $heure, PDO::PARAM_STR);
    $execution->bindParam(':idG', $idG, PDO::PARAM_STR);
    $execution->bindParam(':idS', $idS, PDO::PARAM_STR);
    $execution->bindParam(':duree', $duree, PDO::PARAM_STR);
    $execution->bindParam(':arrive', $arrive, PDO::PARAM_STR);
    $execution->execute();
} catch (PDOException $e) {
    $_SESSION["erreur_Creation_Spectacle"] = $e;
    header("Location: erreur_Creation_Spectacle");
}


?>

<h1 id="texte">Le spectacle a été créé avec succès</h1>
<form method="POST" action="Ac_Orga">
    <button id="bouton" type="submit">Retourner à la liste des concerts</button>
</form>

<?php require_once "bas.php"; ?>