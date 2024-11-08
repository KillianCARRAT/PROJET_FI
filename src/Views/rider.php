<?php $title = 'rider';
$lesCSS = ["Style-Rider", "basPage", "cote"];
include 'head.php'; ?>

<body>
    <?php include "cote.php" ?>
    <main id="main-rider">

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
    function updateVisibility() {
        const checkboxVehicule = document.getElementById('checkbox-vehicule');
        const vehicule = document.getElementById('vehicule');

        if (checkboxVehicule.checked) {
            vehicule.style.visibility = "visible";
        } else {
            vehicule.style.visibility = "hidden";
        }

        const checkboxHotel = document.getElementById('checkbox-hotel');
        const hotel = document.getElementById('hotel');

        if (checkboxHotel.checked) {
            hotel.style.visibility = "visible";
        } else {
            hotel.style.visibility = "hidden";
        }
    }


    document.addEventListener('DOMContentLoaded', () => {
        updateVisibility();


        document.getElementById('checkbox-vehicule').addEventListener('change', updateVisibility);
        document.getElementById('checkbox-hotel').addEventListener('change', updateVisibility);
    });
</script>

</html>