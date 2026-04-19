<?php
require_once "../includes/auth.php";
requireRole(["admin", "driver"]);
include "../includes/header.php";

$cars = $pdo->query("SELECT * FROM cars ORDER BY car_id")->fetchAll();
?>
<h2>Cars Management</h2>
<?php if (isset($_GET["msg"])): ?>
<div class="success" style="color: green; margin: 10px 0;"><?= htmlspecialchars($_GET["msg"]) ?></div>
<?php endif; ?>

<?php if ($role === "admin"): ?>
<a href="car_form.php" class="btn" style="background: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-bottom: 20px;">+ Add Car</a>
<?php endif; ?>

<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr style="background: #333; color: white;">
            <th style="padding: 10px; text-align: left;">ID</th>
            <th style="padding: 10px; text-align: left;">License Plate</th>
            <th style="padding: 10px; text-align: left;">Brand</th>
            <th style="padding: 10px; text-align: left;">Model</th>
            <th style="padding: 10px; text-align: left;">Year</th>
            <th style="padding: 10px; text-align: left;">Color</th>
            <th style="padding: 10px; text-align: left;">Status</th>
            <?php if ($role === "admin"): ?>
            <th style="padding: 10px; text-align: left;">Actions</th>
            <?php endif; ?>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($cars as $car): ?>
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 10px;"><?= $car["car_id"] ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($car["license_plate"]) ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($car["brand"]) ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($car["model"]) ?></td>
            <td style="padding: 10px;"><?= $car["year"] ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($car["color"]) ?></td>
            <td style="padding: 10px;"><?= $car["is_active"] ? "Active" : "Inactive" ?></td>
            <?php if ($role === "admin"): ?>
            <td style="padding: 10px;">
                <a href="car_form.php?id=<?= $car["car_id"] ?>" style="color: #2196F3; margin-right: 10px;">Edit</a>
                <a href="../actions/delete_car.php?id=<?= $car["car_id"] ?>" onclick="return confirm('Delete?')" style="color: #f44336;">Delete</a>
            </td>
            <?php endif; ?>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include "../includes/footer.php"; ?>