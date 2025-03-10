<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>/public/assets/css/connexion.css">
    <title>Connexion Concert'asso</title>
</head>

<body>
    <div class="header">
        <a href="http://www.undouadejazz.com">Retour</a>
        <h1>Concert'asso</h1>
    </div>
    <div class="content">

        <form class="connexion" method="POST" action="<?php CONTROLLERS_PATH; ?>/tentative_co">
            <p>CONNEXION</p>
            <input type="text" name="ident" id="ident" placeholder="Identifiant*" />
            <input type="password" name="passwd" id="passwd" placeholder="Mot de passe" />
            <button type="button" name="toggle-password" id="toggle-password" class="toggle-password"
                data-target="passwd">afficher</button>
            <p id="informations">* reçu par mail si vous êtes un artiste</p>
            <?php
            if (!empty($_SESSION['connexion_fail'])) {
                $_SESSION['connexion_fail'] = false;
                echo "<p class='fail'>L'identifiant ou le mot de passe est incorrect</p>";
            } ?>
            <input class="btn-connexion" type="submit" value="Se connecter" />
        </form>
        <aside>
            <img src="<?= BASE_URL; ?>/public/assets/img/logo_doua.png" alt="logo de l'association un doua de jazz" />
            <img src="<?= BASE_URL; ?>/public/assets/img/logo_insa.png" alt="logo de l'insa" />
        </aside>
    </div>
    <?php
    $lesJS = ["connexion"];
    require_once 'script.php';
    ?>
</body>
</html>
