const pagina = window.location.pathname.split('/').pop();
const links = document.querySelectorAll('.navbar__links a');

links.forEach(function(link) {
    if (link.getAttribute('href') === pagina) {
        link.classList.add('active');
    }
});

function mostraAlert(form, messaggio, tipo) {
    
    const vecchio = form.querySelector('.alert');
    if (vecchio) vecchio.remove();

    const alert = document.createElement('div');
    alert.className = 'alert alert--' + tipo;
    alert.textContent = messaggio;

    form.insertBefore(alert, form.firstChild);
}

const formRegistrazione = document.getElementById('form-registrazione');

if (formRegistrazione) {
    formRegistrazione.addEventListener('submit', function(e) {

        const nome     = document.getElementById('nome').value.trim();
        const cognome  = document.getElementById('cognome').value.trim();
        const email    = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;
        const conferma = document.getElementById('conferma').value;

        if (nome === '' || cognome === '') {
            e.preventDefault();
            mostraAlert(formRegistrazione, 'Inserisci nome e cognome.', 'error');
            return;
        }

        if (!email.includes('@')) {
            e.preventDefault();
            mostraAlert(formRegistrazione, 'Inserisci un\'email valida.', 'error');
            return;
        }

        if (password.length < 8) {
            e.preventDefault();
            mostraAlert(formRegistrazione, 'La password deve avere almeno 8 caratteri.', 'error');
            return;
        }

        if (password !== conferma) {
            e.preventDefault();
            mostraAlert(formRegistrazione, 'Le password non coincidono.', 'error');
            return;
        }

    });
}

const formLogin = document.getElementById('form-login');

if (formLogin) {
    formLogin.addEventListener('submit', function(e) {

        const email    = document.getElementById('email').value.trim();
        const password = document.getElementById('password').value;

        if (!email.includes('@')) {
            e.preventDefault();
            mostraAlert(formLogin, 'Inserisci un\'email valida.', 'error');
            return;
        }

        if (password === '') {
            e.preventDefault();
            mostraAlert(formLogin, 'Inserisci la password.', 'error');
            return;
        }

    });
}

const btnLogout = document.getElementById('btn-logout');

if (btnLogout) {
    btnLogout.addEventListener('click', function() {
        window.location.href = 'logout.php';
    });
}
