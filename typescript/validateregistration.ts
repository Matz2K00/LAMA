function validateFormR(event: Event) {
    event.preventDefault(); // Previene l'invio del form se ci sono errori

    const firstname = (document.getElementById("firstname") as HTMLInputElement).value.trim();
    const lastname = (document.getElementById("lastname") as HTMLInputElement).value.trim();
    const email = (document.getElementById("email") as HTMLInputElement).value.trim();
    const password = (document.getElementById("password") as HTMLInputElement).value.trim();
    const confirm = (document.getElementById("confirm") as HTMLInputElement).value.trim();

    // Verifica se tutti i campi sono stati compilati
    if (!firstname || !lastname || !email || !password || !confirm) {
        showErrorR("Inserisci tutti i dati nel form");
        return;
    }

    const emailRegex = /^(\s)*([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+(\s)*$/;
    if (!emailRegex.test(email)) {
        showErrorR("Email non valida");
        return;
    }   

    // Verifica la lunghezza della password
    if (password.length < 10) {
        showErrorR("Inserisci una password di almeno 10 caratteri");
        return;
    }

    // Verifica se la password e la conferma corrispondono
    if (password !== confirm) {
        showErrorR("Le password non coincidono");
        return;
    }

    // Se tutti i controlli sono passati, invia il form
    const form = document.getElementById("signupForm") as HTMLFormElement;
    if (form) {
        form.submit();
    }
}

// Funzione per mostrare un messaggio di errore
function showErrorR(message: string) {
    const errorElement = document.getElementById("error");
    if (errorElement) {
        errorElement.textContent = message;
    }
}

