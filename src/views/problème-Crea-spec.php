<?php
$lesCSS = ["problème-spectacle", "basPage", "cote"];
    require_once 'head.php';
    require_once "cote.php";
    $erreur=$_SESSION["erreur_Creation_Spectacle"];
    echo "<body id=principal><main id='pro-crea-spec'>";
    echo "<h1 id=texte>Erreur : ".$erreur->getMessage()."</h1>";
    echo "</main></body>";
    require_once "basPage.php";
