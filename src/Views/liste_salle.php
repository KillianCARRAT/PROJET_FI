<?php $title = 'Liste_Spec_Orga';
$lesCSS = ["Table_Spec", "basPage", "cote"];
include 'head.php'; ?>

<body>
    <?php include "cote.php" ?>
    <main>
        <div class="main-liste-spec">
            <h1 id="les-specs-orga">Les salles</h1>
            <table>
                <thead>
                    <tr>
                        <th scope="col">Nom</th>
                        <th scope="col">Nombre places</th>
                        <th scope="col">Nombre techniciens</th>
                        <th scope="col">Adresse</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td>Salle simone signoret</td>
                        <td>1000</td>
                        <td>10</td>
                        <td >15 avenue de la république</td>
                    </tr>
                    <tr>
                        <td>L'arsenal</td>
                        <td>500</td>
                        <td>1</td>
                        <td >8 place de sully</td>
                    </tr>
                    <tr>
                        <td>Pierre mendes france</td>
                        <td>1200</td>
                        <td>45</td>
                        <td >5 avenue camille gaté</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>
    <?php include "basPage.php" ?>
</body>
</html>