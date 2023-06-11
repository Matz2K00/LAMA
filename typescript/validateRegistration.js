function firstnameOK(event) {
    var firstname = document.getElementById("firstname").value.trim();
    if (!firstname) {
        showErrorR("Inserisci il nome");
    }
}
function lastnameOK(event) {
    var lastname = document.getElementById("lastname").value.trim();
    if (!lastname) {
        showErrorR("Inserisci il cognome");
        return;
    }
}
function emailOK(event) {
    var email = document.getElementById("email").value.trim();
    if (!email) {
        showErrorR("Inserisci l'email");
    }
    var emailRegex = /^(\s)*([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+(\s)*$/;
    if (!emailRegex.test(email)) {
        showErrorR("Email non valida");
    }
}
function passwordOK(event) {
    var password = document.getElementById("pass").value.trim();
    if (!password) {
        showErrorR("Inserisci la password");
    }
    if (password.length < 10) {
        showErrorR("Inserisci una password di almeno 10 caratteri");
    }
}
function confirmOK(event) {
    var confirm = document.getElementById("confirm").value.trim();
    if (!confirm) {
        showErrorR("Conferma la password");
        return;
    }
    var password = document.getElementById("password").value.trim();
    if (password !== confirm) {
        showErrorR("Le password non coincidono");
        return;
    }
}
function showErrorR(message) {
    var errorElement = document.createElement('p');
    errorElement.style.color = 'red';
    errorElement.textContent = message;
    var errorContainer = document.getElementById('showError');
    if (errorContainer) {
        errorContainer.innerHTML = '';
        errorContainer.appendChild(errorElement);
    }
}
