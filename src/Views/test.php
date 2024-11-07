<?php $title = 'Liste_Spec_Orga';
$lesCSS = ["Table_Spec", "basPage", "cote"];
include 'head.php'; ?>
<body>
    <main>
        <?php

        $reponse = $bdd->query('SELECT * FROM SALLE');

        while ($donnees = $reponse->fetch()) {
        ?>
            <p>

                <strong>Jeu</strong> : <?php echo $donnees['idS']; ?><br/>
            </p>
        <?php
        }
        $reponse->closeCursor(); // Termine le traitement de la requête
        ?>
    </main>
    <?php include "basPage.php" ?>
</body>
</html>