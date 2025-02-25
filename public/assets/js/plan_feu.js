// Sélectionne tous les objets à déplacer et leur ajoute un gestionnaire d'événements
document.querySelectorAll('.object').forEach(obj => {
    obj.addEventListener('dragstart', (e) => {
        e.dataTransfer.setData('text/plain', 'object'); // Stocke un type de donnée pour le drag & drop
        obj.classList.add('dragging'); // Ajoute une classe CSS pour signaler l'objet en déplacement
    });

    obj.addEventListener('dragend', () => {
        obj.classList.remove('dragging'); // Retire la classe CSS une fois le déplacement terminé
    });
});

// Sélectionne la zone de dépôt (dropzone)
const dropzone = document.getElementById('dropzone');

// Empêche le comportement par défaut pour permettre le drop
dropzone.addEventListener('dragover', (e) => {
    e.preventDefault(); // Par défaut, le navigateur interdit le drop. Cette ligne permet de le rendre possible.
});

// Gère l'événement lorsque l'objet est déposé
dropzone.addEventListener('drop', (e) => {
    e.preventDefault(); // Empêche le comportement par défaut du navigateur

    const draggedObject = document.querySelector('.dragging'); // Sélectionne l'objet en cours de déplacement
    if (draggedObject) {
        
        // Définit la position de l'objet cloné en fonction de la souris
        draggedObject.style.position = 'absolute';
        draggedObject.style.left = `${e.clientX - dropzone.offsetLeft}px`; // Position X relative à la dropzone
        draggedObject.style.top = `${e.clientY - dropzone.offsetTop}px`;   // Position Y relative à la dropzone
        draggedObject.classList.remove('dragging'); // Supprime la classe CSS "dragging"

        dropzone.appendChild(draggedObject); // Ajoute l'objet cloné à la dropzone

        // Rend les objets clonés déplaçables à leur tour
        draggedObject.setAttribute('draggable', 'true');
        draggedObject.addEventListener('dragstart', (e) => {
            e.dataTransfer.setData('text/plain', 'object');
            draggedObject.classList.add('dragging');
        });
        draggedObject.addEventListener('dragend', () => {
            draggedObject.classList.remove('dragging');
        });
    }
    }
);
