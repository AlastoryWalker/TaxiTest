<?php
require_once "../config/db.php";
require_once "../includes/auth.php";
requireRole(["admin"]);

$tariff_id = $_GET["id"];
$stmt = $pdo->prepare("DELETE FROM tariffs WHERE tariff_id = ?");
$stmt->execute([$tariff_id]);

header("Location: ../pages/tariffs.php?msg=Tariff deleted successfully");
exit;
?>