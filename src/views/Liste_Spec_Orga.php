<?php $title = 'Liste_Spec_Orga';
$lesCSS = ["Table_Spec", "basPage", "cote"];
require_once 'head.php'; ?>

<body>
    <?php require_once "cote.php" ?>
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
                <?php $reponse = $bdd->query('SELECT * FROM CONCERT NATURAL JOIN SALLE NATURAL JOIN GROUPE order by(dateC)');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $donnees['dateC']; ?></td>
                            <td><?php echo date('H', strtotime($donnees['debutConcert'])) . "h" . date('i', strtotime($donnees['debutConcert'])); ?>
                            </td>
                            <td><?php echo date('H', strtotime($donnees['dureeConcert'])) . "h" . date('i', strtotime($donnees['dureeConcert'])); ?>
                            </td>
                            <td><?php echo $donnees['nomS']; ?></td>
                            <td><?php echo $donnees['nomG']; ?></td>
                            <td><a href="rider?concert=<?php echo $donnees['idC']; ?>">Fiche rider</a></td>
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
    <?php require_once "basPage.php"; ?>
</body>

</html>
