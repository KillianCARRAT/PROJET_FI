document.getElementById('toggle-all-passwords').addEventListener('click', () => {
    const newPasswordField = document.getElementById('new-passwd');
    const confirmPasswordField = document.getElementById('confirm-passwd');
    const toggleButton = document.getElementById('toggle-all-passwords');

    if (newPasswordField.type === 'password' || confirmPasswordField.type === 'password') {
        newPasswordField.type = 'text';
        confirmPasswordField.type = 'text';
        toggleButton.textContent = 'Cacher';
    } else {
        newPasswordField.type = 'password';
        confirmPasswordField.type = 'password';
        toggleButton.textContent = 'Afficher';
    }
});

const popup = document.getElementById('popup');
const okButton = document.getElementById('popup-ok');

function hidePopup() {
    popup.classList.remove('show');
}
okButton.addEventListener('click', hidePopup);