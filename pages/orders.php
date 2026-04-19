<?php
require_once "../includes/auth.php";
include "../includes/header.php";

$role = getUserRole();

if ($role === "passenger") {
    $stmt = $pdo->prepare("
        SELECT o.*, t.name as tariff_name, d.full_name as driver_name, c.license_plate, c.brand, c.model
        FROM orders o
        LEFT JOIN tariffs t ON o.tariff_id = t.tariff_id
        LEFT JOIN drivers d ON o.driver_id = d.driver_id
        LEFT JOIN cars c ON o.car_id = c.car_id
        WHERE o.passenger_id = ?
        ORDER BY o.order_time DESC
    ");
    $stmt->execute([$_SESSION["entity_id"]]);
} else {
    $stmt = $pdo->query("
        SELECT o.*, t.name as tariff_name, p.full_name as passenger_name, d.full_name as driver_name, c.license_plate, c.brand, c.model
        FROM orders o
        LEFT JOIN tariffs t ON o.tariff_id = t.tariff_id
        LEFT JOIN passengers p ON o.passenger_id = p.passenger_id
        LEFT JOIN drivers d ON o.driver_id = d.driver_id
        LEFT JOIN cars c ON o.car_id = c.car_id
        ORDER BY o.order_time DESC
    ");
}
$orders = $stmt->fetchAll();
?>
<h2>Orders</h2>
<?php if (isset($_GET["msg"])): ?>
<div class="success" style="color: green; margin: 10px 0;"><?= htmlspecialchars($_GET["msg"]) ?></div>
<?php endif; ?>

<?php if ($role === "passenger"): ?>
<a href="order_form.php" class="btn" style="background: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-bottom: 20px;">+ New Order</a>
<?php endif; ?>

<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr style="background: #333; color: white;">
            <th style="padding: 10px; text-align: left;">ID</th>
            <?php if ($role !== "passenger"): ?>
            <th style="padding: 10px; text-align: left;">Passenger</th>
            <th style="padding: 10px; text-align: left;">Driver</th>
            <?php endif; ?>
            <th style="padding: 10px; text-align: left;">Tariff</th>
            <th style="padding: 10px; text-align: left;">Pickup</th>
            <th style="padding: 10px; text-align: left;">Dropoff</th>
            <th style="padding: 10px; text-align: left;">Status</th>
            <th style="padding: 10px; text-align: left;">Price</th>
            <th style="padding: 10px; text-align: left;">Time</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($orders as $order): ?>
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 10px;"><?= $order["order_id"] ?></td>
            <?php if ($role !== "passenger"): ?>
            <td style="padding: 10px;"><?= htmlspecialchars($order["passenger_name"] ?? "N/A") ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($order["driver_name"] ?? "Not assigned") ?></td>
            <?php endif; ?>
            <td style="padding: 10px;"><?= htmlspecialchars($order["tariff_name"]) ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($order["pickup_location"]) ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($order["dropoff_location"]) ?></td>
            <td style="padding: 10px;">
                <span style="padding: 5px 10px; border-radius: 3px; background: <?= $order["status"] === "completed" ? "#4CAF50" : ($order["status"] === "in_progress" ? "#FF9800" : ($order["status"] === "cancelled" ? "#f44336" : "#2196F3")) ?>; color: white;">
                    <?= ucfirst(str_replace("_", " ", $order["status"])) ?>
                </span>
            </td>
            <td style="padding: 10px;"><?= $order["total_price"] ? "$" . $order["total_price"] : "-" ?></td>
            <td style="padding: 10px;"><?= date("d.m.Y H:i", strtotime($order["order_time"])) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include "../includes/footer.php"; ?>