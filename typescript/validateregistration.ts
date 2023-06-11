function firstnameOK(event: Event): void {
    const firstname = (document.getElementById("firstname") as HTMLInputElement).value.trim();
    if (!firstname) {
        showErrorR("Inserisci il nome");
    }
}

function lastnameOK(event: Event): void {
    const lastname = (document.getElementById("lastname") as HTMLInputElement).value.trim();
    if (!lastname) {
        showErrorR("Inserisci il cognome");
        return;
    }
}

function emailOK(event: Event): void {
    const email = (document.getElementById("email") as HTMLInputElement).value.trim();
    if (!email) {
        showErrorR("Inserisci l'email");
    }
    const emailRegex = /^(\s)*([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+(\s)*$/;
    if (!emailRegex.test(email)) {
        showErrorR("Email non valida");
    } 
}

function passwordOK(event: Event): void {
    const password = (document.getElementById("pass") as HTMLInputElement).value.trim();
    if (!password) {
        showErrorR("Inserisci la password");
    }
    if (password.length < 10) {
        showErrorR("Inserisci una password di almeno 10 caratteri");
    }
}

function confirmOK(event: Event): void {
    const confirm = (document.getElementById("confirm") as HTMLInputElement).value.trim();
    if (!confirm) {
        showErrorR("Conferma la password");
        return;
    }
    const password = (document.getElementById("password") as HTMLInputElement).value.trim();
    if (password !== confirm) {
        showErrorR("Le password non coincidono");
        return;
    }
}

function showErrorR(message: string): void {
    const errorElement = document.createElement('p');
    errorElement.style.color = 'red';
    errorElement.textContent = message;

    const errorContainer = document.getElementById('showError');
    if (errorContainer) {
        errorContainer.innerHTML = '';
        errorContainer.appendChild(errorElement);
    }

}
