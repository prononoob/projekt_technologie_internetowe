<?php
// Połączenie z bazą danych
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "moja_baza";

try {
    $conn = new PDO("mysql:host=$servername;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
    exit;
}

// Pobieranie zapytania z formularza
$query = isset($_GET['query']) ? $_GET['query'] : '';
?>
<!DOCTYPE html>
<html lang="pl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Wyniki wyszukiwania</title>
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
    </div>
</nav>
<div class="container mt-5">
    <h1>Wyniki wyszukiwania dla: "<?php echo htmlspecialchars($query); ?>"</h1>
    <div class="row">
        <?php
        if ($query) {
            $sql = "SELECT * FROM recipes WHERE title LIKE :query";
            $stmt = $conn->prepare($sql);
            $likeQuery = "%$query%";
            $stmt->bindParam(':query', $likeQuery);
            $stmt->execute();
            
            $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if ($results) {
                foreach ($results as $row) {
                    echo '<div class="col-md-6">';
                    echo '<div class="card mb-4 category-tile">';
                    echo '<div class="card-body">';
                    echo '<h5 class="card-title custom-text-color"><a class="custom-text-color" href="category/recipe_details.php?recipe_id=' . $row["recipe_id"] . '">' . $row["title"] . '</a></h5>';
                    echo '<p class="card-text custom-text-color"><strong>Opis:</strong> ' . $row["description"] . '</p>';
                    echo '</div>';
                    echo '</div>';
                    echo '</div>';
                }
            } else {
                echo '<div class="col-md-12"><p class="text-center custom-text-color">Brak wyników.</p></div>';
            }
        } else {
            echo '<div class="col-md-12"><p class="text-center custom-text-color">Proszę wpisać frazę wyszukiwania.</p></div>';
        }
        // Zamykanie połączenia z bazą danych
        $conn = null;
        ?>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>