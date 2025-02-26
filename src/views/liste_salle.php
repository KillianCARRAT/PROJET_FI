<?php $title = 'Liste_Spec_Orga';
$lesCSS = ["Table_Spec", "basPage", "cote"];
require_once 'head.php'; ?>

<body>
    <?php require_once "cote.php" ?>
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
                        <th scope="col">Modifier</th>
                        <th scope="col">Ajouter matériel</th>
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
                            <td><a href="modifier_salle?id=<?php echo $donnees['idS']; ?>">Modifier</a></td>
                            <td><a href="materiel_salle?id=<?php echo $donnees['idS']; ?>">Ajouter matériel</a></td>
                        </tr>
                    </tbody>
                    <?php
                }
                $reponse->closeCursor();
                ?>
            </table>
        </div>
    </main>
    <?php require_once "basPage.php" ?>
</body>

</html>
