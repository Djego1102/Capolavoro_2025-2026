<?php
/*
    Tabella da creare nel database:

    CREATE TABLE utenti (
        id        INT AUTO_INCREMENT PRIMARY KEY,
        nome      VARCHAR(80)  NOT NULL,
        cognome   VARCHAR(80)  NOT NULL,
        email     VARCHAR(255) NOT NULL UNIQUE,
        password  VARCHAR(255) NOT NULL,
        creato_il DATETIME DEFAULT CURRENT_TIMESTAMP
    );
*/

session_start();

if (!empty($_SESSION['utente'])) {
    header('Location: areaPrivata.php');
    exit;
}

$errore  = '';
$successo = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $nome     = trim($_POST['nome']);
    $cognome  = trim($_POST['cognome']);
    $email    = trim($_POST['email']);
    $password = $_POST['password'];
    $conferma = $_POST['conferma'];

    if ($nome === '' || $cognome === '') {
        $errore = 'Nome e cognome sono obbligatori.';

    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errore = 'L\'indirizzo email non è valido.';

    } elseif (strlen($password) < 8) {
        $errore = 'La password deve avere almeno 8 caratteri.';

    } elseif ($password !== $conferma) {
        $errore = 'Le password non coincidono.';

    } else {

        $con = new PDO(
            "mysql:host=localhost;port=3306;dbname=capolavoro",
            "root",
            "2907",
            [
                PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
                PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            ],
        );

        $stmt = $con->prepare("SELECT id FROM utenti WHERE email = ?");
        $stmt->execute([$email]);
        $esistente = $stmt->fetch();

        if ($esistente) {
            $errore = 'Questa email è già registrata.';
        } else {

            $hash = password_hash($password, PASSWORD_DEFAULT);

            $stmt = $con->prepare("INSERT INTO utenti (nome, cognome, email, password) VALUES (?, ?, ?, ?)");
            $stmt->execute([$nome, $cognome, $email, $hash]);

            $successo = 'Account creato con successo! Puoi ora effettuare il login.';
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Registrazione</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <nav class="navbar">
    <span class="navbar__logo">Capolavoro 2025/2026</span>
    <ul class="navbar__links">
      <li><a href="home.html">Home</a></li>
      <li><a href="registrazione.php">Registrati</a></li>
      <li><a href="login.php">Accedi</a></li>
    </ul>
  </nav>

  <main class="page auth-page">
    <div class="auth-card">

      <h1 class="auth-card__title">Crea un account</h1>
      <p class="auth-card__sub">Registrati per accedere all'area riservata.</p>

      <form id="form-registrazione" method="POST" action="registrazione.php" novalidate>

        <div class="form-row">
          <div class="form-group">
            <label for="nome">Nome</label>
            <input type="text" id="nome" name="nome" placeholder="Inserisci nome" required />
          </div>
          <div class="form-group">
            <label for="cognome">Cognome</label>
            <input type="text" id="cognome" name="cognome" placeholder="Inserisci cognome" required />
          </div>
        </div>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="Inserisci email" required />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="Almeno 8 caratteri" required />
        </div>

        <div class="form-group">
          <label for="conferma">Conferma password</label>
          <input type="password" id="conferma" name="conferma" placeholder="Ripeti la password" required />
        </div>

        <button type="submit" class="btn btn--primary btn--full">Crea account</button>

        <p class="form-footer">
          Hai già un account? <a href="login.php">Accedi</a>
        </p>

      </form>
    </div>
  </main>

  <script src="main.js"></script>
</body>
</html>
