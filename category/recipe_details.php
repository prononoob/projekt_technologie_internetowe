<?php
include 'db_connection.php'; // Połączenie z bazą danych
include('helpers.php');

$recipe_id = isset($_GET['recipe_id']) ? intval($_GET['recipe_id']) : 0;

if ($recipe_id <= 0) {
    echo "Nieprawidłowy identyfikator przepisu.";
    exit;
}

// Zapytanie SQL
$sql = "SELECT * FROM recipes WHERE recipe_id = $recipe_id";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    $recipe = $result->fetch_assoc();
} else {
    echo "Przepis nie został znaleziony.";
    exit;
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <title><?php echo htmlspecialchars($recipe['title']); ?></title>
</head>
<body class="bg-container">
<nav class="navbar navbar-expand-lg navbar-light custom-bg">
    <a class="navbar-brand" href="../index.php">Kulineo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <form class="form-inline mx-auto" action="../wyszukiwanie.php" method="GET">
    <input class="form-control mr-sm-2" type="search" name="query" placeholder="Wyszukaj przepis" aria-label="Search">
    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Szukaj</button>
</form>
        <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
                <?php if (isUserLoggedIn()): ?>
                    <a class="nav-link" href="../profil.php">Profil</a>
                <?php else: ?>
                    <a class="nav-link disabled" href="#" tabindex="-1" aria-disabled="true">Profil</a>
                <?php endif; ?>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="o_nas.php">O nas</a>
            </li>
            <?php if (isUserLoggedIn()): ?>
                <li class="nav-item">
                    <a class="nav-link" href="../wylogowanie.php">Wyloguj</a>
                </li>
            <?php else: ?>
                <li class="nav-item">
                    <a class="nav-link" href="../logowanie.html">Logowanie</a>
                </li>
            <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="container">
    <h1 class="h2-cent"><?php echo htmlspecialchars($recipe['title']); ?></h1>
    <div class="card">
        <div class="card-body">
            <p><strong>Opis:</strong> <?php echo nl2br(htmlspecialchars($recipe['description'])); ?></p>
            <p><strong>Składniki:</strong> <?php echo nl2br(htmlspecialchars($recipe['ingredients'])); ?></p>
            <p><strong>Instrukcje:</strong> <?php echo nl2br(htmlspecialchars($recipe['instructions'])); ?></p>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>