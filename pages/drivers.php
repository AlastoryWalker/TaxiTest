<?php
require_once "../includes/auth.php";
requireRole(["admin"]);
include "../includes/header.php";

$drivers = $pdo->query("SELECT * FROM drivers ORDER BY driver_id")->fetchAll();
?>
<h2>Drivers Management</h2>
<?php if (isset($_GET["msg"])): ?>
<div class="success" style="color: green; margin: 10px 0;"><?= htmlspecialchars($_GET["msg"]) ?></div>
<?php endif; ?>

<a href="driver_form.php" class="btn" style="background: #4CAF50; color: white; padding: 10px 20px; text-decoration: none; border-radius: 5px; display: inline-block; margin-bottom: 20px;">+ Add Driver</a>

<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr style="background: #333; color: white;">
            <th style="padding: 10px; text-align: left;">ID</th>
            <th style="padding: 10px; text-align: left;">Full Name</th>
            <th style="padding: 10px; text-align: left;">Phone</th>
            <th style="padding: 10px; text-align: left;">License Number</th>
            <th style="padding: 10px; text-align: left;">Rating</th>
            <th style="padding: 10px; text-align: left;">Actions</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($drivers as $driver): ?>
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 10px;"><?= $driver["driver_id"] ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($driver["full_name"]) ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($driver["phone"]) ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($driver["license_number"]) ?></td>
            <td style="padding: 10px;">⭐ <?= $driver["rating"] ?></td>
            <td style="padding: 10px;">
                <a href="driver_form.php?id=<?= $driver["driver_id"] ?>" style="color: #2196F3; margin-right: 10px;">Edit</a>
                <a href="../actions/delete_driver.php?id=<?= $driver["driver_id"] ?>" onclick="return confirm('Delete?')" style="color: #f44336;">Delete</a>
            </td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include "../includes/footer.php"; ?>