function firstnameOK(event: Event) {
    const firstname = (document.getElementById("firstname") as HTMLInputElement).value.trim();
    if (!firstname) {
        showErrorR("Inserisci il nome");
        return;
    }
}

function lastnameOK(event: Event) {
    const lastname = (document.getElementById("lastname") as HTMLInputElement).value.trim();
    if (!lastname) {
        showErrorR("Inserisci il cognome");
        return;
    }
}

function emailOK(event: Event) {
    const email = (document.getElementById("email") as HTMLInputElement).value.trim();
    if (!email) {
        showErrorR("Inserisci l'email");
        return;
    }
    const emailRegex = /^(\s)*([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+(\s)*$/;
    if (!emailRegex.test(email)) {
        showErrorR("Email non valida");
        return;
    } 
}

function passwordOK(event: Event) {
    const password = (document.getElementById("pass") as HTMLInputElement).value.trim();
    if (!password) {
        showErrorR("Inserisci la password");
        return;
    }
    if (password.length < 10) {
        showErrorR("Inserisci una password di almeno 10 caratteri");
        return;
    }
}

function confirmOK(event: Event) {
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

// Funzione per mostrare un messaggio di errore
function showErrorR(message: string) {
    const errorElement = document.getElementById("error");
    if (errorElement) {
        errorElement.textContent = message;
    }
}
