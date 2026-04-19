<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
requireRole(["admin"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("
        UPDATE drivers 
        SET full_name = ?, phone = ?, license_number = ?, rating = ?
        WHERE driver_id = ?
    ");
    $stmt->execute([
        $_POST["full_name"],
        $_POST["phone"],
        $_POST["license_number"],
        $_POST["rating"],
        $_POST["driver_id"]
    ]);
    
    header("Location: ../pages/drivers.php?msg=Driver updated successfully");
    exit;
}
?>