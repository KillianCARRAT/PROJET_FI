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
            $reqB = $bdd->prepare('SELECT nomM, typeM, nbBesoin FROM MATERIEL NATURAL JOIN BESOIN WHERE idC = 1');
            //$reqB->bindParam(":idC", $idC, PDO::PARAM_STR);
            $reqB->execute();
            while ($mat = $reqB->fetch()) { 
                if ($reqB){
                    $nomM = $mat['nomM'];
                    $typeM = strtolower($mat['typeM']);
                    $qte = $mat['nbBesoin'];
                    echo "<section id='section'>";
                    echo '<p class="quantity-display" data-name="'.$nomM.'">'.$qte.'X</p>'; //Ajout d'un `data-name`
                    echo '<div id="multiplicateur" class="object base '.$typeM.'" draggable="true" data-qte="'.$qte.'" data-name="' . $nomM . '" data-type="'.$typeM.'">' . $nomM .'</div>';
                    echo "</section>";
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
