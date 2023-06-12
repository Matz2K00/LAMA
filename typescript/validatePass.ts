function oldPasswordOKP(event: Event): void {
    const oldPassword = (document.getElementById("oldpass") as HTMLInputElement).value.trim();
    if (!oldPassword) {
        showErrorP("Inserisci la password");
    }
    if (oldPassword.length < 10) {
        showErrorP("La vecchia password è lunga almeno 10 caratteri");
    }
}

function newPasswordOKP(event: Event): void {
    const newPassword = (document.getElementById("newpass") as HTMLInputElement).value.trim();
    if (!newPassword) {
        showErrorP("Inserisci la password");
    }
    if (newPassword.length < 10) {
        showErrorP("Inserisci una password di almeno 10 caratteri");
    }
}

function confirmOKP(event: Event): void {
    const confirm = (document.getElementById("confirm") as HTMLInputElement).value.trim();
    if (!confirm) {
        showErrorP("Conferma la password");
        return;
    }
    const password = (document.getElementById("password") as HTMLInputElement).value.trim();
    if (password !== confirm) {
        showErrorP("Le password non coincidono");
        return;
    }
}

function showErrorP(message: string): void {
    const errorElement = document.createElement('p');
    errorElement.style.color = 'red';
    errorElement.textContent = message;

    const errorContainer = document.getElementById('showError');
    if (errorContainer) {
        errorContainer.innerHTML = '';
        errorContainer.appendChild(errorElement);
    }

}