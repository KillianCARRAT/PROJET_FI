<?php $title = 'Create_Spec';
$lesCSS = ["listeSalleDispo", "basPage", "cote"];
include 'head.php'; 


$type=$_POST["typePlace"];
$nbPers=$_POST["nbPers"];
$longueur=$_POST["longueur"];
$largeur=$_POST["largeur"];
$nom=$_POST["nom"];
$date=$_POST["date"];
$heure=$_POST["heure"];
?>

<!DOCTYPE html>
<html lang="fr">
<?php include "cote.php" ?>
<body>
    
<main>

<?php 
$procedure="call salles_dispo(:heure,:jour,:type,:nb,:longueur,:largeur)";
$execution=$bdd->prepare($procedure);
$execution->bindParam(':heure',$heure,PDO::PARAM_STR);
$execution->bindParam(':jour',$date,PDO::PARAM_STR);
$execution->bindParam(':nb',$nbPers,PDO::PARAM_STR);
$execution->bindParam(':type',$type,PDO::PARAM_STR);
$execution->bindParam(':longueur',$longueur,PDO::PARAM_STR);
$execution->bindParam(':largeur',$largeur,PDO::PARAM_STR);
$execution->execute();

$table=$bdd->prepare("select * from SalleTemp");
$table->execute();


?><table id="tableau"><?php
while ($row=$table->fetch()){
    ?>
        <tr>
            <td><?php echo htmlspecialchars($row["nomS"]); ?></td>
        </tr>
    
<?php } ?>
</table>
</main>
</body>
<?php include "basPage.php" ?>