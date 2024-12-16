<aside>
    <div id="aside-tout">
        <?php
        session_start();
        $idUser = $_SESSION["idUser"];
        $reqType = $bdd->prepare('SELECT type FROM UTILISATEUR WHERE iden=:id');
        $reqType->bindParam(":id", $idUser, PDO::PARAM_STR);
        $reqType->execute();

        $tout = $reqType->fetchAll();
        $role = $tout[0][0];
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
            <h1><?php echo $toutArt[0][1] ?></h1>
            <p><a href="/Ac_Art">Vos spectacles</a></p>
            <?php
        } elseif (($role == "TEC") || ($role == "ORG")) {
            ?>
            <h1>Asso Technique</h1>
            <p><a href="/Ac_Tech">Les spectacles</a></p>
            <?php
        }
        ?>
        <form class="deco" method="POST" action="<?php CONTROLLERS_PATH; ?>/deconnexion">
        <input type="submit" value="Se déconnecter" />
        </form>
    </div>
</aside>