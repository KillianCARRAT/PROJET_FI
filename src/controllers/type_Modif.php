<?php
use src\controllers\Database;
$bdd = Database::getConnection();

$infoStock = array_filter($_POST, 'is_array');

$bdd->exec('DELETE FROM TYPEM');

if (isset($infoStock['type']) && is_array($infoStock['type'])) {
    for ($i = 0; $i < count($infoStock['type']); $i++) {
        $typeM = $infoStock['type'][$i];
        $color = $infoStock['color'][$i];

        $reqType = $bdd->prepare('INSERT INTO TYPEM (color, typeM) VALUES (:color, :typeM)');
        $reqType->bindParam(":color", $color, PDO::PARAM_STR);
        $reqType->bindParam(":typeM", $typeM, PDO::PARAM_STR);
        $reqType->execute();
        }
    }

header('Location: /Stock_Mat');
