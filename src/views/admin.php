<?php $title = 'Crea_ART';
$lesCSS = ["basPage", "cote", "Create_Spec"];
require_once 'head.php'; ?>

<body>
    <?php require_once "cote.php" ?>
    <main>
        <div>
            <h1>Créer une nouvelle association</h1>
            <section class="form-section">
                <form method="POST" action="crea_Asso">


                    <label for="association_type">Type d'association:</label>
                    <select name="association_type" id="association_type">
                        <option value="organisatrice">Organisatrice</option>
                        <option value="technique">Technique</option>
                    </select>
                    <label for="identifiant">Identifiant:</label>
                    <input type="text" id="identifiant" name="identifiant">

                    <label for="mot_de_passe">Mot de passe:</label>
                    <input type="text" id="mot_de_passe" name="mot_de_passe">
                    <div id="boutons-admin">
                        <button type="reset" class="bouton-bas">Reinitailiser le formulaire</button>
                        <button type="submit" class="bouton-bas">Créer une nouvelle association</button>
                    </div>
                </form>
            </section>
    </main>
    <?php require_once "basPage.php" ?>
</body>
</html>
