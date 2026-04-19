<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}

require_once __DIR__ . "/../config/db.php";

function getUserRole() {
    if (!isset($_SESSION["user_id"])) {
        return "guest";
    }
    return $_SESSION["role"];
}

function requireRole($allowedRoles) {
    $role = getUserRole();
    if (!in_array($role, $allowedRoles)) {
        http_response_code(403);
        echo "<h2>Access Denied</h2>";
        echo "<p>Insufficient privileges.</p>";
        echo '<a href="javascript:history.back()">Back</a>';
        exit;
    }
}
?>