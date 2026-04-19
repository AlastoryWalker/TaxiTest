<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
require_once __DIR__ . "/auth.php";
$role = getUserRole();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Taxi Service</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<header>
    <div class="container">
        <h1>🚖 Taxi Service</h1>
        <nav>
    <a href="/pages/index.php">🏠 Home</a>
    <a href="/pages/cars.php">🚗 Cars</a>
    <a href="/pages/drivers.php">👨‍️ Drivers</a>
    <a href="/pages/tariffs.php">💲 Tariffs</a>
    <a href="/pages/orders.php">📋 Orders</a>
    
    <?php if ($role === 'guest'): ?>
        <a href="/pages/login.php" style="float:right">🔑 Login</a>
    <?php else: ?>
        <span style="float:right; margin-right:15px;">👤 <?= $_SESSION['username'] ?></span>
        <a href="/actions/logout.php" style="float:right">🚪 Logout</a>
    <?php endif; ?>
</nav>
    </div>
</header>
<main class="container">