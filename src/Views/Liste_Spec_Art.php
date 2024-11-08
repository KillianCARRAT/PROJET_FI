<?php $title = 'Liste_Spec_Art';
$lesCSS = ["Table_Spec", "basPage", "cote"];
include 'head.php'; ?>

<body>
    <?php include "cote.php" ?>
    <main>
        <div class="main-liste-spec">
            <h1 id="les-specs-orga">Vos spectacles</h1>
            <table id="table-spec">
                <thead>
                    <tr>
                        <th scope="col">Date</th>
                        <th scope="col">Heure</th>
                        <th scope="col">Durée</th>
                        <th scope="col">Salle</th>
                        <th scope="col">Fiche rider</th>
                        <th scope="col">Fiche plan feu</th>
                    </tr>
                </thead>
                <?php $reponse = $bdd->query('SELECT * FROM CONCERT NATURAL JOIN SALLE where idG='.$idArt);
                while ($donnees = $reponse->fetch()) {
                ?>
                    <tbody>
                        <tr>
                            <td><?php echo $donnees['dateCo']; ?></td>
                            <td><?php echo $donnees['debutConcert']; ?></td>
                            <td><?php echo $donnees['dureeConcert']; ?></td>
                            <td><?php echo $donnees['nomS']; ?></td>
                            <td><a href="src/Views/rider.php">Fiche rider</a></td>
                            <td>Plan feu</td>
                        </tr>
                    </tbody>
                <?php
                }
                $reponse->closeCursor();
                ?>
            </table>
        </div>
    </main>
    <?php include "basPage.php"; ?>
</body>

</html>