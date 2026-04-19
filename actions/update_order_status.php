<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
requireRole(["admin", "driver"]);

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $order_id = $_POST["order_id"];
    $status = $_POST["status"];
    
    if ($status === "started") {
        $stmt = $pdo->prepare("UPDATE orders SET status = 'in_progress', start_time = NOW() WHERE order_id = ?");
    } elseif ($status === "completed") {
        $distance = $_POST["distance_km"];
        $duration = $_POST["duration_minutes"];
        
        $stmt = $pdo->prepare("
            SELECT t.base_price, t.price_per_km, t.price_per_minute 
            FROM orders o 
            JOIN tariffs t ON o.tariff_id = t.tariff_id 
            WHERE o.order_id = ?
        ");
        $stmt->execute([$order_id]);
        $tariff = $stmt->fetch();
        
        $total = $tariff["base_price"] + ($tariff["price_per_km"] * $distance) + ($tariff["price_per_minute"] * $duration);
        
        $stmt = $pdo->prepare("
            UPDATE orders 
            SET status = 'completed', end_time = NOW(), total_price = ?, distance_km = ?, duration_minutes = ?
            WHERE order_id = ?
        ");
        $stmt->execute([$total, $distance, $duration, $order_id]);
    } else {
        $stmt = $pdo->prepare("UPDATE orders SET status = ? WHERE order_id = ?");
        $stmt->execute([$status, $order_id]);
    }
    
    header("Location: ../pages/orders.php?msg=Order updated");
    exit;
}
?>