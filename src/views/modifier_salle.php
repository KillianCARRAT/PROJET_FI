<?php
$title = 'Modifier Salle';
$lesCSS = ["Style-Modifier-Salle", "basPage", "cote"];
require_once 'head.php';
?>

<body>
    <?php require_once "cote.php"; ?>
    <main id="main-modifier-salle">
        <h1>Modifier Salle</h1>
        <?php
        $idS = $_GET['id'];
        $reqSalle = $bdd->prepare('SELECT * FROM SALLE WHERE idS = :id');
        $reqSalle->bindParam(":id", $idS, PDO::PARAM_STR);
        $reqSalle->execute();
        $salle = $reqSalle->fetch();
        ?>
        <form method="post" action="/update_salle">
            <input type="hidden" name="idS" value="<?php echo $salle['idS']; ?>">
            <label for="nomS">Nom</label>
            <input type="text" name="nomS" id="nomS" value="<?php echo $salle['nomS']; ?>" required>

            <label for="nbPlaceS">Nombre de places</label>
            <input type="number" name="nbPlaceS" id="nbPlaceS" value="<?php echo $salle['nbPlaceS']; ?>" required>

            <label for="nbTechS">Nombre de techniciens</label>
            <input type="number" name="nbTechS" id="nbTechS" value="<?php echo $salle['nbTechS']; ?>" required>

            <label for="adresseS">Adresse</label>
            <input type="text" name="adresseS" id="adresseS" value="<?php echo $salle['adresseS']; ?>" required>

            <button type="submit" id="envoye-form">Modifier</button>
        </form>
    </main>
    <?php require_once "basPage.php"; ?>
</body>

</html>
