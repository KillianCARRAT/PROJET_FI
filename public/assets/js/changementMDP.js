document.addEventListener('DOMContentLoaded', () => {
    const toggleButton = document.getElementById('toggle-all-passwords');
    const newPasswordField = document.getElementById('new-passwd');
    const confirmPasswordField = document.getElementById('confirm-passwd');

    toggleButton.addEventListener('click', () => {
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

    if (okButton) {
        okButton.addEventListener('click', hidePopup);
    }
});