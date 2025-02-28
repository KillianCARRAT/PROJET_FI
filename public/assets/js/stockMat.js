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