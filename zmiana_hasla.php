<?php
session_start();

if (!isset($_SESSION['user_id'])) {
    // Użytkownik nie jest zalogowany, przekieruj do strony logowania
    header('Location: login.php');
    exit();
}

require_once 'db_connection.php'; // Plik z ustawieniami połączenia do bazy danych

$user_id = $_SESSION['user_id'];
$old_password = $_POST['old_password'];
$new_password = $_POST['new_password'];
$confirm_password = $_POST['confirm_password'];

// Sprawdzanie poprawności danych wejściowych
if ($new_password !== $confirm_password) {
    die('Nowe hasło i potwierdzenie hasła nie są zgodne.');
}

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    
    // Pobieranie aktualnego hasła z bazy danych
    $stmt = $conn->prepare("SELECT password FROM users WHERE id = :id");
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    
    $row = $stmt->fetch(PDO::FETCH_ASSOC);
    if (!$row || !password_verify($old_password, $row['password'])) {
        die('Stare hasło jest nieprawidłowe.');
    }
    
    // Hashuj nowe hasło
    $new_password_hashed = password_hash($new_password, PASSWORD_DEFAULT);
    
    // Aktualizowanie hasła w bazie danych
    $stmt = $conn->prepare("UPDATE users SET password = :new_password WHERE id = :id");
    $stmt->bindParam(':new_password', $new_password_hashed);
    $stmt->bindParam(':id', $user_id);
    $stmt->execute();
    
    header("Location: index.php");
    exit();
} catch(PDOException $e) {
    echo "Błąd: " . $e->getMessage();
}

$conn = null;
?>