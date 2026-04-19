<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
requireRole(["admin"]);

$driver_id = $_GET["id"];
$stmt = $pdo->prepare("DELETE FROM drivers WHERE driver_id = ?");
$stmt->execute([$driver_id]);

header("Location: ../pages/drivers.php?msg=Driver deleted successfully");
exit;
?>