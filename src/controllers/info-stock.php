<?php
use src\controllers\Database;
$bdd = Database::getConnection();

$infoStock = array_filter($_POST, 'is_array');

$bdd->exec('DELETE FROM MATERIEL WHERE qteAsso IS NOT NULL');

if (isset($infoStock['type']) && is_array($infoStock['type'])) {
    for ($i = 0; $i < count($infoStock['type']); $i++) {
        $typeM = $infoStock['type'][$i];
        $nomM = $infoStock['nom'][$i];
        $qte = $infoStock['quantite'][$i];

        $reqB = $bdd->prepare('SELECT * FROM MATERIEL WHERE nomM=:nomM AND typeM=:typeM');
        $reqB->bindParam(":typeM", $typeM, PDO::PARAM_STR);
        $reqB->bindParam(":nomM", $nomM, PDO::PARAM_STR);
        $reqB->execute();
        $nu = $reqB->fetch();

        if ($nu === false) {
            $reqType = $bdd->prepare('INSERT INTO MATERIEL (nomM, typeM, qteAsso) VALUES (:nomM, :typeM, :qteAsso)');
            $reqType->bindParam(":nomM", $nomM, PDO::PARAM_STR);
            $reqType->bindParam(":typeM", $typeM, PDO::PARAM_STR);
            $reqType->bindParam(":qteAsso", $qte, PDO::PARAM_INT);
            $reqType->execute();
        }
    }
}

header('Location: /Stock_Mat');
