<?php
    try {
        $bdd = new PDO('mysql:host=servinfo-maria;dbname=DBlepage', 'lepage', 'lepage');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    $id = $_SESSION['idUser'];
    $new_mdp = $_POST['new-passwd'];
    $confirm_mdp = $_POST['confirm-passwd'];

    $reqType = $bdd->prepare('SELECT typeU, mdp FROM UTILISATEUR WHERE iden=:id');
    $reqType->bindParam(":id", $id, PDO::PARAM_STR);
    $reqType->execute();

    $row = $reqType->fetch();
    $role = $row["typeU"];
    $mdp = $row["mdp"];

    if ($new_mdp != $confirm_mdp) {
        header("Location: /rate-diff-mdp");
    } elseif(password_verify($new_mdp, $mdp)) {
        header("Location: /rate-meme-mdp");
    } else {
        $hash_mdp = password_hash($new_mdp, PASSWORD_DEFAULT);
        $reqUpdateMDP = $bdd->prepare('UPDATE UTILISATEUR SET mdp=:mdp WHERE iden=:id');
        $reqUpdateMDP->bindParam(":id", $id, PDO::PARAM_STR);
        $reqUpdateMDP->bindParam(":mdp", $hash_mdp, PDO::PARAM_STR);
        $reqUpdateMDP->execute();
        error_log("mdp change");
        header("Location: /chan-mdp-reussi");
    }
?>