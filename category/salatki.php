<?php
include 'db_connection.php'; // Połączenie z bazą danych
include('helpers.php');

$category_id = 5;

// Zapytanie SQL
$sql = "SELECT recipe_id, title, description FROM recipes WHERE category_id = $category_id"; // Wyświetlamy tylko recipe_id, title i description
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="../style.css" rel="stylesheet">
    <title>Sałatki</title>
</head>
<body>
<nav class="navbar navbar-expand-lg navbar-light custom-bg">
    <a class="navbar-brand" href="../index.php">Kulineo</a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
   
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
        <form class="form-inline mx-auto">
        <input class="form-control mr-sm-2" type="search" placeholder="Wyszukaj przepis" aria-label="Search">
        <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Szukaj</button>
        </form>
        <ul class="navbar-nav ml-auto">
        <li class="nav-item active">
            <a class="nav-link" href="profil.php">Profil</a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="#">O nas</a>
        </li>
        <?php if (isUserLoggedIn()): ?>
            <li class="nav-item">
                <a class="nav-link" href="../wylogowanie.php">Wyloguj</a>
            </li>
        <?php else: ?>
            <li class="nav-item">
                <a class="nav-link" href="logowanie.html">Logowanie</a>
            </li>
        <?php endif; ?>
        </ul>
    </div>
</nav>

<div class="container">
    <h1 class="h2-cent">Sałatki</h1>
    <a href="../dodaj_przepis.php" class="btn btn-primary mb-4">Dodaj przepis</a>
    <div class="row">
        <?php
        if ($result->num_rows > 0) {
            while($row = $result->fetch_assoc()) {
                echo '<div class="col-md-6">';
                echo '<div class="card mb-4 category-tile">';
                echo '<div class="card-body">';
                echo '<h5 class="card-title custom-text-color"><a class="custom-text-color" href="recipe_details.php?recipe_id=' . $row["recipe_id"] . '">' . $row["title"] . '</a></h5>';
                echo '<p class="card-text text-left custom-text-color"><strong>Opis:</strong> ' . $row["description"] . '</p>';
                echo '</div>';
                echo '</div>';
                echo '</div>';
            }
        } else {
            echo '<div class="col-md-12"><p class="text-center custom-text-color">Brak przepisów w tej kategorii.</p></div>';
        }
        $conn->close();
        ?>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
