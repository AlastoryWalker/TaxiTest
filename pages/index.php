<?php
include "../includes/header.php";
?>
<h2>Welcome to Taxi Service!</h2>

<div class="stats" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(200px, 1fr)); gap: 20px; margin: 20px 0;">
    <div class="stat-card" style="background: #f5f5f5; padding: 20px; border-radius: 8px; text-align: center;">
        <h3>🚗 Total Cars</h3>
        <?php
        $stmt = $pdo->query("SELECT COUNT(*) FROM cars WHERE is_active = TRUE");
        echo "<p style='font-size: 2em; font-weight: bold; color: #4CAF50;'>" . $stmt->fetchColumn() . "</p>";
        ?>
    </div>
    <div class="stat-card" style="background: #f5f5f5; padding: 20px; border-radius: 8px; text-align: center;">
        <h3>👨‍️ Drivers</h3>
        <?php
        $stmt = $pdo->query("SELECT COUNT(*) FROM drivers");
        echo "<p style='font-size: 2em; font-weight: bold; color: #2196F3;'>" . $stmt->fetchColumn() . "</p>";
        ?>
    </div>
    <div class="stat-card" style="background: #f5f5f5; padding: 20px; border-radius: 8px; text-align: center;">
        <h3>📋 Total Orders</h3>
        <?php
        $stmt = $pdo->query("SELECT COUNT(*) FROM orders");
        echo "<p style='font-size: 2em; font-weight: bold; color: #FF9800;'>" . $stmt->fetchColumn() . "</p>";
        ?>
    </div>
    <div class="stat-card" style="background: #f5f5f5; padding: 20px; border-radius: 8px; text-align: center;">
        <h3>😊 Passengers</h3>
        <?php
        $stmt = $pdo->query("SELECT COUNT(*) FROM passengers");
        echo "<p style='font-size: 2em; font-weight: bold; color: #9C27B0;'>" . $stmt->fetchColumn() . "</p>";
        ?>
    </div>
</div>

<?php include "../includes/footer.php"; ?>