
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

    const objectId = e.dataTransfer.getData('text/plain'); // Récupère l'ID unique de l'objet
    let draggedObject = document.querySelector(`.object[data-id='${objectId}']`);
    
    // Vérifier si c'est un clone ou un original basé sur `data-id`
    if (!draggedObject) {
        draggedObject = document.querySelector(`.object[data-name='${objectId}']`);
    }

    if (draggedObject) {
        // Si c'est un objet original (base)
        if (draggedObject.classList.contains("base")) {
            let qte = parseInt(draggedObject.getAttribute('data-qte'));

            if (qte > 0) {
                qte--; // Diminue la quantité de l'original
                draggedObject.setAttribute('data-qte', qte);

                // Mise à jour du <p> associé
                let quantityText = document.querySelector(`.quantity-display[data-name='${objectId}']`);
                if (quantityText) {
                    quantityText.innerText = `${qte}X`;
                }

                // Si la quantité atteint 0, désactiver le drag pour l'original SEULEMENT
                if (qte === 0) {
                    draggedObject.style.opacity = "0.5"; // Rend l'original semi-transparent
                    draggedObject.draggable = false;
                }

                // Création d'un clone et ajout dans la dropzone
                let clone = document.createElement('div');
                clone.classList.add('object', 'clone'); // Ajoute "clone" pour différencier les copies
                clone.classList.add(...Array.from(draggedObject.classList).filter(cls => cls !== 'base')); // Garde les classes sauf "base"

                clone.textContent = objectId;
                clone.style.position = 'absolute';
                clone.style.left = `${e.clientX - dropzone.offsetLeft}px`;
                clone.style.top = `${e.clientY - dropzone.offsetTop}px`;
                clone.style.opacity = "1";

                // Ajouter un ID unique pour chaque clone
                let uniqueId = `clone-${Math.random().toString(36).substr(2, 9)}`;
                clone.setAttribute("data-id", uniqueId);
                clone.setAttribute('draggable', 'true');

                // Ajouter des événements de drag pour le clone
                clone.addEventListener('dragstart', (e) => {
                    e.dataTransfer.setData('text/plain', uniqueId);
                    clone.classList.add('dragging');
                });

                clone.addEventListener('dragend', () => {
                    clone.classList.remove('dragging');
                });

                dropzone.appendChild(clone);
            }
        } else {
            // Permettre aux clones de se déplacer dans la dropzone SANS les dupliquer
            draggedObject.style.left = `${e.clientX - dropzone.offsetLeft}px`;
            draggedObject.style.top = `${e.clientY - dropzone.offsetTop}px`;

            // S'assurer que les clones ont bien un ID unique et restent draggables
            if (!draggedObject.hasAttribute("data-id")) {
                let uniqueId = `clone-${Math.random().toString(36).substr(2, 9)}`;
                draggedObject.setAttribute("data-id", uniqueId);
            }

            draggedObject.setAttribute('draggable', 'true');

            // Ajouter ou réaffirmer les événements pour le déplacement des clones
            draggedObject.addEventListener('dragstart', (e) => {
                e.dataTransfer.setData('text/plain', draggedObject.getAttribute("data-id"));
                draggedObject.classList.add('dragging');
            });

            draggedObject.addEventListener('dragend', () => {
                draggedObject.classList.remove('dragging');
            });
        }
    }
});

// Ajouter les événements `dragstart` aux objets initiaux
document.querySelectorAll('.object').forEach(obj => {
    obj.addEventListener('dragstart', (e) => {
        let objId = obj.getAttribute("data-id") || obj.getAttribute("data-name"); // ID unique ou nom original
        e.dataTransfer.setData('text/plain', objId);
        obj.classList.add('dragging');
    });

    obj.addEventListener('dragend', () => {
        obj.classList.remove('dragging');
    });
});


document.getElementById("boutonCapture").addEventListener("click", function () {
    html2canvas(dropzone).then(canvas => {
        let imageC = canvas.toDataURL("image/png");
        let idC = document.getElementById("idC").value;


        fetch("/sauvegarder_screen", {
            method: "POST",
            body: JSON.stringify({ 
                image: imageC,
                idC: idC
            }),
            headers: { "Content-Type": "application/json" }
        })
        .then(response => response.text())
        .then(data=>{window.location.href = "/Ac_Art";})

    }).catch(error => console.error(" Erreur html2canvas :", error));
});
