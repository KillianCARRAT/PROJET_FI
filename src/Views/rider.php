<?php $title = 'rider';
$lesCSS = ["Style-Rider", "basPage", "cote"];
include 'head.php'; ?>

<body>
    <?php include "cote.php" ?>
    <main id="main-rider">

        <h1>Fiche rider</h1>
        <section id="question">
            <form class="grand">

                <label for="titre">titre</label>
                <input type="text" name="titre" id="titre" placeholder="nom de l'artiste ">


                <label for="date-repr">date de representation</label>
                <input type="date" name="date-repr" id="date-repr" placeholder="date de representation">


                <label for="demande">demande particuliaire</label>
                <textarea type="text" name="demande" id="demande" size='80'></textarea>
                <div class="chec">
                    <input type="checkbox" name="veicule" id="veicule">
                    <label for="vehicule">besoin d'un vehicule</label>
                </div>

                <p>if veicule</p>
                <input type="text" name="adresse" id="adresse" placeholder="adresse">
                <div class="chec">
                    <input type="checkbox" name="hotel" id="hotel">
                    <label for="hotel">besoin d'un hotel</label>

                </div>

                <p>if hotel</p>
                <textarea type="text" name="demande" id="demande">demande particuliaire</textarea>

            </form>
            <div class="grand" id="matériels">
                <table>
                    <tr>
                        <th>Type du matériels </th>
                        <th>reference exacte</th>
                        <th>Quantitée </th>
                        <th>Commentaire</th>
                    </tr>
                    <tr>
                        <td colspan="4">+Ajouter un ligne</td>
                    </tr>
                </table>
            </div>
        </section>

    </main>
    <?php include "basPage.php" ?>
</body>

</html>