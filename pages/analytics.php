<?php
require_once "../includes/auth.php";
requireRole(["admin"]);
include "../includes/header.php";

// Total revenue
$stmt = $pdo->query("SELECT SUM(total_price) as revenue FROM orders WHERE status = 'completed'");
$totalRevenue = $stmt->fetch()["revenue"] ?? 0;

// Orders by status
$stmt = $pdo->query("SELECT status, COUNT(*) as count FROM orders GROUP BY status");
$ordersByStatus = $stmt->fetchAll();

// Top drivers
$stmt = $pdo->query("
    SELECT d.full_name, COUNT(o.order_id) as total_orders, SUM(o.total_price) as total_revenue
    FROM drivers d
    LEFT JOIN orders o ON d.driver_id = o.driver_id AND o.status = 'completed'
    GROUP BY d.driver_id
    ORDER BY total_revenue DESC
    LIMIT 5
");
$topDrivers = $stmt->fetchAll();

// Popular tariffs
$stmt = $pdo->query("
    SELECT t.name, COUNT(o.order_id) as total_orders
    FROM tariffs t
    LEFT JOIN orders o ON t.tariff_id = o.tariff_id
    GROUP BY t.tariff_id
    ORDER BY total_orders DESC
");
$popularTariffs = $stmt->fetchAll();
?>
<h2>Analytics Dashboard</h2>

<div class="stats" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 20px 0;">
    <div class="stat-card" style="background: #f5f5f5; padding: 20px; border-radius: 8px; text-align: center;">
        <h3>💰 Total Revenue</h3>
        <p style="font-size: 2em; font-weight: bold; color: #4CAF50;">$<?= number_format($totalRevenue, 2) ?></p>
    </div>
    <div class="stat-card" style="background: #f5f5f5; padding: 20px; border-radius: 8px; text-align: center;">
        <h3>📊 Total Orders</h3>
        <?php
        $stmt = $pdo->query("SELECT COUNT(*) FROM orders");
        echo "<p style='font-size: 2em; font-weight: bold; color: #2196F3;'>" . $stmt->fetchColumn() . "</p>";
        ?>
    </div>
</div>

<h3>Orders by Status</h3>
<table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
    <thead>
        <tr style="background: #333; color: white;">
            <th style="padding: 10px; text-align: left;">Status</th>
            <th style="padding: 10px; text-align: left;">Count</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($ordersByStatus as $row): ?>
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 10px;"><?= ucfirst($row["status"]) ?></td>
            <td style="padding: 10px;"><?= $row["count"] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Top 5 Drivers by Revenue</h3>
<table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
    <thead>
        <tr style="background: #333; color: white;">
            <th style="padding: 10px; text-align: left;">Driver</th>
            <th style="padding: 10px; text-align: left;">Completed Orders</th>
            <th style="padding: 10px; text-align: left;">Total Revenue</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($topDrivers as $driver): ?>
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 10px;"><?= htmlspecialchars($driver["full_name"]) ?></td>
            <td style="padding: 10px;"><?= $driver["total_orders"] ?></td>
            <td style="padding: 10px;">$<?= number_format($driver["total_revenue"] ?? 0, 2) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<h3>Popular Tariffs</h3>
<table style="width: 100%; border-collapse: collapse; margin: 20px 0;">
    <thead>
        <tr style="background: #333; color: white;">
            <th style="padding: 10px; text-align: left;">Tariff</th>
            <th style="padding: 10px; text-align: left;">Total Orders</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($popularTariffs as $tariff): ?>
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 10px;"><?= htmlspecialchars($tariff["name"]) ?></td>
            <td style="padding: 10px;"><?= $tariff["total_orders"] ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>

<?php include "../includes/footer.php"; ?>