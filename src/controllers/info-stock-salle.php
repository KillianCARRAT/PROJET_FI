<?php
use src\controllers\Database;
$bdd = Database::getConnection();

$idS = $_POST['idS'];
error_log("\n\n idS = " . $idS . "\n\n");

$infoStock = array_filter($_POST, 'is_array');
error_log("\n\n infoStock = " . print_r($infoStock, true) . "\n\n");

$prepareDelete = $bdd->prepare('DELETE FROM AVOIRSALLE WHERE idS = :idS');
$prepareDelete->bindParam(":idS", $idS, PDO::PARAM_INT);
$prepareDelete->execute();

if (isset($infoStock['type']) && is_array($infoStock['type'])) {
    for ($i = 0; $i < count($infoStock['type']); $i++) {
        $typeM = $infoStock['type'][$i];
        $nomM = $infoStock['nom'][$i];
        $qte = $infoStock['quantite'][$i];

        error_log("Processing: typeM = $typeM, nomM = $nomM, qte = $qte");

        $reqB = $bdd->prepare('SELECT * FROM MATERIEL WHERE nomM=:nomM AND typeM=:typeM');
        $reqB->bindParam(":typeM", $typeM, PDO::PARAM_STR);
        $reqB->bindParam(":nomM", $nomM, PDO::PARAM_STR);
        $reqB->execute();

        $result = $reqB->fetch(PDO::FETCH_ASSOC);

        if (!$result) {
            $insertMateriel = $bdd->prepare('INSERT INTO MATERIEL (nomM, typeM) VALUES (:nomM, :typeM)');
            $insertMateriel->bindParam(":nomM", $nomM, PDO::PARAM_STR);
            $insertMateriel->bindParam(":typeM", $typeM, PDO::PARAM_STR);
            $insertMateriel->execute();

            $idM = $bdd->lastInsertId();
        } else {
            $idM = $result['idM'];
        }

        // Vérifier si le matériel est déjà dans AVOIRSALLE
        $checkAvoirSalle = $bdd->prepare('SELECT * FROM AVOIRSALLE WHERE idS=:idS AND idM=:idM');
        $checkAvoirSalle->bindParam(":idS", $idS, PDO::PARAM_INT);
        $checkAvoirSalle->bindParam(":idM", $idM, PDO::PARAM_INT);
        $checkAvoirSalle->execute();

        $resultAvoirSalle = $checkAvoirSalle->fetch(PDO::FETCH_ASSOC);

        if ($resultAvoirSalle) {
            // Ajouter la nouvelle quantité à la quantité existante
            $newQte = $resultAvoirSalle['qte'] + $qte;
            $update = $bdd->prepare('UPDATE AVOIRSALLE SET qte=:qte WHERE idS=:idS AND idM=:idM');
            $update->bindParam(":qte", $newQte, PDO::PARAM_INT);
            $update->bindParam(":idS", $idS, PDO::PARAM_INT);
            $update->bindParam(":idM", $idM, PDO::PARAM_INT);
            if (!$update->execute()) {
                error_log("Error updating AVOIRSALLE: " . print_r($update->errorInfo(), true));
            }
        } else {
            // Insérer le matériel dans AVOIRSALLE
            $insert = $bdd->prepare('INSERT INTO AVOIRSALLE (idS, idM, qte) VALUES (:idS, :idM, :qte)');
            $insert->bindParam(":idS", $idS, PDO::PARAM_INT);
            $insert->bindParam(":idM", $idM, PDO::PARAM_INT);
            $insert->bindParam(":qte", $qte, PDO::PARAM_INT);
            if (!$insert->execute()) {
                error_log("Error inserting into AVOIRSALLE: " . print_r($insert->errorInfo(), true));
            }
        }
    }
}

header('Location: /Liste_S');
exit;
