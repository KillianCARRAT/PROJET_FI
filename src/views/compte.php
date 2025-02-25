<?php 
session_start();
$id_cpt = $_SESSION['idUser'];
$title = 'Compte';
$lesCSS = ["basPage", "cote", "compte", "compte_asso"];
require_once 'head.php';

$idUser = $_SESSION["idUser"];
$reqType = $bdd->prepare('SELECT typeU FROM UTILISATEUR WHERE iden=:id');
$reqType->bindParam(":id", $idUser, PDO::PARAM_STR);
$reqType->execute();
$tout = $reqType->fetchAll();
$role = $tout[0][0];
?>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['action']) && $_POST['action'] === 'modifier_identifiant') {
    $nouvelIdUser = $_POST['idUser'];
    $nouveauNomG = $_POST['nomG'];
    $nouveauMail = $_POST['mail'];
    $nouveauNbTechG = $_POST['nbTechG'];
    $nouveauNbPersG = $_POST['nbPersG'];
    $ancienIdUser = $_SESSION['idUser'];

    // Vérifier si l'identifiant existe déjà
    $reqCheck = $bdd->prepare('SELECT COUNT(*) FROM UTILISATEUR WHERE iden = :nouvelId');
    $reqCheck->bindParam(':nouvelId', $nouvelIdUser, PDO::PARAM_STR);
    $reqCheck->execute();
    $count = $reqCheck->fetchColumn();

    if ($count > 0) {
        // L'identifiant existe déjà, afficher un message d'erreur
        echo "<script>alert('L\'identifiant existe déjà. Veuillez en choisir un autre.');</script>";
    } else {
        // Récupérer l'ID du groupe
        $reqGetIdG = $bdd->prepare('SELECT idG FROM LIEN WHERE iden = :ancienId');
        $reqGetIdG->bindParam(':ancienId', $ancienIdUser, PDO::PARAM_STR);
        $reqGetIdG->execute();
        $idG = $reqGetIdG->fetchColumn();

        // Supprimer la ligne dans la table LIEN
        $reqDeleteLien = $bdd->prepare('DELETE FROM LIEN WHERE iden = :ancienId');
        $reqDeleteLien->bindParam(':ancienId', $ancienIdUser, PDO::PARAM_STR);
        $reqDeleteLien->execute();

        // Mettre à jour l'identifiant dans la table UTILISATEUR
        $reqUpdate = $bdd->prepare('UPDATE UTILISATEUR SET iden = :nouvelId WHERE iden = :ancienId');
        $reqUpdate->bindParam(':nouvelId', $nouvelIdUser, PDO::PARAM_STR);
        $reqUpdate->bindParam(':ancienId', $ancienIdUser, PDO::PARAM_STR);
        $reqUpdate->execute();

        // Recréer la ligne dans la table LIEN avec le nouvel identifiant
        $reqInsertLien = $bdd->prepare('INSERT INTO LIEN (idG, iden) VALUES (:idG, :nouvelId)');
        $reqInsertLien->bindParam(':idG', $idG, PDO::PARAM_INT);
        $reqInsertLien->bindParam(':nouvelId', $nouvelIdUser, PDO::PARAM_STR);
        $reqInsertLien->execute();

        // Mettre à jour les informations du groupe
        $reqUpdateGroupe = $bdd->prepare('UPDATE GROUPE SET nomG = :nouveauNomG, mail = :nouveauMail, nbTechG = :nouveauNbTechG, nbPersG = :nouveauNbPersG WHERE idG = :idG');
        $reqUpdateGroupe->bindParam(':nouveauNomG', $nouveauNomG, PDO::PARAM_STR);
        $reqUpdateGroupe->bindParam(':nouveauMail', $nouveauMail, PDO::PARAM_STR);
        $reqUpdateGroupe->bindParam(':nouveauNbTechG', $nouveauNbTechG, PDO::PARAM_INT);
        $reqUpdateGroupe->bindParam(':nouveauNbPersG', $nouveauNbPersG, PDO::PARAM_INT);
        $reqUpdateGroupe->bindParam(':idG', $idG, PDO::PARAM_INT);
        $reqUpdateGroupe->execute();

        $_SESSION['idUser'] = $nouvelIdUser;

        header('Location: ' . $_SERVER['REQUEST_URI']);
        exit();
    }
}
?>

