<?php
session_start(); // Rozpoczęcie sesji

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['username']) && isset($_POST['password'])) {
    // Pobranie danych z formularza
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Dane do połączenia z bazą danych
    $servername = "localhost";
    $dbname = "moja_baza";
    $dbusername = "root";
    $dbpassword = "";

    // Utworzenie połączenia
    $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

    // Sprawdzenie połączenia
    if ($conn->connect_error) {
        die("Połączenie nieudane: " . $conn->connect_error);
    }

    // Przygotowanie zapytania SQL
    $sql = "SELECT id, username, password FROM users WHERE username = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($id, $db_username, $db_password);
        $stmt->fetch();

        // Sprawdzenie hasła
        if (password_verify($password, $db_password)) {
            // Ustawienie zmiennej sesyjnej po udanym logowaniu
            $_SESSION['user_id'] = $id;
            $_SESSION['username'] = $username;
            header("Location: index.php");
            exit();
        } else {
            showError();
        }
    } else {
        showError();
    }

    // Zamknięcie zasobów
    $stmt->close();
    $conn->close();
} else {
    // Przekierowanie do strony głównej
    header("Location: index.php");
    exit();
}

function showError() {
    echo "<!DOCTYPE html>
    <html lang='pl'>
    <head>
        <meta charset='UTF-8'>
        <meta name='viewport' content='width=device-width, initial-scale=1.0'>
        <title>Błąd logowania</title>
        <link rel='stylesheet' href='https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css'>
        <link rel='stylesheet' href='style.css'>
    </head>
    <body>
        <div class='container mt-5'>
            <div class='row justify-content-center'>
                <div class='col-md-6'>
                    <div class='alert alert-danger text-center' role='alert'>
                        Niepoprawne dane. <a href='logowanie.html' class='alert-link'>Spróbuj ponownie</a>
                        lub <a href='rejestracja.html' class='alert-link'>zarejestruj się</a>.
                    </div>
                </div>
            </div>
        </div>
    </body>
    </html>";
}
?>