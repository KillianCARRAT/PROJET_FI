<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <link href="/PROJET_FI/public/assets/css/connexion.css" rel="stylesheet">
    <title>Connexion Concert'asso</title>
</head>

<body>
    <div class="header">
        <a href="http://www.undouadejazz.com">Retour</a>
        <h1>Concert'asso</h1>
    </div>
    <div class="content">
        <div class="connexion">
            <p>CONNEXION</p>
            <input type="text" id="ident" placeholder="Identifiant*" />
            <input type="password" id="passwd" placeholder="Mot de passe" />
            <button type="button" id="toggle-password" class="toggle-password">afficher</button>
            <p id="informations">* reçu par mail si vous êtes un artiste</p>
            <input type="submit" value="Se connecter" />
        </div>
        <aside>
            <img src="/PROJET_FI/public/assets/img/logo_doua.png" alt="logo de l'association un doua de jazz" />
            <img src="/PROJET_FI/public/assets/img/logo_insa.png" alt="logo de l'insa" />
        </aside>
    </div>
</body>

</html>