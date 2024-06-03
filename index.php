<?php
// Włączamy plik helpers.php, który obsługuje sesje i sprawdza, czy użytkownik jest zalogowany
include('helpers.php');
?>

<!DOCTYPE html>
<html lang="pl">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Forum Kulinarne</title>
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
        <h1 class="display-4">Witaj na Forum Kulinarnym!</h1>
        <p class="lead hero-p">Odkrywaj nowe przepisy i dziel się swoimi ulubionymi kulinarnymi pomysłami.</p>
    </div>
</div>
<div class="bg-container">
    <div class="container">
        <h2 class="h2-cent">Nagłówek sekcji</h2>
        <p class="text-left">
            Eos hic tenetur quibusdam ea. Occaecati omnis et in eligendi commodi deleniti. Exercitationem id aut quasi iste.
            
            Et nam debitis et ea et vel aut. Rem rem aperiam quod ut iusto. Quam necessitatibus est ut quas et. Voluptas et voluptas vitae cum. Dolorem odit ducimus impedit vel.
            
            Autem distinctio accusantium est nihil vitae. Quae officiis id ea iste sequi occaecati unde aut. Culpa deleniti fugit omnis accusamus. Asperiores odio aliquam temporibus. Adipisci rerum fuga dolore sunt quia quod. Delectus rerum facere adipisci vel mollitia sint numquam quos.
            
            Aut qui qui hic et nulla. Rerum quod non deleniti earum consequatur impedit et. Doloribus cupiditate sed nihil maxime.
            
            Sapiente occaecati magni sequi. Maiores a sint et omnis totam. Accusamus neque magnam qui molestiae non inventore. Quisquam voluptas velit velit eius. Maxime non quam totam et ut dolores.
        </p>
    </div>
</div>
 
 <div class="container my-5">
        <h2 class="text-center mb-4 h2-cent">Popularne kategorie</h2>
        <div class="row">
            <!-- Kafelki kategorii -->
            <div class="col-6 col-md-3 mb-3">
                <a href="category/przystawki_i_przekaski.php" class="category-tile d-flex align-items-center justify-content-center custom-text-color">Przystawki i przekąski</a>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <a href="category/zupy.php" class="category-tile d-flex align-items-center justify-content-center custom-text-color">Zupy</a>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <a href="category/dania_glowne.php" class="category-tile d-flex align-items-center justify-content-center custom-text-color">Dania główne</a>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <a href="category/desery.php" class="category-tile d-flex align-items-center justify-content-center custom-text-color">Desery</a>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <a href="category/salatki.php" class="category-tile d-flex align-items-center justify-content-center custom-text-color">Sałatki</a>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <a href="category/napoje.php" class="category-tile d-flex align-items-center justify-content-center custom-text-color">Napoje</a>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <a href="category/wegetarianskie_i_weganskie.php" class="category-tile d-flex align-items-center justify-content-center custom-text-color">Wegetariańskie i wegańskie</a>
            </div>
            <div class="col-6 col-md-3 mb-3">
                <a href="category/dania_miedzynarodowe.php" class="category-tile d-flex align-items-center justify-content-center custom-text-color">Dania międzynarodowe</a>
            </div>
        </div>
    </div>
<!-- Reszta zawartości strony tutaj -->
 <footer class="footer bg-green">
        <div class="container">
           
        </div>
    </footer>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>