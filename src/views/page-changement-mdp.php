<!DOCTYPE html>
<html>
    <head>
        <meta charset="utf-8">
        <link rel="stylesheet" type="text/css" href="<?= BASE_URL; ?>/public/assets/css/page-changement-mdp.css">
        <title>Changer mot de passe - Concert'asso</title>
    </head>
    <body>
        <div class="header">
            <a href="connexion.php">Retour</a>
            <h1>Concert'asso</h1>
        </div>
            <?php 
                $mdp_bool = $_SESSION["mdp-bool"];
                if ($mdp_bool=="reussi") {?>
                    <div id="popup" class="popup">
                            <div class="popup-content">
                                <span class="close-btn">&times;</span>
                                <p>Changement de mot de passe confirmé !</p>
                                <?php $_SESSION["mdp-bool"] = null;?>
                                <input type="submit" id="popup-ok" value="Se connecter" onclick="window.location.href='/';"/>
                            </div>
                        </div>
                    <?php
                }
                else {?>
                    <form class="change_mdp" method="POST" action="/changement_mdp">
                        <p>Veuillez changer de mot de passe</p>
                        <div class="password-container">
                            <?php $id = $_SESSION["idUser"]; ?>
                            <input type="hidden" id="ident" name="ident" value=<?php $id ?>/>
                            <input type="password" id="new-passwd" name="new-passwd" placeholder="nouveau mot de passe"/>
                            <button type="button" id="toggle-password" class="toggle-password" data-target="new-passwd">afficher</button>
                        </div>
                        <input type="password" id="confirm-passwd" name="confirm-passwd" placeholder="confirmer mot de passe"/>
                        <p id="informations">* : l’utilisation de mot de passe fort est conseillé (majuscule, chiffre, caractère spéciaux, etc.)</p>
                        <?php 
                            if ($mdp_bool=="meme") {?>
                                <p class="rate">Vous ne pouvez pas utilisez le même mot de passe que l'actuel</p>
                                <?php
                            } elseif ($mdp_bool=="diff") {?>
                                <p class="rate">Les champs 'Mot de passe' et 'Confirmation' doivent être identiques</p>

                                <?php
                            }?> <input type="submit" value="changer de mot de passe"/> <?php
                        }?>
                    </form>
        </div>
        <script>
        document.querySelectorAll('.toggle-password').forEach(button => {
            button.addEventListener('click', () => {
                const targetId = button.getAttribute('data-target');
                const passwordField = document.getElementById(targetId);
                if (passwordField.type === 'password') {
                    passwordField.type = 'text';
                    button.textContent = 'Cacher';
                } else {
                    passwordField.type = 'password';
                    button.textContent = 'Afficher';
                }
            });
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