<?php $title = 'Liste_Spec_Orga';
$lesCSS = ["Table_Spec", "basPage", "cote"];
require_once 'head.php'; ?>

<body>
    <?php require_once "cote.php" ?>
    <main>
        <?php
        try {
            $bdd = new PDO('mysql:host=servinfo-maria;dbname=DBmchesneau', 'mchesneau', 'mchesneau');
        } catch (Exception $e) {
            die('Erreur : ' . $e->getMessage());
        }
        ?>
        <table>
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
    </main>
    <?php require_once "basPage.php" ?>
</body>

</html>
