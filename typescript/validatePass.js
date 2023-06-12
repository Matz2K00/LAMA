function oldPasswordOKP(event) {
    var oldPassword = document.getElementById("oldpass").value.trim();
    if (!oldPassword) {
        showErrorP("Inserisci la password");
    }
    if (oldPassword.length < 10) {
        showErrorP("La vecchia password è lunga almeno 10 caratteri");
    }
}
function newPasswordOKP(event) {
    var newPassword = document.getElementById("newpass").value.trim();
    if (!newPassword) {
        showErrorP("Inserisci la password");
    }
    if (newPassword.length < 10) {
        showErrorP("Inserisci una password di almeno 10 caratteri");
    }
}
function confirmOKP(event) {
    var confirm = document.getElementById("confirm").value.trim();
    if (!confirm) {
        showErrorP("Conferma la password");
        return;
    }
    var password = document.getElementById("password").value.trim();
    if (password !== confirm) {
        showErrorP("Le password non coincidono");
        return;
    }
}
function showErrorP(message) {
    var errorElement = document.createElement('p');
    errorElement.style.color = 'red';
    errorElement.textContent = message;
    var errorContainer = document.getElementById('showError');
    if (errorContainer) {
        errorContainer.innerHTML = '';
        errorContainer.appendChild(errorElement);
    }
}
