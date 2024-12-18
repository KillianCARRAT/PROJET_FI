<?php $title = 'Crea_ART';
$lesCSS = ["basPage", "cote","Create_Spec"];
include 'head.php'; ?>
<body>
    <?php include "cote.php" ?>
    <main>
        <div>
            <h1>Création d'un artiste</h1>
            <section class="form-section">
            <form method="POST" action="Create_ART2">
                <label for="nom-Art">Nom de l'artiste</label>
                <input type="text" id="nom-Art" name="nom-Art">

                <label for="mail-Art">Mail de l'artiste</label>
                <input type="email" id="mail-Art" name="mail-Art">

                <label for="nb_Tec">Nombre de Technicien</label>
                <input type="number" id="nb_Tec" name="nb_Tec">

                <label for="nb_ART">Nombre de Personne dans le grope</label>
                <input type="number" id="nb_ART" name="nb_ART">
                <div id="boutons">
                    <button type="reset" class="bouton-bas">Reinitailiser le formulaire</button>
                    <button type="submit" class="bouton-bas" >Créé l'artiste</button>
                </div>

            </form>
        </section>
    </main>
    <?php include "basPage.php" ?>
</body>

</html>