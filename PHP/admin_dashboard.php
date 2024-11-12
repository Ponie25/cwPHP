<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 1) {
    echo "<script>
            alert('You are not logged in as admin');
            window.location.href = '../index.php';
          </script>";
    exit;
}

// Fetch all posts for management
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all users for management
$userStmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $userStmt->fetchAll(PDO::FETCH_ASSOC);

//Fetch all modules 
$moduleStmt = $pdo->query("SELECT * FROM modules ORDER BY created_at DESC");
$modules = $moduleStmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'Admin Dashboard';

// Start output buffering and include the template
ob_start();
include '../Template/admin_dashboard.html.php';
$content = ob_get_clean();

// Include the main layout that uses $content
include '../Template/layout.html.php';
?>
