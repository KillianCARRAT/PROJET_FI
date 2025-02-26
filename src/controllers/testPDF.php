<?php 
use src\controllers\Database;
$bdd = Database::getConnection();
require('fpdf186/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage();
$pdf->SetTitle('Fiche_rider');
$pdf->Image("5.png",NULL,NULL,0,0,'PNG');
$pdf->Output();
?>
