<?php
$title = 'plan-feu';
$lesCSS = ["plan_feu"];
require_once 'head.php';
$idC = $_GET['concert'];

?>

<body>
    <main id="main-plan-feu">
        <h1>Fiche plan-feu</h1>

        <!-- Zone de dessin -->
        <div class="dropzone" id="dropzone"></div>

        <!-- Zone des objets à droite -->
        <div class="objects">
            <?php
            $reqB = $bdd->prepare('SELECT nomM, typeM, qteAsso FROM MATERIEL NATURAL JOIN BESOIN WHERE idC = 1');
            //$reqB->bindParam(":idC", $idC, PDO::PARAM_STR);
            $reqB->execute();
            while ($mat = $reqB->fetch()) { 
                if ($reqB){
                    $nomM = $mat['nomM'];
                    $typeM = $mat['typeM'];
                    $qte = $mat['qte'];
                    $classType = ($typeM == 'img') ? 'img' : $typeM;
                    echo '<div class="object ' . $classType . '" draggable="true" data-name="' . $nomM . '" data-qte="' . $qte . '">' . $nomM . ' (' . $qte . ')</div>';
                }
            }
            ?>
        </div>
    </main>
</body>

<?php
$lesJS = ["plan_feu"];
require_once 'script.php';
?>




</html>
