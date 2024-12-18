<?php $title = 'Create_Spec';
$lesCSS = ["Create_Spec", "basPage", "cote"];
include 'head.php'; ?>

<body>
    <?php include "cote.php" ?>
    <main id="creat-spec">
        <h1>Créé un nouveau spectacle</h1>
        <section class="form-section">
            <form method="POST" action="Create_Spec2">
                <label for="nom-Art">Nom de l'artiste</label>
                <input type="text" id="nom-Art" name="nom-Art">

                <label for="mail-Art">Mail de l'artiste</label>
                <input type="email" id="mail-Art" name="mail-Art">

                <label for="date-Rep">Date de représentation</label>
                <input type="date" id="date-Rep" name="date-Rep">

                <label for="heure-Rep">Heure de représentation</label>
                <input type="time" id="heure-Rep" name="heure-Rep">
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