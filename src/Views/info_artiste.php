<?php $title = 'artiste';
$lesCSS = ["info_artiste", "basPage", "cote"];
include 'head.php'; ?>

<body>
    <?php include "cote.php" ?>
    <main>
        <h1>$nomartiste</h1>
        <section>
            <div id="Infos">
                <div class="duo">
                    <p class="fix">Nom du groupe : </p>
                    <p class="rep">$nomartiste</p>
                </div>
                <div class="duo">
                    <p class="fix">Nombre de membres : </p>
                    <p class="rep">$nbPersonne</p>
                </div>
                <div class="duo">
                    <p class="fix">Identifiant</p>
                    <p class="rep">$idartiste</p>
                </div>
                <div class="duo">
                    <p class="fix">Mot de passe</p>
                    <p class="rep">$mdpArtiste</p>
                </div>

            </div>
            <table id="spectacle">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Salle</th>
                        <th scope="col">Fiche rider</th>
                        <th scope="col">Fiche plan feu</th>
                        <th scope="col">Suprimer le spéctacle</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$Date spectacle</td>
                        <td>$Nom salle</td>
                        <td>$Telecharger fiche rider</td>
                        <td>$Telecharger plan feu</td>
                        <td style="text-align:center;" class="image"><img src="../../public/assets/img/supr.png" alt="Suprimer le spectacle"></td>
                    </tr>
                    <tr>
                        <td>02/02/2002</td>
                        <td>Trill'Sall</td>
                        <td>Manquante ( Avant le 02/01/2002)</td>
                        <td>$Consulter</td>
                        <td style="text-align:center;" class="image"><img src="../../public/assets/img/supr.png" alt="Suprimer le spectacle"></td>
                    </tr>
                    <tr>
                        <td>02/02/2002</td>
                        <td>Toî Toî</td>
                        <td>$Consulter</td>
                        <td>$Consulter</td>
                        <td style="text-align:center;" class="image"><img src="../../public/assets/img/supr.png" alt="Suprimer le spectacle"></td>
                    </tr>
                </tbody>
            </table>

        </section>
    </main>
    <?php include "basPage.php" ?>
</body>

</html>