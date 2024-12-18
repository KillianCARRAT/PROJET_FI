<?php $title = 'Create_Spec';
$lesCSS = ["page-creation-spectacle2", "basPage", "cote"];
include 'head.php'; ?>
<!DOCTYPE html>
<html lang="fr">
=

<body id="corps-principal">
    <?php include "cote.php" ?>
    <main id="principal">
        <h1 id="texte">Créé un nouveau spectacle</h1>
        <section class="form-section">
            <form id="formulaire" method="POST" action="salles_dipo">
                <div id="nbpersslider">
                    <label for="nombre-Pers" class="label">Nombre personnes</label>
                    <div class="slider-container">
                        <span id="sliderValue" class="slider-value">641</span>
                        <input name="nbPers" type="range" id="slider" class="slider" min="0" max="10000" value="5000"
                            oninput="updateValue()">
                    </div>
                </div>
                <div id="combobox">
                    <label for="type-Place" class="label">Type de place</label>
                    <select name="typePlace" id="typePlace">
                        <option value="">---Type de place---</option>
                        <option value="Assise">Assis</option>
                        <option value="Debout">Debout</option>
                        <option value="Mixte">Mixte</option>
                    </select>
                </div>
                <div id="longueur">
                    <label for="longueur min">Longueur minimum scène</label>
                    <input name="longueur" type="number" id="longueur" min=0>
                </div>
                <div id="largeur">
                    <label for="largeur min">largeur minimum scène</label>
                    <input name="largeur" type="number" id="largueur" min=0>
                </div>
                <div id="bouton-chercher">
                    <button type="submit" class="bouton-bas">Chercher</button>
                </div>
                <?php $nom=$_SESSION["nom-art-spec"];?>
                <?php $date= $_SESSION["date-art-spec"];?>
                <?php $heure=$_SESSION["heure-art-spec"];?>
                <input type="hidden" id="nom" name="nom" value=<?php echo htmlspecialchars($nom); ?>>
                <input type="hidden" id="date" name="date" value=<?php echo htmlspecialchars($date); ?>>
                <input type="hidden" id="heure" name="heure" value=<?php echo htmlspecialchars($heure); ?>>
            </form>
        </section>
    </main>
    <script src="../../public/assets/js/slider.js"></script>
</body>
<?php include "basPage.php" ?>

</html>

