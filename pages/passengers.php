<?php
require_once "../includes/auth.php";
requireRole(["admin"]);
include "../includes/header.php";

$passengers = $pdo->query("SELECT * FROM passengers ORDER BY passenger_id")->fetchAll();
?>
<h2>Passengers Management</h2>

<table style="width: 100%; border-collapse: collapse; margin-top: 20px;">
    <thead>
        <tr style="background: #333; color: white;">
            <th style="padding: 10px; text-align: left;">ID</th>
            <th style="padding: 10px; text-align: left;">Full Name</th>
            <th style="padding: 10px; text-align: left;">Phone</th>
            <th style="padding: 10px; text-align: left;">Email</th>
            <th style="padding: 10px; text-align: left;">Registration Date</th>
        </tr>
    </thead>
    <tbody>
        <?php foreach ($passengers as $passenger): ?>
        <tr style="border-bottom: 1px solid #ddd;">
            <td style="padding: 10px;"><?= $passenger["passenger_id"] ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($passenger["full_name"]) ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($passenger["phone"]) ?></td>
            <td style="padding: 10px;"><?= htmlspecialchars($passenger["email"] ?? "-") ?></td>
            <td style="padding: 10px;"><?= date("d.m.Y H:i", strtotime($passenger["registration_date"])) ?></td>
        </tr>
        <?php endforeach; ?>
    </tbody>
</table>
<?php include "../includes/footer.php"; ?>