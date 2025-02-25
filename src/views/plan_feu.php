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
        $reqB = $bdd->prepare('SELECT nomM,typeM,qte FROM MATERIEL NATURAL JOIN BESOIN WHERE idC = :idC');
        $reqB->bindParam(":idC", $idC, PDO::PARAM_STR);
        $reqB->execute();
        while ($mat = $reqB->fetch()) { 
            if ($reqB){
                if ($mat['typeM'] == 'img') {
                    echo '<div class="object img" draggable="true">'.$mat['nomM'].'</div>';

                } else {
                    echo '<div class="object ' . $mat['typeM'] . '" draggable="true">' . $mat['nomM'] . '</div>';
                }
            } }?>
        
        <div class="object img" draggable="true"></div>
        <div class="object circle" draggable="true">●</div>
        <div class="object star" draggable="true">★</div>
    </div>



           
    </main>
</body>

<?php
$lesJS = ["plan_feu"];
require_once 'script.php';
?>




</html>