<body>
    <?php require_once "cote.php"; ?>
    <main>
        <?php
        if ($role == "ART") {
            $reqId = $bdd->prepare('SELECT idG FROM LIEN NATURAL JOIN UTILISATEUR WHERE iden=:id');
            $reqId->bindParam(":id", $idUser, PDO::PARAM_STR);
            $reqId->execute();
            $IdG = $reqId->fetchAll();
            $idArt = $IdG[0][0];
            $reqArt = $bdd->prepare('SELECT * FROM GROUPE WHERE idG=:id');
            $reqArt->bindParam(":id", $idArt, PDO::PARAM_STR);
            $reqArt->execute();
            $toutArt = $reqArt->fetchAll();
            $donnees = $toutArt[0];
            ?>
            <div id="info-compte">
                <div id="affichage-identifiant">
                    <p>
                        Identifiant : <?php echo $idUser; ?><br>
                        Nom du groupe : <?php echo $donnees['nomG']; ?><br>
                        Mail : <?php echo $donnees['mail']; ?><br>
                        Nombre de technicien : <?php echo $donnees['nbTechG']; ?><br>
                        Nombre de personne dans le groupe : <?php echo $donnees['nbPersG']; ?><br>
                    </p>
                    <input type="button" id="Modifier" value="Modifier" />
                </div>
                <div id="edition-identifiant" style="display:none;">
                    <form method="POST" action="">
                        <p>
                            Identifiant : <input type="text" name="idUser" value="<?php echo $idUser; ?>"><br>
                            Nom du groupe : <input type="text" name="nomG" value="<?php echo $donnees['nomG']; ?>"><br>
                            Mail : <input type="text" name="mail" value="<?php echo $donnees['mail']; ?>"><br>
                            Nombre de technicien : <input type="number" name="nbTechG" value="<?php echo $donnees['nbTechG']; ?>"><br>
                            Nombre de personne dans le groupe : <input type="number" name="nbPersG" value="<?php echo $donnees['nbPersG']; ?>"><br>
                        </p>
                        <input type="hidden" name="action" value="modifier_identifiant">
                        <input type="button" id="Retour" value="Retour" />
                        <input type="submit" id="Confirmer" value="Confirmer" />
                    </form>
                </div>
            </div>
            <?php
        } elseif ($role == "ORG" || $role == "TEC") {
            ?>
            <div id="info-compte">
                <div id="affichage-identifiant">
                    <p>
                        Identifiant : <?php echo $idUser; ?><br>
                    </p>
                    <input type="button" id="Modifier" value="Modifier" />
                </div>
                <div id="edition-identifiant" style="display:none;">
                    <form method="POST" action="">
                        <p>
                            Identifiant : <input type="text" name="idUser" value="<?php echo $idUser; ?>"><br>
                        </p>
                        <input type="hidden" name="action" value="modifier_identifiant">
                        <input type="button" id="Retour" value="Retour" />
                        <input type="submit" id="Confirmer" value="Confirmer" />
                    </form>
                </div>
            </div>
            <?php
        }
        ?>
        <form id="ChangementDeMotDePasse" method="POST" action="<?php VIEWS_PATH; ?>/Cmdp">
            <input type="submit" value="Changer de mot de passe" />
        </form>
    </main>
    <?php require_once "basPage.php"; ?>
</body>
<script>
document.getElementById('Modifier').addEventListener('click', function() {
    document.getElementById('affichage-identifiant').style.display = 'none';
    document.getElementById('edition-identifiant').style.display = 'block';
});

document.getElementById('Retour').addEventListener('click', function() {
    document.getElementById('affichage-identifiant').style.display = 'block';
    document.getElementById('edition-identifiant').style.display = 'none';
});
</script>
</html>