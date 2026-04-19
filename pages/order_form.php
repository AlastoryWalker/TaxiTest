<?php
require_once "../includes/auth.php";
requireRole(["passenger"]);

$tariffs = $pdo->query("SELECT * FROM tariffs")->fetchAll();

include "../includes/header.php";
?>
<h2>Create New Order</h2>

<form action="../actions/add_order.php" method="POST">
    <label>Pickup Location:<br><input type="text" name="pickup_location" required placeholder="Enter pickup address"></label><br><br>
    
    <label>Dropoff Location:<br><input type="text" name="dropoff_location" required placeholder="Enter dropoff address"></label><br><br>
    
    <label>Select Tariff:<br>
        <select name="tariff_id" required>
            <?php foreach ($tariffs as $tariff): ?>
            <option value="<?= $tariff["tariff_id"] ?>">
                <?= htmlspecialchars($tariff["name"]) ?> - Base: $<?= $tariff["base_price"] ?>, $<?= $tariff["price_per_km"] ?>/km, $<?= $tariff["price_per_minute"] ?>/min
            </option>
            <?php endforeach; ?>
        </select>
    </label><br><br>
    
    <button type="submit" style="background: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;">Create Order</button>
    <a href="orders.php" style="margin-left: 10px;">Cancel</a>
</form>
<?php include "../includes/footer.php"; ?>