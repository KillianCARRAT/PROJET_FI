<?php
$title = 'plan-feu';
$lesCSS = ["plan_feu"];
require_once 'head.php';
$idC = $_GET['concert'];

?>

<body>
<script src="https://cdnjs.cloudflare.com/ajax/libs/html2canvas/1.4.1/html2canvas.min.js"></script>
    <main id="main-plan-feu">
        <h1>Fiche plan-feu</h1>

        <!-- Zone de dessin -->
        <div class="dropzone" id="dropzone"></div>

        <!-- Zone des objets à droite -->
        <div class="objects">
            <?php
            $reqB = $bdd->prepare('SELECT nomM, typeM, nbBesoin FROM MATERIEL NATURAL JOIN BESOIN WHERE idC = :idC');
            $reqB->bindParam(":idC", $idC, PDO::PARAM_STR);
            $reqB->execute();
          
            while ($mat = $reqB->fetch()) { 
                if ($reqB){
                    $nomM = $mat['nomM'];
                    $typeM = strtolower($mat['typeM']);
                    $qte = $mat['nbBesoin'];
                    echo '<p class="quantity-display" data-name="'.$nomM.'">'.$qte.'X</p>'; //Ajout d'un `data-name`
                    echo '<div id="multiplicateur" class="object base '.$typeM.'" draggable="true" data-qte="'.$qte.'" data-name="' . $nomM . '" data-type="'.$typeM.'">' . $nomM .'</div>';
                }
            }
            ?>
        </div>
        <input id="idC" type="hidden" name="idC" value=<?php echo $idC ?>>
        <section id="section">
            <button class="bouton" onclick="window.location = '/Ac_Art'">Retour</button>
            <input class="bouton" id="boutonCapture" type="submit" value="Enregister">
        </section>
    </main>
</body>

<?php
$lesJS = ["plan_feu"];
require_once 'script.php';
?>




</html>
