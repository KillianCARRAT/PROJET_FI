<?php

$lesCSS=["image_feu"];
require_once 'head.php';
$nom=$_GET["concert"];
$image=__DIR__."/../../public/assets/img_capture/".$nom.".png";

if(file_exists($image)){
    $image = preg_replace('/^.*\.\.\/\.\.\//', '../../', $image);
    error_log($image);
    print '<body id="body">';
    print '<img src="'.$image.'" alt="texte alternatif" />';
    print '<a href="/plan_feu?concert='.$nom.'"><button class="bouton">Modifier</button></a>';
    print '</body>';
}
else{
    header("Location:/plan_feu?concert=".$nom);
}


?>