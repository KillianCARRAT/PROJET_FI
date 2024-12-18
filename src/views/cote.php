<aside id="aside-tout">
    <div>
        <?php
        session_start();

        $idUser = $_SESSION["idUser"];
        $reqType = $bdd->prepare('SELECT typeU FROM UTILISATEUR WHERE iden=:id');
        $reqType->bindParam(":id", $idUser, PDO::PARAM_STR);
        $reqType->execute();
        $tout = $reqType->fetchAll();
        $role = $tout[0][0];

        /* Affichage ASIDE de l'art*/
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
            <h1 id="cote"><?php echo $toutArt[0][1] ?><a href="/Compte"><img
                        src="<?= BASE_URL; ?>/public/assets/img/cpt.png" alt="Logo compte"></a></h1>
            <p><a href="/Ac_Art">Vos spectacles</a></p>
            <?php
        }

        /* Affichage ASIDE de l'asso tech*/ elseif ($role == "TEC") {
            ?>
            <h1 id="cote">Asso Technique<a href="/Compte"><img src="<?= BASE_URL; ?>/public/assets/img/cpt.png"
                        alt="Logo compte"></a></h1>
            <div id="corp-aside">
                <p><a href="/Ac_Tech">Les spectacles</a></p>
            </div>
            <?php
        }

        /* Affichage ASIDE de l'asso orga*/ elseif ($role == "ORG") {
            ?>
            <h1 id="cote">Asso Organisatrice<a href="/Compte"><img src="<?= BASE_URL; ?>/public/assets/img/cpt.png"
                        alt="Logo compte"></a></h1>
            <?php
            echo "<p class = 'menu'><a href='/Ac_Orga'>Les spectacles</a></p>";
            echo "<p class = 'menu'><a href='/Create_Spec'>Organiser un nouveau spectacle</a></p>";
            echo "<p class = 'menu'><a href='/Create_ART'>Créé un nouvelle artiste</a></p>";
            echo "<p class = 'menu'><a href='/Create_Salle'>Créé une nouvelle salle</a></p>";

        }
        ?>
        <form id="deco" method="POST" action="<?php CONTROLLERS_PATH; ?>/deconnexion">
            <input type="submit" value="Se déconnecter" />
        </form>
    </div>
</aside>