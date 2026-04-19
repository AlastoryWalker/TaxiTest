<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
requireRole(["admin"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("
        UPDATE tariffs 
        SET name = ?, base_price = ?, price_per_km = ?, price_per_minute = ?, description = ?
        WHERE tariff_id = ?
    ");
    $stmt->execute([
        $_POST["name"],
        $_POST["base_price"],
        $_POST["price_per_km"],
        $_POST["price_per_minute"],
        $_POST["description"],
        $_POST["tariff_id"]
    ]);
    
    header("Location: ../pages/tariffs.php?msg=Tariff updated successfully");
    exit;
}
?>