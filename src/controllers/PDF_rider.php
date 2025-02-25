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
$pdf->SetFont('Arial','B',16);
$pdf->Cell(40,10,'Concert du '.$donnees['dateC']);
$pdf->Cell(40,10,'Nom du groupe : '.$donnees['nomG']);
$pdf->Cell(40,10,'Nom de la salle : '.$donnees['nomS']);

$pdf->Output();
?>


