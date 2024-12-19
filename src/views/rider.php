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
            <form class="rider" method="post" action="<?php CONTROLLERS_PATH; ?>/info-rider">
                <div class="grand">
                    <?php
                    $idC = $_GET['concert'];
                    $reqType = $bdd->prepare('SELECT * FROM CONCERT NATURAL JOIN SALLE NATURAL JOIN GROUPE WHERE idC = :id');
                    $reqType->bindParam(":id", $idC, PDO::PARAM_STR);
                    $reqType->execute();
                    $donnees = $reqType->fetch();
                    ?>

                    <label class="gras" for="titre">Nom</label>
                    <p><?php echo $donnees['nomG']; ?></p>
                    <input type="hidden" name="nom" id="nom" value="<?php $donnees['nomG']; ?>">


                    <label class="gras" for="date-repr">Date de représentation</label>
                    <p><?php echo $donnees['dateC']; ?></p>
                    <input type="hidden" name="date" id="date" value="<?php $donnees['dateC']; ?>">

                    <label class="gras" for="demandeP">Demande particulière</label>
                    <textarea name="demandeP" id="demandeP" size="80"></textarea>

                    <div class="chec">
                        <input type="checkbox" name="vehicule" id="checkbox-vehicule">
                        <label class="gras" for="checkbox-vehicule">Besoin d'un véhicule</label>
                    </div>
                    <input type="text" name="adresse" id="adresse" placeholder="Adresse">

                    <div class="chec">
                        <input type="checkbox" name="hotel" id="checkbox-hotel">
                        <label class="gras" for="checkbox-hotel">Besoin d'un hôtel</label>
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
                            <th>je possède ?</th>
                            <th>Quantité</th>
                        </tr>
                        <?php while ($mate = $mat->fetch()) { ?>
                            <tr>
                                <td>
                                    <select name="type[]">
                                        <option value="instrument" <?php echo $mate['typeM'] === 'Instrument' ? 'selected' : ''; ?>>Instrument</option>
                                        <option value="cable" <?php echo $mate['typeM'] === 'Câble' ? 'selected' : ''; ?>>Câble</option>
                                        <option value="autres" <?php echo $mate['typeM'] === 'Autres' ? 'selected' : ''; ?>>Autres</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="nom[]" value="<?php echo htmlspecialchars($mate['nomM'], ENT_QUOTES, 'UTF-8'); ?>">
                                </td>
                                <td class="chk-container">
                                    <input type="checkbox" name="besoin[]" value="1" <?php echo !empty($mate['besoin']) && $mate['besoin'] ? 'checked' : ''; ?>>
                                </td>
                                <td>
                                    <input type="number" name="quantite[]" value="<?php echo htmlspecialchars($mate['quantite'] ?? 0, ENT_QUOTES, 'UTF-8'); ?>" min="0">
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <button type="button" id="add-line-btn">+ Ajouter une ligne</button>
                    <button type="submit" id="infos-rider">Envoyer</button>
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
                const typeSelect = document.createElement('select');

                const options = ['Instrument', 'Câble', 'Autres'];
                options.forEach(optionText => {
                    const option = document.createElement('option');
                    option.value = optionText.toLowerCase(); // Valeur en minuscule
                    option.textContent = optionText;
                    typeSelect.appendChild(option);
                });

                typeCell.appendChild(typeSelect);

                // Colonne pour le nom
                const nameCell = document.createElement('td');
                const nameInput = document.createElement('input');
                nameInput.type = 'text';
                nameInput.placeholder = 'Nom du matériel';
                nameCell.appendChild(nameInput);

                // Colonne pour la checkbox "Besoin"
                const besoinCell = document.createElement('td');
                const besoinInput = document.createElement('input');
                besoinCell.class = "chk-container";
                besoinInput.type = 'checkbox';
                besoinInput.name = 'besoin[]';
                besoinInput.value = '1';
                besoinCell.appendChild(besoinInput);

                // Colonne pour la quantité
                const quantiteCell = document.createElement('td');
                const quantiteInput = document.createElement('input');
                quantiteInput.type = 'number';
                quantiteInput.name = 'quantite[]';
                quantiteInput.placeholder = '0';
                quantiteInput.min = '0';
                quantiteCell.appendChild(quantiteInput);

                newRow.appendChild(typeCell);
                newRow.appendChild(nameCell);
                newRow.appendChild(besoinCell);
                newRow.appendChild(quantiteCell);

                table.appendChild(newRow);
            });
        }
    });
</script>

</html>