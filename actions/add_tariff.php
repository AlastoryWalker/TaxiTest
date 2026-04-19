<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
requireRole(["admin"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("
        INSERT INTO tariffs (name, base_price, price_per_km, price_per_minute, description)
        VALUES (?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $_POST["name"],
        $_POST["base_price"],
        $_POST["price_per_km"],
        $_POST["price_per_minute"],
        $_POST["description"]
    ]);
    
    header("Location: ../pages/tariffs.php?msg=Tariff added successfully");
    exit;
}
?>