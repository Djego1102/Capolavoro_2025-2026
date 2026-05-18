<?php

session_start();

if (!empty($_SESSION['utente'])) {
    header('Location: areaPrivata.php');
    exit;
}

$errore = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $email    = trim($_POST['email']);
    $password = $_POST['password'];

    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errore = 'Inserisci un\'email valida.';

    } elseif ($password === '') {
        $errore = 'Inserisci la password.';

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

        $stmt = $con->prepare("SELECT * FROM utenti WHERE email = ?");
        $stmt->execute([$email]);
        $utente = $stmt->fetch();

        if (!$utente || !password_verify($password, $utente['password'])) {
            $errore = 'Email o password non corretti.';
        } else {

            $_SESSION['utente'] = [
                'id'      => $utente['id'],
                'nome'    => $utente['nome'],
                'cognome' => $utente['cognome'],
                'email'   => $utente['email'],
            ];

            header('Location: areaPrivata.php');
            exit;
        }
    }
}
?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Accedi</title>
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

      <h1 class="auth-card__title">Bentornato</h1>
      <p class="auth-card__sub">Accedi per visualizzare l'area riservata.</p>

      <?php if ($errore): ?>
        <div class="alert alert--error"><?= htmlspecialchars($errore) ?></div>
      <?php endif; ?>

      <form id="form-login" method="POST" action="login.php" novalidate>

        <div class="form-group">
          <label for="email">Email</label>
          <input type="email" id="email" name="email" placeholder="La tua email" required />
        </div>

        <div class="form-group">
          <label for="password">Password</label>
          <input type="password" id="password" name="password" placeholder="La tua password" required />
        </div>

        <button type="submit" class="btn btn--primary btn--full">Accedi</button>

        <p class="form-footer">
          Non hai ancora un account? <a href="registrazione.php">Registrati</a>
        </p>

      </form>
    </div>
  </main>

  <script src="main.js"></script>
</body>
</html>
