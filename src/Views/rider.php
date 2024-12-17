<?php $title = 'rider';
$lesCSS = ["Style-Rider", "basPage", "cote"];
include 'head.php'; ?>

<body>
    <?php include "cote.php" ?>
    <main id="main-rider">
    
        <h1>Fiche rider</h1>
            <section id="question">
                <form class="grand">
                    
                    <?php
                    $idC = $_GET['concert'];
                    $reqType = $bdd->prepare('SELECT * FROM CONCERT NATURAL JOIN SALLE NATURAL JOIN GROUPE WHERE idC = :id');
                    $reqType->bindParam(":id", $idC, PDO::PARAM_STR);
                    $reqType->execute();
                    $donnees = $reqType->fetch();

                
                 ?>

                <label for="titre">Nom</label>
                <p><?php echo $donnees['nomG']; ?></p>

                <label for="date-repr">date de representation</label>
                <p><?php echo $donnees['dateC']; ?></p>

                <label for="demande">demande particuliaire</label>
                <textarea type="text" name="demande" id="demande" size='80'></textarea>

                <div class="chec">
                    <input type="checkbox" name="veicule" id="checkbox-vehicule">
                    <label for="vehicule" id="vehicule">besoin d'un vehicule</label>
                </div>

                <input type="text" name="adresse" id="adresse" placeholder="adresse">
                <div class="chec">
                    <input type="checkbox" name="hotel" id="checkbox-hotel">
                    <label for="hotel" id="hotel">besoin d'un hotel</label>

                </div>

                <textarea type="text" name="demande" id="demande">demande particuliaire</textarea>

            </form>
            <div class="grand" id="matériels">
                <?php 
                $mat = $bdd->prepare('SELECT typeM, nomM FROM CONCERT NATURAL JOIN MATERIEL WHERE idC = :id');
                $mat->bindParam(":id", $idC, PDO::PARAM_STR);
                $mat->execute();
                
                ?>
                <table>
                    <tr>
                        <th>Type du matériels </th>
                        <th>Nom</th>
                    </tr>
                    <?php while ($mate = $mat->fetch()) {
                        ?>
                        <tbody>
                            <tr>
                                <td><?php echo $mate['typeM']; ?></td>
                                <td><?php echo $mate['nomM']; ?></td>
                            </tr>
                        
                    <?php }
                    $today = getdate();
                    $today = $today['year'] . '-' . $today['mon'] . '-' . $today['mday'];
                    $max = $bdd->prepare('SELECT dateMax FROM CONCERT WHERE idC = :id');
                    if(($today < $max)||($role == "TEC")){
                        echo "<tr>
                        <td colspan='4'>+Ajouter un ligne</td></tr>";
                    } 
                    echo "<tr><td>" . $max . "</td></tr>";
                    echo "<tr><td>" . $today . "</td></tr>";
                    ?>

</tbody>
                </table>
            </div>
        </section>

    </main>
    <?php include "basPage.php" ?>
</body>
<script>
    if (document.getElementById('checkbox-vehicule').checked)
        document.getElementById('vehicule').style.visibility = visible;
    else
        document.getElementById('vehicule').style.visibility = hidden;

    if (document.getElementById('checkbox-hotel').checked)
        document.getElementById('hotel').style.visibility = visible;
    else
        document.getElementById('hotel').style.visibility = hidden;
</script>

</html>