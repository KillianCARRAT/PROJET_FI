<?php
$lesCSS = ["problème-spectacle", "basPage", "cote"];
require_once 'head.php';
require_once "cote.php";
echo "<body id=principal><main id='pro-crea-spec'>";
echo "<h1 id=texte>Il y a un problème dans la création du spéctacle, vérifier la compatibilité avec les autres spectacles ainsi que si la place en loge est suffisante et réessayez</h1>";
echo "</main></body>";
require_once "basPage.php";
