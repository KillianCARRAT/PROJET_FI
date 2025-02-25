// Sélectionne tous les objets à déplacer et leur ajoute un gestionnaire d'événements
document.querySelectorAll('.object').forEach(obj => {
    obj.addEventListener('dragstart', (e) => {
        let qte = parseInt(obj.getAttribute('data-qte'));
        if (qte > 0) {
            e.dataTransfer.setData('text/plain', obj.getAttribute('data-name')); // Stocke le nom de l'objet
            obj.classList.add('dragging'); // Ajoute la classe CSS
        } else {
            e.preventDefault(); // Empêche le drag si la quantité est 0
        }
    });

    obj.addEventListener('dragend', () => {
        obj.classList.remove('dragging');
    });
});

// Sélectionne la zone de dépôt (dropzone)
const dropzone = document.getElementById('dropzone');

// Empêche le comportement par défaut pour permettre le drop
dropzone.addEventListener('dragover', (e) => {
    e.preventDefault();
});

// Gère l'événement lorsque l'objet est déposé
dropzone.addEventListener('drop', (e) => {
    e.preventDefault();
    const objectName = e.dataTransfer.getData('text/plain');
    let draggedObject = document.querySelector(`.object[data-name='${objectName}']`);

    if (draggedObject) {
        let qte = parseInt(draggedObject.getAttribute('data-qte'));

        if (qte > 0) {
            qte--; // Diminue la quantité
            draggedObject.setAttribute('data-qte', qte);
            draggedObject.innerHTML = `${objectName} (${qte})`;

            if (qte === 0) {
                draggedObject.style.opacity = "0.5"; // Rend l'objet semi-transparent quand il est épuisé
                draggedObject.draggable = false;
            }

            // Création d'une copie et ajout dans la dropzone
            let clone = document.createElement('div');
            clone.classList.add('object', draggedObject.classList[1]); // Ajoute la classe de type
            clone.textContent = objectName;
            clone.style.position = 'absolute';
            clone.style.left = `${e.clientX - dropzone.offsetLeft}px`;
            clone.style.top = `${e.clientY - dropzone.offsetTop}px`;
            dropzone.appendChild(clone);
        }
    }
});