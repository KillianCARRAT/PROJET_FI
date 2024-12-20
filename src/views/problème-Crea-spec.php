<?php
$lesCSS = ["problème-spectacle", "basPage", "cote"];
    include 'head.php'; 
    include "cote.php";
    $erreur=$_SESSION["erreur_Creation_Spectacle"];
    echo "<body id=principal><main id='pro-crea-spec'>";
    echo "<h1 id=texte>Erreur : ".$erreur->getMessage()."</h1>";
    echo "</main></body>";
    include "basPage.php";

?>