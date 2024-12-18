<?php $title = 'Create_Spec';
$lesCSS = ["Create_Spec", "basPage", "cote"];
include 'head.php';
session_start();
$fail = isset($_SESSION["mauvais_art"]) ? $_SESSION["mauvais_art"] : false;
unset($_SESSION["mauvais_art"]); 
?>

<body>
    <?php include "cote.php" ?>
    <main>
        <h1>Créé un nouveau spectacle</h1>
        <section class="form-section">
        <form method="POST" action="verif_artiste">
                <label for="nom-Art">Nom du groupe</label>
                <input type="text" id="nom-Art" name="nom-Art" required>

                <label for="date-Rep">Date de représentation</label>
                <input type="date" id="date-Rep" name="date-Rep" required>

                <label for="heure-Rep">Heure de représentation</label>
                <input type="time" id="heure-Rep" name="heure-Rep" required>

                <?php if ($fail): ?>
                    <p class="fail">Le groupe n'existe pas, veuillez le créer au préalable.</p>
                <?php endif; ?>

                <div id="boutons">
                    <button type="reset" class="bouton-bas">Reinitailiser le formulaire</button>
                    <button type="submit" class="bouton-bas">Trouver une salle</button>
                </div>
            </form>
        </section>
    </main>
    <?php include "basPage.php" ?>
</body>

</html>