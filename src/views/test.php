<?php $title = 'Liste_Spec_Orga';
$lesCSS = ["Table_Spec", "basPage", "cote"];
require_once 'head.php'; ?>

<body>
    <main>
        <?php
        $idUser = "o2230";
        $reqType = $bdd->prepare('SELECT idG, type FROM LIEN NATURAL JOIN UTILISATEUR WHERE iden=:id');
        $reqType->bindParam(":id", $idUser, PDO::PARAM_STR);
        $reqType->execute();

        $role = $reqType->fetchAll();
        print_r($role)
            ?>
    </main>
    <?php require_once "basPage.php" ?>
</body>
</html>
