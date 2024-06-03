<?php
include 'db_connection.php'; // Zakladam, że tutaj tworzysz połączenie PDO
include('helpers.php');
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
if (!isUserLoggedIn()) {
    header('Location: logowanie.php');
    exit();
}

$username = $_SESSION['username']; // Zakładamy, że nazwa użytkownika jest przechowywana w sesji po zalogowaniu

// Znalezienie ID użytkownika na podstawie jego nazwy użytkownika
$sql_user_id = "SELECT id FROM users WHERE username = :username";
$stmt_user = $conn->prepare($sql_user_id);
$stmt_user->bindParam(':username', $username, PDO::PARAM_STR);
$stmt_user->execute();
$user = $stmt_user->fetch(PDO::FETCH_ASSOC);
if ($user) {
    $_SESSION['user_id'] = $user['id'];
    $user_id = $user['id'];
} else {
    echo "Nie znaleziono ID użytkownika.";
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $category_id = $_POST['category_id'];
    $title = $_POST['title'];
    $description = $_POST['description'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $sql = "INSERT INTO recipes (user_id, category_id, title, description, ingredients, instructions)
            VALUES (:user_id, :category_id, :title, :description, :ingredients, :instructions)";
    $stmt = $conn->prepare($sql);
    $stmt->bindParam(':user_id', $user_id, PDO::PARAM_INT);
    $stmt->bindParam(':category_id', $category_id, PDO::PARAM_INT);
    $stmt->bindParam(':title', $title, PDO::PARAM_STR);
    $stmt->bindParam(':description', $description, PDO::PARAM_STR);
    $stmt->bindParam(':ingredients', $ingredients, PDO::PARAM_STR);
    $stmt->bindParam(':instructions', $instructions, PDO::PARAM_STR);
    if ($stmt->execute()) {
        echo "Przepis został dodany pomyślnie!";
    } else {
        echo "Błąd: " . implode(", ", $stmt->errorInfo());
    }
}
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">
    <link href="style.css" rel="stylesheet">
    <title>Dodaj przepis</title>
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
<div class="container">
    <h1>Dodaj przepis</h1>
    <form action="dodaj_przepis.php" method="post">
        <div class="form-group">
            <label for="category_id">Kategoria</label>
            <select class="form-control" id="category_id" name="category_id" required>
                <option value="1">Przystawki i przekąski</option>
                <option value="2">Zupy</option>
                <option value="3">Dania główne</option>
                <option value="4">Desery</option>
                <option value="5">Sałatki</option>
                <option value="6">Napoje</option>
                <option value="7">Wegetariańskie i wegańskie</option>
                <option value="8">Dania międzynarodowe</option>
            </select>
        </div>
        <div class="form-group">
            <label for="title">Tytuł</label>
            <input type="text" class="form-control" id="title" name="title" required>
        </div>
        <div class="form-group">
            <label for="description">Opis</label>
            <textarea class="form-control" id="description" name="description" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="ingredients">Lista składników</label>
            <textarea class="form-control" id="ingredients" name="ingredients" rows="3" required></textarea>
        </div>
        <div class="form-group">
            <label for="instructions">Instrukcje</label>
            <textarea class="form-control" id="instructions" name="instructions" rows="3" required></textarea>
        </div>
        <button type="submit" class="btn btn-primary">Dodaj przepis</button>
    </form>
</div>
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.2/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>