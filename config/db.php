<?php
$host = 'localhost';
$dbname = 'taxi_db';
$username = 'root';  // Было 'admin'
$password = '';      // Было 'admin' (у root пароль пустой)

try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8mb4", $username, $password, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    die("Database connection error: " . $e->getMessage());
}
?>