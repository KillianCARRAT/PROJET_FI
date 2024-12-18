<?php 
$title = 'rider';
$lesCSS = ["Style-Rider", "basPage", "cote"];
include 'head.php'; 
?>

<body>
    <?php include "cote.php"; ?>
    <main id="main-rider">

        <h1>Fiche rider</h1>
        <section id="question">
            <form class="grand" method="post" action="traitement.php">
                <div class="grand">
                    <?php
                    $idC = $_GET['concert'];
                    $reqType = $bdd->prepare('SELECT * FROM CONCERT NATURAL JOIN SALLE NATURAL JOIN GROUPE WHERE idC = :id');
                    $reqType->bindParam(":id", $idC, PDO::PARAM_STR);
                    $reqType->execute();
                    $donnees = $reqType->fetch();
                    ?>

                    <label for="titre">Nom</label>
                    <p><?php echo $donnees['nomG']; ?></p>

                    <label for="date-repr">Date de représentation</label>
                    <p><?php echo $donnees['dateC']; ?></p>

                    <label for="demandeP">Demande particulière</label>
                    <textarea name="demandeP" id="demandeP" size="80"></textarea>

                    <div class="chec">
                        <input type="checkbox" name="vehicule" id="checkbox-vehicule">
                        <label for="checkbox-vehicule">Besoin d'un véhicule</label>
                    </div>
                    <input type="text" name="adresse" id="adresse" placeholder="Adresse">

                    <div class="chec">
                        <input type="checkbox" name="hotel" id="checkbox-hotel">
                        <label for="checkbox-hotel">Besoin d'un hôtel</label>
                    </div>
                    <textarea name="demande-hotel" id="demande-hotel" placeholder="Demande pour l'hôtel"></textarea>
                </div>
                <div class="grand" id="matériels">
                    <?php
                    $mat = $bdd->prepare('SELECT typeM, nomM FROM CONCERT NATURAL JOIN MATERIEL WHERE idC = :id');
                    $mat->bindParam(":id", $idC, PDO::PARAM_STR);
                    $mat->execute();
                    ?>
                    
                        <table>
                            <tr>
                                <th>Type du matériel</th>
                                <th>Nom</th>
                            </tr>
                            <?php while ($mate = $mat->fetch()) { ?>
                                <tr>
                                    <td><input type="text" name="type[]" value="<?php echo htmlspecialchars($mate['typeM'], ENT_QUOTES, 'UTF-8'); ?>"></td>
                                    <td><input type="text" name="nom[]" value="<?php echo htmlspecialchars($mate['nomM'], ENT_QUOTES, 'UTF-8'); ?>"></td>
                                </tr>
                            <?php } ?>
                        </table>
                        <button type="button" id="add-line-btn">+ Ajouter une ligne</button>
                        <button type="submit">Envoyer</button>
                    </form>
                </div>
        </section>
    </main>
    <?php include "basPage.php"; ?>
</body>
<script>
    function toggleVisibility(checkboxId, targetId) {
        const checkbox = document.getElementById(checkboxId);
        const target = document.getElementById(targetId);

        target.style.display = checkbox.checked ? "block" : "none";
    }

    document.addEventListener('DOMContentLoaded', () => {
    document.getElementById('checkbox-vehicule').addEventListener('change', () => toggleVisibility('checkbox-vehicule', 'adresse'));
    document.getElementById('checkbox-hotel').addEventListener('change', () => toggleVisibility('checkbox-hotel', 'demande-hotel'));
});

    document.addEventListener('DOMContentLoaded', () => {
        const table = document.querySelector('table'); // Sélectionne le tableau
        const addLineButton = document.getElementById('add-line-btn'); // Bouton d'ajout

        if (addLineButton) {
            addLineButton.addEventListener('click', (event) => {
                event.preventDefault(); // Empêche le rechargement de la page

                // Création d'une nouvelle ligne
                const newRow = document.createElement('tr');

                // Colonne pour le type
                const typeCell = document.createElement('td');
                const typeInput = document.createElement('input');
                typeInput.type = 'text';
                typeInput.placeholder = 'Type du matériel';
                typeCell.appendChild(typeInput);

                // Colonne pour le nom
                const nameCell = document.createElement('td');
                const nameInput = document.createElement('input');
                nameInput.type = 'text';
                nameInput.placeholder = 'Nom du matériel';
                nameCell.appendChild(nameInput);

                // Ajout des colonnes à la nouvelle ligne
                newRow.appendChild(typeCell);
                newRow.appendChild(nameCell);

                // Ajout de la nouvelle ligne au tableau
                table.appendChild(newRow);
            });
        }
    });
</script>
</html>
