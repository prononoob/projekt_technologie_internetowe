<?php
$host = 'localhost'; // Adres serwera
$dbname = 'moja_baza'; // Nazwa bazy danych
$username = 'root'; // Nazwa użytkownika bazy danych
$password = ''; // Hasło użytkownika bazy danych

try {
    $conn = new PDO("mysql:host=$host;dbname=$dbname", $username, $password);
    // Ustawienia trybu błędu PDO na wyjątki
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    echo "Błąd połączenia: " . $e->getMessage();
}
?>