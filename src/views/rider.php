<?php
$title = 'rider';
$lesCSS = ["Style-Rider", "basPage", "cote"];
require_once 'head.php';
?>

<body>
    <?php require_once "cote.php"; ?>
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
                    <input type="hidden" name="nom" id="nom" value="<?php echo $donnees['nomG']; ?>">
                    <input type="hidden" name="idG" id="idG" value="<?php echo $donnees['idG']; ?>">
                    <input type="hidden" name="idC" id="idC" value="<?php echo $donnees['idC']; ?>">

                    <label class="gras" for="date-repr">Date de représentation</label>
                    <p><?php echo $donnees['dateC']; ?></p>
                    <input type="hidden" name="date" id="date" value="<?php $donnees['dateC']; ?>">

                    <label class="gras" for="demandeP">Demande particulière</label>
                    <textarea name="demandeP" id="demandeP" cols="80"><?= htmlspecialchars($donnees['commentaire'] ?? '') ?></textarea>
                    <div class="chec">
                        <input type="checkbox" name="vehicule" id="checkbox-vehicule" <?= !empty($donnees['besoinTransport']) ? 'checked' : ''; ?>>
                        <label class="gras" for="checkbox-vehicule">Besoin d'un véhicule</label>
                    </div>
                    <input type="text" name="adresse" id="adresse" placeholder="Adresse" value="<?= htmlspecialchars($donnees['besoinTransport'] ?? '') ?>">
                    <div class="chec">
                        <input type="checkbox" name="hotel" id="checkbox-hotel" <?= !empty($donnees['besoinHotel']) ? 'checked' : ''; ?>>
                        <label class="gras" for="checkbox-hotel">Besoin d'un hôtel</label>
                    </div>
                    <textarea name="demande-hotel" id="demande-hotel" placeholder="Demande pour l'hôtel"><?= htmlspecialchars($donnees['besoinHotel'] ?? '') ?></textarea>
                    <button type="submit" id="envoyer-rider">Envoyer</button>
                </div>
                <div class="grand" id="matériels">
                    <?php
                    $mat = $bdd->prepare('SELECT idM, nbBesoin FROM BESOIN NATURAL JOIN MATERIEL WHERE idC = :id');
                    $mat->bindParam(":id", $idC, PDO::PARAM_STR);
                    $mat->execute();
                    ?>
                    <table>
                        <tr>
                            <th>Type du matériel</th>
                            <th>Nom</th>
                            <th>je possède ?</th>
                            <th>Quantité</th>
                            <th>Action</th> <!-- Nouvelle colonne pour le bouton "Supprimer" -->
                        </tr>
                        <?php while ($mate = $mat->fetch()) {
                            $idM = $mate["idM"];
                            $info = $bdd->prepare('SELECT * FROM MATERIEL WHERE idM=:idM');
                            $info->bindParam(":idM", $idM, PDO::PARAM_STR);
                            $info->execute();
                            $info = $info->fetch();

                            $qteBesoin = $bdd->prepare('SELECT * FROM BESOIN WHERE idM=:idM AND idC=:idC');
                            $qteBesoin->bindParam(":idM", $idM, PDO::PARAM_STR);
                            $qteBesoin->bindParam(":idC", $idC, PDO::PARAM_STR);
                            $qteBesoin->execute();
                            $qteBesoin = $qteBesoin->fetch();

                            $inAvoirGroupe = $bdd->prepare('SELECT * FROM AVOIRGROUPE WHERE idM=:idM');
                            $inAvoirGroupe->bindParam(":idM", $idM, PDO::PARAM_STR);
                            $inAvoirGroupe->execute();
                            $inAvoirGroupe = $inAvoirGroupe->fetch();

                            ?>
                            <tr>
                                <td>
                                <select name="type[]">
                                        <option value="instrument" <?php echo $info['typeM'] === 'instrument' ? 'selected' : ''; ?>>Instrument</option>
                                        <option value="cable" <?php echo $info['typeM'] === 'câble' ? 'selected' : ''; ?>>Câble</option>
                                        <option value="autres" <?php echo $info['typeM'] === 'autres' ? 'selected' : ''; ?>>Autres</option>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" name="nom[]"
                                        value="<?php echo htmlspecialchars($info['nomM'], ENT_QUOTES, 'UTF-8'); ?>">
                                </td>
                                <td class="chk-container">
                                    <input type="checkbox" name="besoin[]" value="1" <?php echo !empty($inAvoirGroupe) ? 'checked' : ''; ?>>
                                </td>
                                <td>
                                    <input type="number" name="quantite[]"
                                    value="<?php echo htmlspecialchars($qteBesoin['nbBesoin'] ?? 0, ENT_QUOTES, 'UTF-8'); ?>"
                                    min="0">
                                </td>
                                <td>
                                    <button type="button" class="delete-line-btn">Supprimer</button> <!-- Bouton "Supprimer" -->
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <button type="button" id="add-line-btn">+ Ajouter une ligne</button>
            </form>
            </div>
        </section>
    </main>
    <?php require_once "basPage.php"; ?>
</body>

<script>
document.addEventListener('DOMContentLoaded', () => {
    function toggleVisibility(checkboxId, targetId) {
        const checkbox = document.getElementById(checkboxId);
        const target = document.getElementById(targetId);

        target.style.display = checkbox.checked ? "block" : "none";
    }

    toggleVisibility('checkbox-vehicule', 'adresse');
    toggleVisibility('checkbox-hotel', 'demande-hotel');

        document.getElementById('checkbox-vehicule').addEventListener('change', () => toggleVisibility('checkbox-vehicule', 'adresse'));
        document.getElementById('checkbox-hotel').addEventListener('change', () => toggleVisibility('checkbox-hotel', 'demande-hotel'));
    });

    document.addEventListener('DOMContentLoaded', () => {
        const table = document.querySelector('table');
        const addLineButton = document.getElementById('add-line-btn');

        if (addLineButton) {
            addLineButton.addEventListener('click', (event) => {
                event.preventDefault();

                const newRow = document.createElement('tr');

                const typeCell = document.createElement('td');
                const typeSelect = document.createElement('select');
                typeSelect.name = 'type[]';

                const options = ['Instrument', 'Câble', 'Autres'];
                options.forEach(optionText => {
                    const option = document.createElement('option');
                    option.value = optionText.toLowerCase();
                    option.textContent = optionText;
                    option.name = 'type[]';
                    typeSelect.appendChild(option);
                });

                typeCell.appendChild(typeSelect);

                const nameCell = document.createElement('td');
                const nameInput = document.createElement('input');
                nameInput.type = 'text';
                nameInput.placeholder = 'Nom du matériel';
                nameInput.name = 'nom[]'
                nameCell.appendChild(nameInput);

                const besoinCell = document.createElement('td');
                const besoinInput = document.createElement('input');
                besoinCell.class = "chk-container";
                besoinInput.type = 'checkbox';
                besoinInput.name = 'besoin[]';
                besoinInput.value = '1';
                besoinCell.appendChild(besoinInput);

                const quantiteCell = document.createElement('td');
                const quantiteInput = document.createElement('input');
                quantiteInput.type = 'number';
                quantiteInput.name = 'quantite[]';
                quantiteInput.placeholder = '0';
                quantiteInput.min = '0';
                quantiteCell.appendChild(quantiteInput);

                const actionCell = document.createElement('td');
                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.className = 'delete-line-btn';
                deleteButton.textContent = 'Supprimer';
                actionCell.appendChild(deleteButton);

                newRow.appendChild(typeCell);
                newRow.appendChild(nameCell);
                newRow.appendChild(besoinCell);
                newRow.appendChild(quantiteCell);
                newRow.appendChild(actionCell);

                table.appendChild(newRow);
                deleteButton.addEventListener('click', () => {
                    newRow.remove();
                });
            });
        }

        document.querySelectorAll('.delete-line-btn').forEach(button => {
            button.addEventListener('click', (event) => {
                event.target.closest('tr').remove();
            });
        });
    });

    document.addEventListener('DOMContentLoaded', () => {
        const form = document.querySelector('form.rider');

        form.addEventListener('submit', (event) => {
            const checkboxes = document.querySelectorAll('input[type="checkbox"][name="besoin[]"]');
            checkboxes.forEach((checkbox, index) => {
                if (!checkbox.checked) {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = `besoin[${index}]`;
                    hiddenInput.value = '0';
                    form.appendChild(hiddenInput);
                } else {
                    const hiddenInput = document.createElement('input');
                    hiddenInput.type = 'hidden';
                    hiddenInput.name = `besoin[${index}]`;
                    hiddenInput.value = '1';
                    form.appendChild(hiddenInput);
                }
            });
        });
    });
</script>
</html>
