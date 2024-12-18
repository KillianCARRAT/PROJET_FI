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
                    <div >
                        <label for="vehicule"> besoin d'un vehicule</label>
                    </div>
                </div>

                <input type="text" name="adresse" id="adresse" placeholder="adresse">
                <div class="chec">
                    <input type="checkbox" name="hotel" id="checkbox-hotel">
                    <label for="hotel" id="hotel">besoin d'un hotel</label>

                </div>

                <textarea type="text" name="demande" id="demande" placeholder="demande particuliaire"></textarea>

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
<<<<<<< HEAD:src/Views/rider.php
                    <?php while ($mate = $mat->fetch()) {
                        ?>
=======
                    <?php while ($donnees = $reponse->fetch()) {
                    ?>
>>>>>>> baf3f50ad0131098c1ef02f699ca82c305e7ac4c:src/views/rider.php
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
<script src="../../public/assets/js/rider.js"></script>

</html>