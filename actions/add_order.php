<?php
require_once "../config/db.php";
require_once "../includes/auth.php";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $passenger_id = $_SESSION["entity_id"];
    $tariff_id = $_POST["tariff_id"];
    $pickup = trim($_POST["pickup_location"]);
    $dropoff = trim($_POST["dropoff_location"]);
    
    $stmt = $pdo->prepare("
        INSERT INTO orders (passenger_id, tariff_id, pickup_location, dropoff_location, order_time, status)
        VALUES (?, ?, ?, ?, NOW(), 'pending')
    ");
    $stmt->execute([$passenger_id, $tariff_id, $pickup, $dropoff]);
    
    header("Location: ../pages/orders.php?msg=Order created successfully");
    exit;
}
?>