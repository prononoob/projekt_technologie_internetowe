<?php
// Włączamy plik helpers.php, który obsługuje sesje i sprawdza, czy użytkownik jest zalogowany
include('helpers.php');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>O nas - Forum Kulinarne</title>
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
  <!-- Custom CSS -->
  <link rel="stylesheet" href="style.css">
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light custom-bg">
    <a class="navbar-brand" href="index.php">Kulineo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline mx-auto" action="wyszukiwanie.php" method="GET">
            <input class="form-control mr-sm-2" type="search" name="query" placeholder="Wyszukaj przepis" aria-label="Search">
            <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Szukaj</button>
        </form>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <?php if (isUserLoggedIn()): ?>
                    <a class="nav-link" href="profil.php">Profil</a>
                <?php else: ?>
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Profil</a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="o_nas.php">O nas</a>
            </li>
            <?php if (isUserLoggedIn()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="wylogowanie.php">Wyloguj</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="logowanie.html">Logowanie</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>
<div class="jumbotron jumbotron-fluid text-center bg-image">
    <div class="container hero-section-overlay">
        <h1 class="display-4">O nas</h1>
        <p class="lead hero-p">Poznaj naszą historię i dowiedz się, co nas motywuje.</p>
    </div>
</div>
<div class="bg-container">
    <div class="container">
        <h2 class="h2-cent">Nasza Misja</h2>
        <p class="text-left">
            Na Forum Kulinarnym, naszą pasją jest jedzenie. Wierzymy, że dzielenie się przepisami i kulinarne eksperymentowanie jest wyjątkowym sposobem na zbliżenie ludzi. Naszą misją jest stworzenie przestrzeni, gdzie miłośnicy jedzenia z różnych zakątków świata mogą wymieniać się swoimi ulubionymi przepisami i czerpać inspirację od innych.
        </p>
        <h2 class="h2-cent">Nasza Historia</h2>
        <p class="text-left">
            Forum Kulinarne zostało założone w 2020 roku przez grupę przyjaciół, którzy uwielbiali gotować i jeść razem. Ich celem było stworzenie platformy, na której każdy mógłby dzielić się swoimi kulinarnymi eksperymentami i wzbogacać swoje umiejętności kucharskie. Od tego czasu, nasze forum stale rośnie i teraz gościmy społeczność tysięcy użytkowników.
        </p>
        <h2 class="h2-cent">Nasza Społeczność</h2>
        <p class="text-left">
            Społeczność Forum Kulinarnego to serce naszej platformy. To dzięki naszym użytkownikom możemy oferować tak bogaty i różnorodny zestaw przepisów i porad kucharskich. Dziękujemy za Wasze wsparcie i zaangażowanie!
        </p>
        <h2 class="h2-cent">Kontakt</h2>
        <p class="text-left">
            Jeśli masz pytania lub chcesz się z nami skontaktować, napisz do nas na: kontakt@forumkulinarne.pl</a>
        </p>
    </div>
</div>
 
<footer class="footer bg-green">
    <div class="container">
        <!-- Twój footer tutaj -->
    </div>
</footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>