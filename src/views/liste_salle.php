<?php $title = 'Liste_Spec_Orga';
$lesCSS = ["Table_Spec", "basPage", "cote"];
include 'head.php'; ?>

<body>
    <?php include "cote.php" ?>
    <main>
        <div class="main-liste-spec">
            <h1 id="les-specs-orga">Les salles</h1>
            <table id="table-spec">
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Nombre places</th>
                        <th scope="col">Nombre techniciens</th>
                        <th scope="col">Adresse</th>
                    </tr>
                </thead>

                <?php $reponse = $bdd->query('SELECT * FROM SALLE');
                while ($donnees = $reponse->fetch()) {
                    ?>
                    <tbody>
                        <tr>
                            <td><?php echo $donnees['nomS']; ?></td>
                            <td><?php echo $donnees['nbPlaceS']; ?></td>
                            <td><?php echo $donnees['nbTechS']; ?></td>
                            <td><?php echo $donnees['adresseS']; ?></td>
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