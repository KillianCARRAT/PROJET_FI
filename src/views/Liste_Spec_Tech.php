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
                        <th scope="col">Heure</th>
                        <th scope="col">Durée</th>
                        <th scope="col">Salle</th>
                        <th scope="col">Atiste</th>
                        <th scope="col">Fiche rider</th>
                        <th scope="col">Fiche plan feu</th>
                    </tr>
                </thead>
                <?php $reponse = $bdd->query('SELECT * FROM CONCERT NATURAL JOIN SALLE NATURAL JOIN GROUPE');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $donnees['dateC']; ?></td>
                            <td><?php echo $donnees['debutConcert']; ?></td>
                            <td><?php echo $donnees['dureeConcert']; ?></td>
                            <td><?php echo $donnees['nomS']; ?></td>
                            <td><?php echo $donnees['nomG']; ?></td>
<<<<<<< HEAD:src/Views/Liste_Spec_Tech.php

                            <td><a href="rider?concert=<?php echo $donnees['idC']; ?>">Fiche rider</a></td>
=======
                            <td><a href="rider">Fiche rider</a></td>
>>>>>>> baf3f50ad0131098c1ef02f699ca82c305e7ac4c:src/views/Liste_Spec_Tech.php
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
    <?php include "basPage.php" ?>
</body>

</html>