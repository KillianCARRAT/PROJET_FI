<?php
$title = 'matériels';
$lesCSS = ["basPage", "cote", "style-stock"];
require_once 'head.php';
?>

<body>
    <?php require_once "cote.php"; ?>
    <main id="main-stock">
        <h1>Fiche stock</h1>
        <section id="question">
            <form class="stock" method="post" action="/typeModif">
                <div class="grand" id="matériels">
                    <?php
                    $mat = $bdd->prepare('SELECT typeM, color FROM TYPEM');
                    $mat->execute();
                    ?>
                    <table>
                        <tr>
                            <th>Type du matériel</th>
                            <th>Nom du matériel</th>
                            <th></th>

                        </tr>
                        <?php while ($mate = $mat->fetch()) {
                            $typeM = $mate["typeM"];
                            $color = $mate["color"];
                            ?>
                            <tr>
                                <td>
                                    <input type="text" name="type[]"
                                        value="<?php echo htmlspecialchars($typeM, ENT_QUOTES, 'UTF-8'); ?>">
                                </td>
                                <td class="chk-container">
                                <input type="color" id="head" name="color[]" value=<?php echo $color ?> />
                                </td>
                                <td>
                                    <button type="button" class="delete-line-btn">Supprimer</button>
                                </td>
                            </tr>
                        <?php } ?>
                    </table>
                    <button type="button" id="add-line-btn">+ Ajouter une ligne</button>
                    <button type="submit" id="envoyer-stock">Valider</button>
            </form>
            </div>
        </section>
    </main>
    <?php require_once "basPage.php"; ?>
</body>

<script>
    document.addEventListener('DOMContentLoaded', () => {
        const table = document.querySelector('table');
        const addLineButton = document.getElementById('add-line-btn');

        if (addLineButton) {
            addLineButton.addEventListener('click', (event) => {
                event.preventDefault();

                const newRow = document.createElement('tr');

                const nameCell = document.createElement('td');
                const nameInput = document.createElement('input');
                nameInput.type = 'text';
                nameInput.placeholder = 'Nom du type';
                nameInput.name = 'type[]'
                nameCell.appendChild(nameInput);

                const besoinCell = document.createElement('td');
                const besoinInput = document.createElement('input');
                besoinCell.class = "chk-container";
                besoinInput.type = 'color';
                besoinInput.name = 'color[]';
                besoinCell.appendChild(besoinInput);


                const actionCell = document.createElement('td');
                const deleteButton = document.createElement('button');
                deleteButton.type = 'button';
                deleteButton.className = 'delete-line-btn';
                deleteButton.textContent = 'Supprimer';
                actionCell.appendChild(deleteButton);

                newRow.appendChild(nameCell);
                newRow.appendChild(besoinCell);
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
        const form = document.querySelector('form.stock');

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


