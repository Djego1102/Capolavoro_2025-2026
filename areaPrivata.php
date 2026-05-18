<?php

session_start();

if (empty($_SESSION['utente'])) {
    header('Location: login.php');
    exit;
}

$utente = $_SESSION['utente'];

?>
<!DOCTYPE html>
<html lang="it">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Area Privata — De Aldisio Diego</title>
  <link rel="stylesheet" href="style.css" />
</head>
<body>

  <nav class="navbar">
    <span class="navbar__logo">Capolavoro 2025/2026</span>
    <ul class="navbar__links">
      <li><a href="home.html">Home</a></li>
      <li><a href="areaPrivata.php" class="active">Area Privata</a></li>
      <li><a href="logout.php">Esci</a></li>
    </ul>
  </nav>

  <main class="page">

    <div class="private-header">
      <div class="profile-meta">

        <div class="avatar">
          DD
        </div>

        <div>
          <p class="profile-info__name">
            Diego De Aldisio
          </p>
          <span class="profile-info__badge">Area riservata</span>
        </div>

        <a href="logout.php" class="btn btn--ghost" style="margin-left: auto;">Esci</a>

      </div>
    </div>

    <div class="cv-grid">

      <div class="cv-block" style="grid-column: 1 / -1;">
        <p class="cv-block__label">Chi sono</p>
        <p class="cv-block__text">
          Sono De Aldisio Diego, un ragazzo di 19 anni che ha deciso di frequentare l'istituto tecnico
          superiore ITIS G. Vallauri. Questa scelta è avvenuta per la mia passione e interesse verso
          la tecnologia che ho sempre avuto fin da bambino e grazie a questa scuola ho avuto la possibilità
          di apprendere le basi di ciò che spero sia il mio futuro.
          Oltre alla tecnologia le mie passioni spaziano in diversi campi, come la lettura, il cinema, la musica,
          la cucina e tanto altro.
        </p>
      </div>

      <div class="cv-block">
        <p class="cv-block__label">Esperienza</p>

        <p class="cv-block__title">Attualmente nessuna esperienza lavorativa</p>
      </div>

      <div class="cv-block">
        <p class="cv-block__label">Formazione</p>

        <p class="cv-block__title">Diploma di scuola superiore</p>
        <p class="cv-block__sub">ITIS G. Vallauri · 2021 – in corso</p>

        <br>

        <p class="cv-block__title">Corsi di formazione PCTO</p>
        <p class="cv-block__sub">Eseguiti su piattaforma HackersGen, Samsung, cittadinanza ed Educazione Civica</p>
      </div>

      <div class="cv-block">
        <p class="cv-block__label">Competenze tecniche</p>
        <div class="tag-list">
          <span class="tag">HTML / CSS</span>
          <span class="tag">JavaScript</span>
          <span class="tag">PHP</span>
          <span class="tag">MySQL</span>
          <span class="tag">Java</span>
        </div>
      </div>

      <div class="cv-block">
        <p class="cv-block__label">Lingue e Soft Skills</p>

        <p class="cv-block__title">Italiano</p>
        <p class="cv-block__sub">Madrelingua</p>

        <br>

        <p class="cv-block__title">Inglese</p>
        <p class="cv-block__sub">B1 / B2</p>

        <br>

        <p class="cv-block__title">Soft Skills</p>
        <p class="cv-block__sub">Problem solving, organizzazione e pianificazione, teamwork, capacità di leadership</p>
      </div>

      <div class="cv-block" style="grid-column: 1 / -1;">
        <p class="cv-block__label">Contatti</p>
        <div style="display: flex; flex-wrap: wrap; gap: 2rem;">
          <div>
            <p style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.3rem;">Email</p>
            <a href="mailto:marco.rossi@email.com">diegdealdisio@gmail.com</a>
          </div>
          <div>
            <p style="font-size: 0.75rem; text-transform: uppercase; color: var(--text-muted); margin-bottom: 0.3rem;">Instagram</p>
            <a href="https://linkedin.com" target="_blank">instagram.com/djego_11</a>
          </div>
        </div>
      </div>

    </div>
  </main>

  <footer>
    <p>&copy; 2026 De Aldisio Diego — 5F ITIS G. Vallauri</p>
  </footer>

  <script src="main.js"></script>
</body>
</html>
