<?php
    include 'head.php'; 


  
    $date=$_POST["date"];
    $heure=$_POST["heure"];
    $nomG=$_POST["nom"];
    $nomS=$_POST["nomS"];

    
    $execution=$bdd->prepare("Select idG from GROUPE where nomG=:nomG");
    $execution->bindParam(':nomG',$nomG,PDO::PARAM_STR);
    $execution->execute();
    $idG=$execution->fetchColumn();

    $execution=$bdd->prepare("Select idS from SALLE where nomS=:nomS");
    $execution->bindParam(':nomS',$nomS,PDO::PARAM_STR);
    $execution->execute();
    $idG=$execution->fetchColumn();


    $idma = $bdd->query('SELECT MAX(idC) FROM CONCERT');
    $idF = $idma->fetch();
    $idC = $idF[0]+1;

    $idG=$execution->fetchColumn();
    $execution=$bdd->prepare("INSERT INTO CONCERT(idC, dateC, debutConcert, idG, idS) VALUES (:idC, :dateC, :heure, :idG, :idS)");
    $execution->bindParam(':idC',$idC,PDO::PARAM_STR);
    $execution->bindParam(':dateC',$date,PDO::PARAM_STR);
    $execution->bindParam(':heure',$heure,PDO::PARAM_STR);
    $execution->bindParam(':idG',$idG,PDO::PARAM_STR);

    $execution->execute();

    header("Location: /Ac_Orga");
?>