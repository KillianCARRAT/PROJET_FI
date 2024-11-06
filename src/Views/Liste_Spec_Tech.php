<?php $title = 'Liste_Spec_Tech';
$lesCSS = ["Table_Spec", "basPage", "cote"];
include 'head.php'; ?>

<body>
    <?php include "cote.php" ?>
    <main>
        <div class="main-liste-spec">
            <h1 id="les-specs-orga">Les spectacles</h1>
            <table id="table-spec">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Salle</th>
                        <th scope="col">Atiste</th>
                        <th scope="col">Fiche rider</th>
                        <th scope="col">Fiche plan feu</th>
                        <th scope="col">Infos spectacles</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>$Date spectacle</td>
                        <td>$Nom salle</td>
                        <th scope="row">$Nom groupe</th>
                        <td>$Telecharger fiche rider</td>
                        <td>$Telecharger plan feu</td>
                        <td><a href="">$Infos spectacles</a></td>
                    </tr>
                    <tr>
                        <td>02/02/2002</td>
                        <td>Trill'Sall</td>
                        <th scope="row">Sax'O</th>
                        <td>Manquante ( Avant le 02/01/2002)</td>
                        <td>$Consulter</td>
                        <td><a href="">$Infos spectacles</a></td>
                    </tr>
                    <tr>
                        <td>02/02/2002</td>
                        <td>Toî Toî</td>
                        <th scope="row">Douag'By</th>
                        <td>$Consulter</td>
                        <td>$Consulter</td>
                        <td><a href="">$Infos spectacles</a></td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <?php include "basPage.php" ?>
</body>

</html>