document.getElementById('Modifier').addEventListener('click', function() {
    document.getElementById('affichage-identifiant').style.display = 'none';
    document.getElementById('edition-identifiant').style.display = 'block';
});

document.getElementById('Retour').addEventListener('click', function() {
    document.getElementById('affichage-identifiant').style.display = 'block';
    document.getElementById('edition-identifiant').style.display = 'none';
});