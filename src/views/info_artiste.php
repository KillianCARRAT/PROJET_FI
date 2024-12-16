<?php $title = 'artiste';
$lesCSS = ["info_art", "basPage", "cote"];
include 'head.php'; ?>

<body>
    <?php include "cote.php" ?>
    
    <main>
        <h1><?php echo $reponse['nomG']; ?></h1>

        <section>
            <div id="Infos">
                <div class="duo">
                    <p class="fix">Nom du groupe : </p>
                    <p class="rep"><?php echo $reponse["nomG"]; ?></p>
                </div>
                <div class="duo">
                    <p class="fix">Nombre de membres : </p>
                    <p class="rep"><?php echo $reponse["nbPersG"]; ?></p>
                </div>
                <div class="duo">
                    <p class="fix">Identifiant :</p>
                    <p class="rep"><?php $_SESSION["$idUser"]; ?></p>
                </div>
                <div class="duo">
                    <p class="fix">Mot de passe :</p>
                    <p class="rep"><?php $_SESSION["$mdpUser"]; ?></p>
                </div>

            </div>
            <table id="spectacle">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Salle</th>
                        <th scope="col">Fiche rider</th>
                        <th scope="col">Fiche plan feu</th>
                        <th scope="col">Suprimer le spectacle</th>
                    </tr>
                </thead>
                <?php while ($donnees = $reponse->fetch()) {
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $donnees['dateC']; ?></td>
                            <td><?php echo $donnees['nomS']; ?></td>
                            <td>$Telecharger fiche rider</td>
                            <td>$Telecharger plan feu</td>
                            <td style="text-align:center;" class="image"><img src="../../public/assets/img/supr.png"
                                    alt="Suprimer le spectacle"></td>
                        </tr>
                    </tbody>
                    <?php
                }
                $reponse->closeCursor();
                ?>
            </table>
        </section>
    </main>
    <?php include "basPage.php" ?>
</body>

</html>