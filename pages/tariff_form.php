<?php
require_once "../includes/auth.php";
requireRole(["admin"]);

$tariff = null;
if (isset($_GET["id"])) {
    $stmt = $pdo->prepare("SELECT * FROM tariffs WHERE tariff_id = ?");
    $stmt->execute([$_GET["id"]]);
    $tariff = $stmt->fetch();
}

include "../includes/header.php";
?>
<h2><?= $tariff ? "Edit Tariff" : "Add Tariff" ?></h2>

<form action="../actions/<?= $tariff ? "edit" : "add" ?>_tariff.php" method="POST">
    <?php if ($tariff): ?>
    <input type="hidden" name="tariff_id" value="<?= $tariff["tariff_id"] ?>">
    <?php endif; ?>
    
    <label>Name:<br><input type="text" name="name" value="<?= htmlspecialchars($tariff["name"] ?? "") ?>" required></label><br><br>
    
    <label>Base Price ($):<br><input type="number" step="0.01" name="base_price" value="<?= $tariff["base_price"] ?? "" ?>" required></label><br><br>
    
    <label>Price per km ($):<br><input type="number" step="0.01" name="price_per_km" value="<?= $tariff["price_per_km"] ?? "" ?>" required></label><br><br>
    
    <label>Price per minute ($):<br><input type="number" step="0.01" name="price_per_minute" value="<?= $tariff["price_per_minute"] ?? "" ?>" required></label><br><br>
    
    <label>Description:<br><textarea name="description" rows="3"><?= htmlspecialchars($tariff["description"] ?? "") ?></textarea></label><br><br>
    
    <button type="submit" style="background: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;"><?= $tariff ? "Update" : "Add" ?> Tariff</button>
    <a href="tariffs.php" style="margin-left: 10px;">Cancel</a>
</form>
<?php include "../includes/footer.php"; ?>