<?php
session_start();

function redirectWithErrors($errors) {
    $_SESSION['errors'] = $errors;
    header("Location:  rejestracja_formularz.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pobranie danych z formularza
    $username = $_POST['username'] ?? '';
    $email = $_POST['email'] ?? '';
    $password = $_POST['password'] ?? '';
    $confirm_password = $_POST['confirm_password'] ?? '';
    $accept_terms = isset($_POST['accept_terms']);

    $errors = [];

    // Walidacja loginu
    if (!ctype_alnum($username)) {
        $errors[] = "Login może składać się tylko ze znaków alfanumerycznych.";
    }

    // Walidacja e-maila
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $errors[] = "Niepoprawny format e-mail.";
    }

    // Walidacja hasła
    if (strlen($password) < 8) {
        $errors[] = "Hasło musi składać się z co najmniej 8 znaków.";
    }

    if ($password !== $confirm_password) {
        $errors[] = "Hasła nie są identyczne.";
    }

    // Sprawdzenie akceptacji regulaminu
    if (!$accept_terms) {
        $errors[] = "Musisz zaakceptować regulamin.";
    }

    if (empty($errors)) {
        // Dane do połączenia z bazą danych
        $servername = "localhost";
        $dbname = "moja_baza";
        $dbusername = "root";
        $dbpassword = "";

        // Utworzenie połączenia
        $conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

        // Sprawdzenie połączenia
        if ($conn->connect_error) {
            $errors[] = "Połączenie nieudane: " . $conn->connect_error;
            redirectWithErrors($errors);
        }

        // Sprawdzenie, czy nazwa użytkownika już istnieje
        $sql = "SELECT id FROM users WHERE username = ?";
        $stmt = $conn->prepare($sql);
        $stmt->bind_param("s", $username);
        $stmt->execute();
        $stmt->store_result();

        if ($stmt->num_rows > 0) {
            $errors[] = "Nazwa użytkownika jest już zajęta.";
        } else {
            // Hashowanie hasła
            $hashed_password = password_hash($password, PASSWORD_DEFAULT);

            // Wstawienie nowego użytkownika do bazy danych
            $sql = "INSERT INTO users (username, email, password) VALUES (?, ?, ?)";
            $stmt = $conn->prepare($sql);
            $stmt->bind_param("sss", $username, $email, $hashed_password);

            if ($stmt->execute()) {
                $stmt->close();
                $conn->close();
                header("Location: logowanie.html");
                exit();
            } else {
                $errors[] = "Błąd podczas rejestracji.";
            }
        }

        // Zamknięcie zasobów
        $stmt->close();
        $conn->close();
    }

    redirectWithErrors($errors);
} else {
    header("Location: index.html");
    exit();
}
?>