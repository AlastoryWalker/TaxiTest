<?php
session_start();
require_once '../config/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = $_POST['password'];
    
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();
    
    if ($user && password_verify($password, $user['password_hash'])) {
        $_SESSION['user_id'] = $user['user_id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        $_SESSION['entity_id'] = $user['entity_id'];
        
        // Редирект на главную
        header("Location: ../pages/index.php");
        exit;
    } else {
        // Ошибка - возвращаем на страницу входа
        header("Location: ../pages/login.php?error=Invalid username or password");
        exit;
    }
} else {
    // Если открыли напрямую без POST - редирект на форму
    header("Location: ../pages/login.php");
    exit;
}
?>