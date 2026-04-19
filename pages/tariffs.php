<?php
require_once "../includes/auth.php";
requireRole(["admin"]);
include "../includes/header.php";

$tariffs = $pdo->query("SELECT * FROM tariffs ORDER BY tariff_id")->fetchAll();
?>
<h2>Tariffs Management</h2>
<?php if (isset($_GET["msg"])): ?>
<div class="success" style="color: green; margin: 10px 0;"><?= htmlspecialchars($_GET["msg"]) ?></div>
<?php endif; ?>

<a href="tariff_form.php" class="btn" style="background: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-bottom: 20px;">+ Add Tariff</a>

<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr style="background: #333; color: white;">
            <th style="padding: 10px; text-align: left;">ID</th>
            <th style="padding: 10px; text-align: left;">Name</th>
            <th style="padding: 10px; text-align: left;">Base Price</th>
            <th style="padding: 10px; text-align: left;">Price/km</th>
            <th style="padding: 10px; text-align: left;">Price/min</th>
            <th style="padding: 10px; text-align: left;">Description</th>
            <th style="padding: 10px; text-align: left;">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($tariffs as $tariff): ?>
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 10px;"><?= $tariff["tariff_id"] ?></td>
            <td style="padding: 10px;"><strong><?= htmlspecialchars($tariff["name"]) ?></strong></td>
            <td style="padding: 10px;">$<?= $tariff["base_price"] ?></td>
            <td style="padding: 10px;">$<?= $tariff["price_per_km"] ?></td>
            <td style="padding: 10px;">$<?= $tariff["price_per_minute"] ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($tariff["description"]) ?></td>
            <td style="padding: 10px;">
                <a href="tariff_form.php?id=<?= $tariff["tariff_id"] ?>" style="color: #2196F3; margin-right: 10px;">Edit</a>
                <a href="../actions/delete_tariff.php?id=<?= $tariff["tariff_id"] ?>" onclick="return confirm('Delete?')" style="color: #f44336;">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include "../includes/footer.php"; ?>