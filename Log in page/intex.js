const passwordInput = document.querySelector('#password');
const toggleButton = document.querySelector('.password-toggle');

if (toggleButton && passwordInput) {
    toggleButton.addEventListener('click', () => {
        const isPassword = passwordInput.type === 'password';
        passwordInput.type = isPassword ? 'text' : 'password';
        toggleButton.setAttribute('aria-label', isPassword ? 'Hide password' : 'Show password');
        toggleButton.classList.toggle('active', isPassword);
    });
}
