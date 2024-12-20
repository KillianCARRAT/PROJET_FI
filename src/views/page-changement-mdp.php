<!DOCTYPE html>
<html lang="fr">

<head>
    <meta charset="utf-8">
    <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>/public/assets/css/page-changement-mdp.css">
    <title>Changer mot de passe - Concert'asso</title>
</head>

<body>
    <div class="header">
        <a href="/connexion">Retour</a>

        <h1>Concert'asso</h1>
    </div>
    <?php
    $mdp_bool = $_SESSION["mdp-bool"];
    if ($mdp_bool == "reussi") { ?>
        <div id="popup" class="popup">
            <div class="popup-content">
                <span class="close-btn">&times;</span>
                <p>Changement de mot de passe confirmé !</p>
                <?php $_SESSION["mdp-bool"] = null; ?>
                <input type="submit" id="popup-ok" value="Se connecter" onclick="window.location.href='/';" />
            </div>
        </div>
        </form>
        <?php
    } else { ?>
        <form class="change_mdp" method="POST" action="/changement_mdp">
            <p>Veuillez changer de mot de passe</p>
            <div class="password-container">

                <?php
                if ($_POST["admin"] == "tr") {
                    $id = $_POST["id"];
                } else {
                    $id = $_SESSION["idUser"];
                } ?>
                <input type="hidden" id="ident" name="ident" value=<?php echo $id; ?>>
                <div id="affichage">
                    <div id="zone-password">
                        <input type="password" id="new-passwd" name="new-passwd" placeholder="nouveau mot de passe" />

                        <input type="password" id="confirm-passwd" name="confirm-passwd"
                            placeholder="confirmer mot de passe" />
                    </div>
                    <button type="button" id="toggle-all-passwords" class="toggle-password">Afficher</button>
                </div>

            </div>
            <p id="informations">* : l’utilisation de mot de passe fort est conseillé (majuscule, chiffre, caractère
                spéciaux, etc.)</p>
            <?php
            if ($mdp_bool == "meme") { ?>
                <p class="rate">Vous ne pouvez pas utilisez le même mot de passe que l'actuel</p>
                <?php
            } elseif ($mdp_bool == "diff") { ?>
                <p class="rate">Les champs 'Mot de passe' et 'Confirmation' doivent être identiques</p>

                <?php
            } ?> <input type="submit" value="changer de mot de passe" /> <?php
    } ?>

        </div>
        <script>
            document.getElementById('toggle-all-passwords').addEventListener('click', () => {
                const newPasswordField = document.getElementById('new-passwd');
                const confirmPasswordField = document.getElementById('confirm-passwd');
                const toggleButton = document.getElementById('toggle-all-passwords');

                if (newPasswordField.type === 'password' || confirmPasswordField.type === 'password') {
                    newPasswordField.type = 'text';
                    confirmPasswordField.type = 'text';
                    toggleButton.textContent = 'Cacher';
                } else {
                    newPasswordField.type = 'password';
                    confirmPasswordField.type = 'password';
                    toggleButton.textContent = 'Afficher';
                }
            });


            const popup = document.getElementById('popup');
            const closeButton = document.querySelector('.close-btn');
            const okButton = document.getElementById('popup-ok');
            function showPopup() {
                popup.style.display = 'flex';
            }
            function hidePopup() {
                popup.style.display = 'none';
            }
            closeButton.addEventListener('click', hidePopup);
            okButton.addEventListener('click', hidePopup);
        </script>
</body>

</html>