<?php $title = 'Create_Spec';
$lesCSS = ["Create_Spec", "basPage", "cote"];
require_once 'head.php';
$fail = isset($_SESSION["mauvais_art"]) ? $_SESSION["mauvais_art"] : false;
?>

<body>
    <?php require_once "cote.php" ?>
    <main id="creat-spec">
        <h1><?php print_r($_SESSION) ?></h1>
        <h1>Créé un nouveau spectacle</h1>
        <section class="form-section">
            <form method="POST" action="verif_artiste">
                <label for="nom-Art">Nom du groupe</label>
                <input type="text" id="nom-Art" name="nom-Art" required>

                <label for="date-Rep">Date de représentation</label>
                <input type="date" id="date-Rep" name="date-Rep" required>

                <label for="heure-Rep">Heure de représentation</label>
                <input type="time" id="heure-Rep" name="heure-Rep" required>

                <label for="duree-Rep">Durée de représentation</label>
                <input type="time" id="duree-Rep" name="duree-Rep" required>

                <label for="heure-arrivé">Heure arrivée artistes</label>
                <input type="time" id="heure-arrivé" name="heure-arrivé" required>

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
    <?php require_once "basPage.php" ?>
</body>

</html>
