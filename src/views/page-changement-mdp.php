<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>/public/assets/css/page-changement-mdp.css">
    <title>Changer mot de passe - Concert'asso</title>
</head>

<body>
    <div class="header">
        <?php if ($_POST["admin"] == "tr") { ?>
            <a href="/List_asso">Retour</a>
        <?php } else { ?>
            <a href="/Compte">Retour</a>
        <?php } ?>
        <h1>Concert'asso</h1>
    </div>
    <?php
    $mdp_bool = $_SESSION["mdp-bool"];
    $showPopup = false;

    if ($mdp_bool == "reussi") {
        $showPopup = true;
        $_SESSION["mdp-bool"] = null;
    }
    if ($showPopup) { ?>
        <div id="popup" class="popup show">
            <div class="popup-content">
                <p>Changement de mot de passe confirmé !</p>
                <input type="submit" id="popup-ok" value="Se connecter" onclick="window.location.href='/';" />
            </div>
        </div>
    <?php } ?>
    <form class="change_mdp" method="POST" action="/changement_mdp">
        <p>Veuillez changer de mot de passe</p>
        <div class="password-container">
            <?php
            if ($_POST["admin"] == "tr") {
                $id = $_POST["id"];
            } else {
                $id = $_SESSION["idUser"];
            } ?>
            <input type="hidden" id="ident" name="ident" value="<?php echo $id; ?>">
            <div id="zone-password">
                <input type="password" id="new-passwd" name="new-passwd" placeholder="Nouveau mot de passe" />
                <input type="password" id="confirm-passwd" name="confirm-passwd" placeholder="Confirmer mot de passe" />
                <button type="button" id="toggle-all-passwords" class="toggle-password">Afficher</button>
            </div>
        </div>
        <p id="informations">* : l’utilisation de mot de passe fort est conseillée (majuscule, chiffre, caractère spéciaux, etc.)</p>
        <?php
        if ($mdp_bool == "meme") { ?>
            <p class="rate">Vous ne pouvez pas utiliser le même mot de passe que l'actuel</p>
        <?php } elseif ($mdp_bool == "diff") { ?>
            <p class="rate">Les champs 'Mot de passe' et 'Confirmation' doivent être identiques</p>
        <?php } elseif ($mdp_bool == "vide") { ?>
            <p class="rate">Les champs doivent être remplis</p>
        <?php } ?>
        <input type="submit" value="Changer de mot de passe" />
    </form>
    <?php
    $lesJS = ["changementMDP"];
    require_once 'script.php';
    ?>
</body>
</html>