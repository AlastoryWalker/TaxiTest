<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
requireRole(["admin"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("
        UPDATE cars 
        SET license_plate = ?, brand = ?, model = ?, year = ?, color = ?, is_active = ?
        WHERE car_id = ?
    ");
    $stmt->execute([
        $_POST["license_plate"],
        $_POST["brand"],
        $_POST["model"],
        $_POST["year"],
        $_POST["color"],
        isset($_POST["is_active"]) ? 1 : 0,
        $_POST["car_id"]
    ]);
    
    header("Location: ../pages/cars.php?msg=Car updated successfully");
    exit;
}
?>