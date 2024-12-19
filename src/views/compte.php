<?php session_start();
$id_cpt = $_SESSION['idUser'];
$title = 'Compte';
$lesCSS = ["basPage", "cote", "compte"];
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
        $reqId = $bdd->prepare('SELECT idG FROM LIEN WHERE iden=:id');
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
                <p>
                    Identifiant :
                    Nom :
                    
                    
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
        $rec_user = $bdd->prepare('SELECT * FROM UTILISATEUR WHERE iden=:id');
        $rec_user->bindParam(":id", $idUser, PDO::PARAM_STR);
        $rec_user->execute();
    }

    ?>
    </main>
    <?php include "basPage.php"; ?>
</body>

</html>