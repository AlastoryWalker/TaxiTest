<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
requireRole(["admin"]);

$car_id = $_GET["id"];
$stmt = $pdo->prepare("DELETE FROM cars WHERE car_id = ?");
$stmt->execute([$car_id]);

header("Location: ../pages/cars.php?msg=Car deleted successfully");
exit;
?>