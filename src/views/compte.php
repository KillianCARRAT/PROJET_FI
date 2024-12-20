<?php session_start();
$id_cpt = $_SESSION['idUser'];
$title = 'Compte';
$lesCSS = ["basPage", "cote", "compte"];
require_once 'head.php';

$idUser = $_SESSION["idUser"];
$reqType = $bdd->prepare('SELECT typeU FROM UTILISATEUR WHERE iden=:id');
$reqType->bindParam(":id", $idUser, PDO::PARAM_STR);
$reqType->execute();
$tout = $reqType->fetchAll();
$role = $tout[0][0]; ?>

<body>
    <?php require_once "cote.php" ?>
    <main><?php
    if ($role == "ART") {
        $reqId = $bdd->prepare('SELECT idG FROM LIEN NATURAL JOIN UTILISATEUR WHERE iden=:id');
        $reqId->bindParam(":id", $idUser, PDO::PARAM_STR);
        $reqId->execute();
        $IdG = $reqId->fetchAll();
        $idArt = $IdG[0][0];
        $reqArt = $bdd->prepare('SELECT * FROM GROUPE WHERE idG=:id');
        $reqArt->bindParam(":id", $idArt, PDO::PARAM_STR);
        $reqArt->execute();
        $toutArt = $reqArt->fetchAll();
        ?>

            <div id="info-compte">
                <?php $donnees = $toutArt[0]; ?>
                <p>
                    Identifiant : <?php echo $idUser; ?><br>
                    Nom du groupe : <?php echo $donnees['nomG']; ?><br>
                    Mail : <?php echo $donnees['mail']; ?><br>
                    Nombre de technicien : <?php echo $donnees['nbTechG']; ?><br>
                    Nombre de personne dans le groupe : <?php echo $donnees['nbPersG']; ?><br>
                </p>
            </div>
            <form id="Changement de mot de passe" method="POST" action="<?php VIEWS_PATH; ?>/Cmdp">
                <input type="submit" value="Changer son mot de passe" />
            </form>
            <form id="Modifier" method="POST" action="">
                <input type="submit" value="Modifier" />
            </form>


            <?php
    } elseif ($role == "ORG" || $role == "TEC") {
        ?>
            <div id="info-compte">
                <?php $donnees = $toutArt[0]; ?>
                <p>
                    Identifiant : <?php echo $idUser; ?><br>
                </p>
                <?php ?>
            </div>
            <form id="Changement de mot de passe" method="POST" action="<?php VIEWS_PATH; ?>/Cmdp">
                <input type="submit" value="Changer son mot de passe" />
            </form>
            <form id="Modifier" method="POST" action="">
                <input type="submit" value="Modifier" />
            </form>
        <?php }

    ?>
    </main>
    <?php require_once "basPage.php"; ?>
</body>

</html>
