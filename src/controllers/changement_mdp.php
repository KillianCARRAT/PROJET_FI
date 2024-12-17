<?php
    try {
        $bdd = new PDO('mysql:host=servinfo-maria;dbname=DBlepage', 'lepage', 'lepage');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    session_start();

    $id = $_POST['ident'];
    $new_mdp = $_POST['new-passwd'];
    $confirm_mdp = $_POST['confirm-passwd'];

    $reqType = $bdd->prepare('SELECT type, mdp FROM UTILISATEUR WHERE iden=:id');
    $reqType->bindParam(":id", $id, PDO::PARAM_STR);
    $reqType->execute();

    $role = $reqType->fetchColumn();
    $mdp = $reqType->fetchColumn(1);

    if ($new_mdp != $confirm_mdp) {
        header("Location: /rate-diff-mdp");
    } elseif($mdp == $new_mdp) {
        header("Location: /rate-meme-mdp");
    } else {
        $reqUpdateMDP = $bdd->prepare('UPDATE UTILISATEUR SET mdp=:mdp WHERE iden=:id AND mdp=:mdp');
        $reqUpdateMDP->bindParam(":id", $id, PDO::PARAM_STR);
        $reqUpdateMDP->bindParam(":mdp", $mdp, PDO::PARAM_STR);
        $reqUpdateMDP->execute();
        header("Location: /chan-mdp-reussi");
    }
?>