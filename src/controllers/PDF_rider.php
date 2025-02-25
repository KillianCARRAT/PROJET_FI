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
$pdf->Cell(40,10,'Concert du '.$donnees['dateC']);
$pdf->Ln();
$pdf->Cell(40,10,'Nom du groupe : '.$donnees['nomG']);
$pdf->Ln();
$pdf->Cell(40,10,'Nom de la salle : '.$donnees['nomS']);
$pdf->Ln(100);
$pdf->Cell(40,10,'Materiaux : ');
$pdf->Ln();

$reqMat = $bdd->prepare('SELECT * FROM MATERIEL NATURAL JOIN BESOIN WHERE idC = :id');
$reqMat->bindParam(":id", $idC, PDO::PARAM_STR);
$reqMat->execute();
$mat = $reqMat->fetch();
$header = array('Nom', 'Type', 'Quantité');
foreach($header as $col)
    $pdf->Cell(40,7,$col,1);
$pdf->Ln();
// Données
foreach($mat as $row)
{
    foreach($row as $col)
        $pdf->Cell(40,6,$col,1);
    $pdf->Ln();
}

$pdf->Output();
?>


