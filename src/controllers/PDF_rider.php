<?php 
use src\controllers\Database;
$bdd = Database::getConnection();
require('fpdf186/fpdf.php');
$idC = $_GET['concert'];
$reqType = $bdd->prepare('SELECT * FROM CONCERT NATURAL JOIN SALLE NATURAL JOIN GROUPE WHERE idC = :id');
$reqType->bindParam(":id", $idC, PDO::PARAM_STR);
$reqType->execute();
$donnees = $reqType->fetch();


$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetTitle('Fiche_rider');
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,iconv('UTF-8', 'windows-1252', 'Concert du '.$donnees['dateC']));
$pdf->Ln();
$pdf->Cell(40,10,'Nom du groupe : '.$donnees['nomG']);
$pdf->Ln();
$pdf->Cell(40,10,iconv('UTF-8', 'windows-1252', 'Nom de la salle : '.$donnees['nomS']));
$pdf->Ln();

if ($donnees['besoinHotel'] !== NULL){
    $pdf->Cell(40,10,iconv('UTF-8', 'windows-1252', "Adresse de l'hotel demmander : ".$donnees['besoinHotel']));
}
else{
    $pdf->Cell(40,10,iconv('UTF-8', 'windows-1252', 'Pas de demande d\'hotel'));
}
$pdf->Ln();

if ($donnees['besoinTransport'] !== NULL){
    $pdf->Cell(40,10,iconv('UTF-8', 'windows-1252', "Transport demmander : ".$donnees['besoinTransport']));
}
else{
    $pdf->Cell(40,10,iconv('UTF-8', 'windows-1252', 'Pas de demande de transport'));
}
$pdf->Ln();

if ($donnees['commentaire'] !== NULL){
    $pdf->Cell(40,10,iconv('UTF-8', 'windows-1252', 'Demmande particulière : '));
    $pdf->Ln(15);
    $pdf->SetFont('Arial','',12);
    $pdf->MultiCell(0,10,iconv('UTF-8', 'windows-1252', $donnees['commentaire']),'LBRT');
    $pdf->SetFont('Arial','B',16);
}
else{
    $pdf->Cell(40,10,iconv('UTF-8', 'windows-1252', 'Pas de demande particulière'));
}



$pdf->Ln(20);





$pdf->Cell(40,10,iconv('UTF-8', 'windows-1252', 'Materiaux : '));
$pdf->Ln();




$pdf->Cell(70,9,iconv('UTF-8', 'windows-1252', 'Nom'),1);
$pdf->Cell(40,9,iconv('UTF-8', 'windows-1252', 'Type'),1);
$pdf->Cell(30,9,iconv('UTF-8', 'windows-1252', 'Quantité'),1);
$pdf->Cell(70,9,iconv('UTF-8', 'windows-1252', 'Quantité manquante'),1,1);


$reqMat = $bdd->prepare('SELECT nomM,typeM,nbBesoin FROM MATERIEL NATURAL JOIN BESOIN WHERE idC = :id');
$reqMat->bindParam(":id", $idC, PDO::PARAM_STR);
$reqMat->execute();
$couleur = 0;
while($mat = $reqMat->fetch()){
    if($couleur == 0){
        $pdf->SetFillColor(255,255,255);
        $couleur = 1;
    }
    else{
        $pdf->SetFillColor(200,200,200);
        $couleur = 0;
    }
    $nom = $mat['nomM'];
    $type = $mat['typeM'];
    $nbBesoin = $mat['nbBesoin'];

    $pdf->Cell(70,7,iconv('UTF-8', 'windows-1252', $nom),1);
    $pdf->Cell(40,7,iconv('UTF-8', 'windows-1252', $type),1);
    $pdf->Cell(30,7,iconv('UTF-8', 'windows-1252', $nbBesoin),1);

    $reqid = $bdd->prepare('SELECT idM,qteAsso FROM MATERIEL WHERE nomM = :nom and typeM = :typ');
    $reqid->bindParam(":nom", $nom, PDO::PARAM_STR);
    $reqid->bindParam(":typ", $type, PDO::PARAM_STR);
    $reqid->execute();
    $id = $reqid->fetch();
    
    $qte = $id['qteAsso'];
    $id = $id['idM'];

    $reqgrp = $bdd->prepare('SELECT qte FROM AVOIRGROUPE WHERE idM = :idM and idG = :idG');
    $reqgrp->bindParam(":idM", $id, PDO::PARAM_STR);
    $reqgrp->bindParam(":idG", $donnees['idG'], PDO::PARAM_STR);
    $reqgrp->execute();
    $qteGroupe = $reqgrp->fetch();
    $qteGroupe = $qteGroupe['qte'];


    $reqSalle = $bdd->prepare('SELECT qte FROM AVOIRSALLE WHERE idM = :idM and idS = :idS');
    $reqSalle->bindParam(":idM", $id, PDO::PARAM_STR);
    $reqSalle->bindParam(":idS", $donnees['idS'], PDO::PARAM_STR);
    $reqSalle->execute();
    $qteSalle = $reqSalle->fetch();
    $qteSalle = $qteSalle['qte'];

    $res = $nbBesoin - $qteGroupe - $qteSalle - $qte;
    if($res <= 0){
        $pdf -> SetTextColor(0, 128, 0);
        $pdf->Cell(70,7,iconv('UTF-8', 'windows-1252', 0),1);
        $pdf -> SetTextColor(0, 0, 0);
    }
    elseif($res < 5){
        $pdf -> SetTextColor(255, 127, 0);
        $pdf->Cell(70,7,iconv('UTF-8', 'windows-1252', $res),1);
        $pdf -> SetTextColor(0, 0, 0);
    }
    else{
        $pdf -> SetTextColor(255, 0, 0);
        $pdf->Cell(70,7,iconv('UTF-8', 'windows-1252', $res),1);
        $pdf -> SetTextColor(0, 0, 0);

    }
    $pdf->Ln();
}
$pdf->Ln(20);
$pdf->Cell(40,10,iconv('UTF-8', 'windows-1252', 'Plan Feu : '));
$pdf->Ln(20);
$pdf->Image(BASE_URL."/public/assets/img_capture/".$idC.'.png',NULL,NULL,0,0,'PNG');
$pdf->Output();
?>


