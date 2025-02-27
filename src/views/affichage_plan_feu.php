<?php
$lesCSS = ["image_feu"];
require_once 'head.php';

$nom = $_GET["concert"];
$image = BASE_URL."/src/controllers/PDF/" . $nom . ".png";
$imagefe=__DIR__."/../controllers/PDF/" . $nom . ".png";

error_log($imagefe);

if (file_exists($imagefe)) {
    print '<body id="body">';
    print '<img src="'.$image.'" alt="texte alternatif" />';
    print '<section id="section">';
    ?>

    <button class="bouton" onclick="window.location = '/Ac_Art'">Retour</button>

    <?php
    print '<a href="/plan_feu?concert=' . $nom . '"><button class="bouton">Modifier</button></a>';
    print '</section>';
    print '</body>';
} else {
    header("Location:/plan_feu?concert=" . $nom);
}
?>
