<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    // Użytkownik nie jest zalogowany, przekieruj do strony logowania
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Profil użytkownika</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
                <?php if (isset($_SESSION['user_id'])): ?>
                    <a class="nav-link" href="profil.php">Profil</a>
                <?php else: ?>
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Profil</a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="o_nas.php">O nas</a>
            </li>
            <?php if (isset($_SESSION['user_id'])): ?>
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
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header text-center">
                    <h3>Zmiana hasła</h3>
                </div>
                <div class="card-body">
                    <form action="zmiana_hasla.php" method="post">
                        <div class="form-group">
                            <label for="old_password">Stare hasło:</label>
                            <input type="password" id="old_password" name="old_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="new_password">Nowe hasło:</label>
                            <input type="password" id="new_password" name="new_password" class="form-control" required>
                        </div>
                        <div class="form-group">
                            <label for="confirm_password">Potwierdź nowe hasło:</label>
                            <input type="password" id="confirm_password" name="confirm_password" class="form-control" required>
                        </div>
                        <button type="submit" class="btn btn-primary btn-block">Zmień hasło</button>
                    </form>
                </div>
                <div class="card-footer text-center">
                    <a href="index.php" class="btn btn-secondary btn-block">Powrót</a>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>