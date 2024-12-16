<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="/public/assets/css/connexion.css">
    <title>Connexion Concert'asso</title>
</head>

<body>
    <div class="header">
        <a href="http://www.undouadejazz.com">Retour</a>
        <h1>Concert'asso</h1>
    </div>
    <div class="content">

        <form class="connexion" method="POST" action="/insert-bd">
            <p>CONNEXION</p>
            <input type="text" name="ident" id="ident" placeholder="Identifiant*" />
            <input type="password" name="passwd" id="passwd" placeholder="Mot de passe" />
            <button type="button" name="toggle-password" id="toggle-password" class="toggle-password">afficher</button>
            <p id="informations">* reçu par mail si vous êtes un artiste</p>
            <?php 
                $fail = $_POST["fail"];

                if ($fail=="tr") {
                    ?>
                    <p class="fail">L'identifiant ou le mot de passe est incorrect</p>
                    <?php
                }
            ?>
            <input type="submit" value="Se connecter"/>
        </form>
        <aside>
            <img src="/PROJET_FI/public/assets/img/logo_doua.png" alt="logo de l'association un doua de jazz" />
            <img src="/PROJET_FI/public/assets/img/logo_insa.png" alt="logo de l'insa" />
        </aside>
    </div>
</body>

</html>
