<?php
require_once "../includes/auth.php";
requireRole(["admin"]);

$driver = null;
if (isset($_GET["id"])) {
    $stmt = $pdo->prepare("SELECT * FROM drivers WHERE driver_id = ?");
    $stmt->execute([$_GET["id"]]);
    $driver = $stmt->fetch();
}

include "../includes/header.php";
?>
<h2><?= $driver ? "Edit Driver" : "Add Driver" ?></h2>

<form action="../actions/<?= $driver ? "edit" : "add" ?>_driver.php" method="POST">
    <?php if ($driver): ?>
    <input type="hidden" name="driver_id" value="<?= $driver["driver_id"] ?>">
    <?php endif; ?>
    
    <label>Full Name:<br><input type="text" name="full_name" value="<?= htmlspecialchars($driver["full_name"] ?? "") ?>" required></label><br><br>
    
    <label>Phone:<br><input type="text" name="phone" value="<?= htmlspecialchars($driver["phone"] ?? "") ?>" required></label><br><br>
    
    <label>License Number:<br><input type="text" name="license_number" value="<?= htmlspecialchars($driver["license_number"] ?? "") ?>" required></label><br><br>
    
    <label>Rating:<br><input type="number" step="0.1" min="0" max="5" name="rating" value="<?= $driver["rating"] ?? "5.0" ?>" required></label><br><br>
    
    <?php if (!$driver): ?>
    <label><input type="checkbox" name="create_user" value="1" checked> Create login account (driver# / 12345)</label><br><br>
    <?php endif; ?>
    
    <button type="submit" style="background: #4CAF50; color: white; padding: 10px 20px; border: none; border-radius: 5px; cursor: pointer;"><?= $driver ? "Update" : "Add" ?> Driver</button>
    <a href="drivers.php" style="margin-left: 10px;">Cancel</a>
</form>
<?php include "../includes/footer.php"; ?>