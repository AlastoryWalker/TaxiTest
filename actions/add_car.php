<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
requireRole(["admin"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("
        INSERT INTO cars (license_plate, brand, model, year, color, is_active)
        VALUES (?, ?, ?, ?, ?, ?)
    ");
    $stmt->execute([
        $_POST["license_plate"],
        $_POST["brand"],
        $_POST["model"],
        $_POST["year"],
        $_POST["color"],
        isset($_POST["is_active"]) ? 1 : 0
    ]);
    
    header("Location: ../pages/cars.php?msg=Car added successfully");
    exit;
}
?>