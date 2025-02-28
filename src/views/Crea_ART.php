<?php $title = 'Crea_ART';
$lesCSS = ["basPage", "cote", "Create_Spec"];
require_once 'head.php'; ?>

<body>
    <?php require_once "cote.php" ?>
    <main id="create-art">
        <div>
            <h1>Création d'un artiste</h1>
            <section class="form-section">
                <form method="POST" action="/Create_ART2">

                    <label for="nom-Art">Nom de l'artiste</label>
                    <input type="text" id="nom-Art" name="nom-Art" required>

                    <label for="mail-Art">Mail de l'artiste</label>
                    <input type="email" id="mail-Art" name="mail-Art" required>

                    <label for="nb_Tec">Nombre de Technicien</label>
                    <input type="number" id="nb_Tec" name="nb_Tec" required>

                    <label for="nb_ART">Nombre de Personne dans le groupe</label>
                    <input type="number" id="nb_ART" name="nb_ART" required>
                    <div id="boutons">
                        <section id="section">
                            <button type="reset" class="bouton-bas">Reinitailiser le formulaire</button>
                            <button type="submit" class="bouton-bas">Créer l'artiste</button>
                        </section>
                    </div>

                </form>
            </section>
    </main>
    <?php require_once "basPage.php" ?>
</body>
</html>
