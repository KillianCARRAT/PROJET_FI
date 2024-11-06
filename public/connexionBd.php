<?php
    $servername="localhost";
    $database="DBmchesneau";
    $username="mchesneau";
    $password="mchesneau";

    $connexion=mysqli_connect($servername,$username,$password,$database);

    if(!$connexion){
        die("Echec connexion :". mysqli_connect_error());
    }
?>