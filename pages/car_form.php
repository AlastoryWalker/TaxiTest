<?php
require_once "../includes/auth.php";
requireRole(["admin"]);

$car = null;
if (isset($_GET["id"])) {
    $stmt = $pdo->prepare("SELECT * FROM cars WHERE car_id = ?");
    $stmt->execute([$_GET["id"]]);
    $car = $stmt->fetch();
}

include "../includes/header.php";
?>
<h2><?= $car ? "Edit Car" : "Add Car" ?></h2>

<form action="../actions/<?= $car ? "edit" : "add" ?>_car.php" method="POST">
    <?php if ($car): ?>
    <input type="hidden" name="car_id" value="<?= $car["car_id"] ?>">
    <?php endif; ?>
    
    <label>License Plate:<br><input type="text" name="license_plate" value="<?= htmlspecialchars($car["license_plate"] ?? "") ?>" required></label><br><br>
    
    <label>Brand:<br><input type="text" name="brand" value="<?= htmlspecialchars($car["brand"] ?? "") ?>" required></label><br><br>
    
    <label>Model:<br><input type="text" name="model" value="<?= htmlspecialchars($car["model"] ?? "") ?>" required></label><br><br>
    
    <label>Year:<br><input type="number" name="year" value="<?= $car["year"] ?? "" ?>" required></label><br><br>
    
    <label>Color:<br><input type="text" name="color" value="<?= htmlspecialchars($car["color"] ?? "") ?>"></label><br><br>
    
    <label><input type="checkbox" name="is_active" value="1" <?= ($car["is_active"] ?? 1) ? "checked" : "" ?>> Active</label><br><br>
    
    <button type="submit" style="background: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;"><?= $car ? "Update" : "Add" ?> Car</button>
    <a href="cars.php" style="margin-left: 10px;">Cancel</a>
</form>
<?php include "../includes/footer.php"; ?>