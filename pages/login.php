<?php 
session_start();
// Если уже авторизован - редирект на главную
if (isset($_SESSION['user_id'])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login - Taxi Service</title>
    <link rel="stylesheet" href="../assets/style.css">
</head>
<body>
<div class="container" style="max-width: 400px; margin: 100px auto; padding: 20px;">
    <h1 style="text-align: center;">🚖 Taxi Service</h1>
    <h2>Login</h2>
    
    <?php if (isset($_GET['error'])): ?>
        <div style="color: red; background: #ffebee; padding: 10px; border-radius: 5px; margin: 10px 0;">
            <?= htmlspecialchars($_GET['error']) ?>
        </div>
    <?php endif; ?>
    
    <form action="../actions/login.php" method="POST" style="background: white; padding: 20px; border-radius: 5px;">
        <label>Username:<br>
            <input type="text" name="username" required style="width: 100%; padding: 8px; margin: 5px 0;">
        </label><br><br>
        
        <label>Password:<br>
            <input type="password" name="password" required style="width: 100%; padding: 8px; margin: 5px 0;">
        </label><br><br>
        
        <button type="submit" style="width: 100%; padding: 10px; background: #4CAF50; color: white; border: none; border-radius: 5px; cursor: pointer;">
            Sign In
        </button>
    </form>
    
    <p style="margin-top: 20px; font-size: 0.9em; color: #666;">
        <strong>Test accounts:</strong><br>
        admin / password<br>
        driver1 / password
    </p>
</div>
</body>
</html>