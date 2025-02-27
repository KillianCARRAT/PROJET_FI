<?php $title = 'Crea_Salle';
$lesCSS = ["basPage", "cote", "Create_Spec"];
require_once 'head.php'; ?>

<body>
    <?php require_once "cote.php" ?>
    <main>
        <div>
            <h1>Création d'une Salle</h1>
            <section class="form-section">
                <form method="POST" action="Create_Salle2">

                <label for="nom-Salle">Nom de la salle  (mettre des tirets a la place des espaces)</label>
                <input type="text" id="nom-Salle" name="nom-Salle">

                    <label for="nb_place">Nombre de place</label>
                    <input type="number" id="nb_place" name="nb_place">

                    <label for="type-Place" class="label">Type de place</label>
                    <select name="typePlace" id="typePlace">
                        <option value="">---Type de place---</option>
                        <option value="Assise">Assis</option>
                        <option value="Debout">Debout</option>
                        <option value="Mixte">Mixte</option>
                    </select>

                    <label for="adresse">Adresse de la salle</label>
                    <input type="text" id="adresse" name="adresse">

                    <label for="largeur">Largeur de la scene</label>
                    <input type="number" id="largeur" name="largeur">

                    <label for="Longeur">Longeur de la scene</label>
                    <input type="number" id="Longeur" name="Longeur">

                    <label for="nb_Tec">Nombre de Technicien</label>
                    <input type="number" id="nb_Tec" name="nb_Tec">

                    <label for="loges">Nombre de place dans les loges</label>
                    <input type="number" id="loges" name="loges">
                    <div id="boutons">
                        <section id="section">
                            <button type="reset" class="bouton-bas">Reinitailiser le formulaire</button>
                            <button type="submit" class="bouton-bas">Créé la Salle</button>
                        </section>
                    </div>

                </form>
            </section>
    </main>
    <?php require_once "basPage.php" ?>
</body>

</html>
