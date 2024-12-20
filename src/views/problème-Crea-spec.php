<?php
$lesCSS = ["problème-spectacle", "basPage", "cote"];
    include 'head.php'; 
    include "cote.php";
    echo "<body id=principal><main id='pro-crea-spec'>";
    echo "<h1 id=texte>Il y a un problème dans la création du spéctacle, vérifier la compatibilité avec les autres spectacles ainsi que si la place en loge est suffisante et réessayez</h1>";
    echo "</main></body>";
    include "basPage.php";

?>