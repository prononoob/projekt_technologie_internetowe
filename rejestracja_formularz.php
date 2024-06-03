<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rejestracja</title>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
    <style>
        .error {
            color: red;
        }
    </style>
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
            
        </div>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <div class="card-header text-center">
                        <h3>Formularz rejestracji</h3>
                    </div>
                    <div class="card-body">
                        <form action="rejestracja.php" method="POST">
                            <div class="form-group">
                                <label for="username">Nazwa użytkownika:</label>
                                <input type="text" class="form-control" id="username" name="username" required>
                            </div>
                            <div class="form-group">
                                <label for="email">E-mail:</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            <div class="form-group">
                                <label for="password">Hasło:</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            <div class="form-group">
                                <label for="confirm_password">Potwierdź hasło:</label>
                                <input type="password" class="form-control" id="confirm_password" name="confirm_password" required>
                            </div>
                            <div class="form-group form-check">
                                <input type="checkbox" class="form-check-input" id="accept_terms" name="accept_terms" required>
                                <label class="form-check-label" for="accept_terms">Akceptuję regulamin</label>
                            </div>
                           
                            <!-- PHP kod do wyświetlania błędów -->
                            <?php
                            session_start();
                            if (isset($_SESSION['errors']) && !empty($_SESSION['errors'])) {
                                echo '<div id="error_message" class="error">';
                                foreach ($_SESSION['errors'] as $error) {
                                    echo "<div>".htmlspecialchars($error)."</div>";
                                }
                                echo '</div><br>';
                                // Wyczyszczenie błędów po ich wyświetleniu
                                unset($_SESSION['errors']);
                            }
                            ?>
                            <button type="submit" class="btn btn-primary btn-block">Zarejestruj</button>
                        </form>
                    </div>
                    <div class="card-footer text-center">
                        <p>Masz już konto?</p>
                        <a href="logowanie.html" class="btn btn-secondary btn-block">Zaloguj się</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.5.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>