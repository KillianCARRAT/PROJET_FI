<?php try {
        $bdd = new PDO('mysql:host=servinfo-maria;dbname=DBlepage', 'lepage', 'lepage');
    } catch (Exception $e) {
        die('Erreur : ' . $e->getMessage());
    }

    session_start();

    $id = $_POST['ident'];
    $mdp = $_POST['passwd'];
    

    $reqType = $bdd->prepare('SELECT typeU, mdp FROM UTILISATEUR WHERE iden=:id');
    $reqType->bindParam(":id", $id, PDO::PARAM_STR);
    $reqType->execute();

    $row = $reqType->fetch();
    $role = $row["typeU"];
    $bd_mdp = $row["mdp"];

    $_SESSION["idUser"] = $id;

    error_log($role);
    if (password_verify($mdp, $bd_mdp)) {
        if ($role == "ART") {
            header('Location: Ac_Art');
            exit;
        } elseif ($role == "ORG") {
            header('Location: Ac_Orga');
            exit;
        } elseif ($role == "TEC") {
            header("Location: /Ac_Tech");
            exit;
        }
    } else {
        header("Location: /connexion_fail");
    }