function emailOKL(event: Event): void {
    const email = (document.getElementById("email") as HTMLInputElement).value.trim();
    if (!email) {
        showErrorL("Inserisci l'email");
    }
    const emailRegex = /^(\s)*([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+(\s)*$/;
    if (!emailRegex.test(email)) {
        showErrorL("Indirizzo email non valido");
        return;
    }
}

function passwordOKL(event: Event): void {
    const password = (document.getElementById("pass") as HTMLInputElement).value.trim();
    if (!password) {
        showErrorL("Inserisci la password");
    }
    if (password.length < 10) {
        showErrorL("Inserisci una password di almeno 10 caratteri");
    }
}

function showErrorL(message: string) {
    const errorElement = document.createElement('p');
    errorElement.style.color = 'red';
    errorElement.textContent = message;

    const errorContainer = document.getElementById('showError');
    if (errorContainer) {
        errorContainer.innerHTML = '';
        errorContainer.appendChild(errorElement);
    }

}
