<?php $title = 'Create_Spec';
$lesCSS = ["page-creation-spectacle2", "basPage", "cote"];?>
<?php require_once 'head.php'; ?>

<body id="corps-principal">
    <?php require_once "cote.php" ?>
    <main id="principal">
        <h1 id="texte">Créé un nouveau spectacle</h1>
        <section class="form-section">
            <form id="formulaire" method="POST" action="salles_dipo">
                <div id="nbpersslider">
                    <div id="nbpersslider">
                        <label for="nombre-Pers" class="label">Nombre personnes</label>
                        <div class="slider-container">
                            <input type="number" id="sliderInput" class="slider-value" min="0" max="1000" value="0">
                            <input name="nbPers" type="range" id="slider" class="slider" min="0" max="1000" value="0">
                        </div>
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
                    <input name="longueur" type="number" id="longueur" min=0 required>
                </div>
                <div id="largeur">
                    <label for="largeur min">Largeur minimum scène</label>
                    <input name="largeur" type="number" id="largueur" min=0 required>
                </div>
                <div id="nbTech">
                    <label for="nbTech">Nombre techniciens nécessaire</label>
                    <input name="nbTech" type="number" id="nbTech" min=0 required>
                </div>
                <div id="bouton-chercher">
                    <button type="submit" class="bouton-bas">Chercher</button>
                    <button id="bouton" type="button" class="bouton-bas" onclick="window.location = '/Create_Spec'">Retour</button>
                </div>

                <?php $id = $_SESSION["id-art-spec"]; ?>
                <?php $date = $_SESSION["date-art-spec"]; ?>
                <?php $heure = $_SESSION["heure-art-spec"]; ?>
                <?php $duree = $_SESSION["duree-rep"]; ?>
                <?php $arrive = $_SESSION["heure-arrivé"]; ?>

                <input type="hidden" id="nom" name="id" value=<?php echo htmlspecialchars($id); ?>>
                <input type="hidden" id="date" name="date" value=<?php echo htmlspecialchars($date); ?>>
                <input type="hidden" id="heure" name="heure" value=<?php echo htmlspecialchars($heure); ?>>
                <input type="hidden" id="duree" name="duree" value=<?php echo htmlspecialchars($duree); ?>>
                <input type="hidden" id="arrive" name="arrive" value=<?php echo htmlspecialchars($arrive); ?>>

            </form>
        </section>
    </main>
    <?php
    $lesJS = ["slider"];
    require_once 'script.php';
    ?>
</body>
<?php require_once "basPage.php" ?>

</html>