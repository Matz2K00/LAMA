function validateFormL(event: Event) {
    event.preventDefault(); // Previene l'invio del form se ci sono errori

    const email = (document.getElementById("email") as HTMLInputElement).value.trim();
    const password = (document.getElementById("password") as HTMLInputElement).value.trim();

    // Verifica se entrambi i campi sono stati compilati
    if (!email || !password) {
        showErrorL("Inserisci sia l'indirizzo email che la password");
        return;
    }

    // Verifica se l'indirizzo email è valido utilizzando una regex semplificata
    const emailRegex = /^(\s)*([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+(\s)*$/;
    if (!emailRegex.test(email)) {
        showErrorL("Indirizzo email non valido");
        return;
    }

    // Altri controlli specifici possono essere aggiunti a seconda delle tue esigenze

    // Se tutti i controlli sono passati, invia il form
    const form = document.getElementById("loginForm") as HTMLFormElement;
    if (form) {
        form.submit();
    }
}

    function showErrorL(message: string) {
    const errorElement = document.getElementById("error");
    if (errorElement) {
        errorElement.textContent = message;
    }
}
