<?php $title = 'Create_Spec';
$lesCSS = ["Create_Spec", "basPage", "cote"];
require_once 'head.php';

$procedure="select nomG from GROUPE";
$execusion=$bdd->prepare($procedure);
$execusion->execute();


?>

<body>
    <?php require_once "cote.php" ?>
    <main id="creat-spec">
        <h1>Créé un nouveau spectacle</h1>
        <section class="form-section">
            <form method="POST" action="verif_artiste">
                <label for="nom-Art">Nom du groupe</label>
                <?php
                echo "<select id='nom-Art' name='nom-Art' required>";
                echo "<option value=''>Choisir un artiste</option>";
                while($row=$execusion->fetch()){
                    echo "<option value=".$row["nomG"].">".$row["nomG"]."</option>";

                }
                echo "</select>";
                ?>

                <label for="date-Rep">Date de représentation</label>
                <input type="date" id="date-Rep" name="date-Rep" required>

                <label for="heure-Rep">Heure de représentation</label>
                <input type="time" id="heure-Rep" name="heure-Rep" required>

                <label for="duree-Rep">Durée de représentation</label>
                <input type="time" id="duree-Rep" name="duree-Rep" required>

                <label for="heure-arrivé">Heure arrivée artistes</label>
                <input type="time" id="heure-arrivé" name="heure-arrivé" required>

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
