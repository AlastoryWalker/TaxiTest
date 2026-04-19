<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
requireRole(["admin"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $stmt = $pdo->prepare("
        INSERT INTO drivers (full_name, phone, license_number, rating)
        VALUES (?, ?, ?, ?)
    ");
    $stmt->execute([
        $_POST["full_name"],
        $_POST["phone"],
        $_POST["license_number"],
        $_POST["rating"]
    ]);
    
    $driver_id = $pdo->lastInsertId();
    
    if (isset($_POST["create_user"]) && $_POST["create_user"] == 1) {
        $username = "driver" . $driver_id;
        $password = password_hash("12345", PASSWORD_DEFAULT);
        $stmt = $pdo->prepare("INSERT INTO users (username, password_hash, role, entity_id) VALUES (?, ?, 'driver', ?)");
        $stmt->execute([$username, $password, $driver_id]);
    }
    
    header("Location: ../pages/drivers.php?msg=Driver added successfully");
    exit;
}
?>