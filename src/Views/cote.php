<aside>
        <div id="aside-tout">

                <?php
                session_start();
                $idUser = $_SESSION["idUser"];
                $reqType = $bdd->prepare('SELECT idG, type FROM LIEN NATURAL JOIN UTILISATEUR WHERE iden=:id');
                $reqType->bindParam(":id", $idUser, PDO::PARAM_STR);
                $reqType->execute();

                $tout = $reqType->fetchAll();
                $role = $tout[0][1];

                if ($role == "ART") {
                        $idArt = $tout[0][0];
                        $reqArt = $bdd->prepare('SELECT * FROM GROUPE WHERE idG=:id');
                        $reqType->bindParam(":id", $idArt, PDO::PARAM_STR);
                        $reqType->execute();
                        $toutArt = $reqType->fetchAll();
                        ?>
                        <h1><?php $toutArt[0][1] ?></h1>
                        <p><a href="src/Views/Liste_Spec_Art.php">Vos spectacles</a></p>
                        <?php
                } ?>
                <button id='deco'>Se déconnecter</button>
        </div>
</aside>