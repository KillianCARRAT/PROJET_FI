document.querySelectorAll('.toggle-password').forEach(button => {
    button.addEventListener('click', () => {
        const targetId = button.getAttribute('data-target');
        const passwordField = document.getElementById(targetId);
        if (passwordField.type === 'password') {
            passwordField.type = 'text';
            button.textContent = 'Cacher';
        } else {
            passwordField.type = 'password';
            button.textContent = 'Afficher';
        }
    });
});