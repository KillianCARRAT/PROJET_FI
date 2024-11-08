<?php $title = 'rider';
$lesCSS = ["Style-Rider", "basPage", "cote"];
include 'head.php'; ?>

<body>
    <?php include "cote.php" ?>
    <main id="main-rider">
        <?php $reponse = $bdd->query('select * from GROUPE NATURAL JOIN CONCERT NATURAL JOIN MATERIEL where idG=' . $idArt); ?>
        <h1>Fiche rider</h1>
        <section id="question">
            <form class="grand">

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
                <table>
                    <tr>
                        <th>Type du matériels </th>
                        <th>Nom</th>
                    </tr>
                    <?php while ($donnees = $reponse->fetch()) {
                        ?>
                        <tbody>
                            <tr>
                                <th><?php echo $donnees['typeM']; ?></th>
                                <th><?php echo $donnees['nomM']; ?></th>
                            </tr>
                        </tbody>
                    <?php } ?>

                    <tr>
                        <td colspan="4">+Ajouter un ligne</td>
                    </tr>
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