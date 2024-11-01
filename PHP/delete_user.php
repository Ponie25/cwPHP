<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/session_start.php';
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

// Check if the user ID is provided
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['user_id'])) {
    $userId = $_POST['user_id'];
    // SQL statement
    $stmt = $pdo->prepare("DELETE FROM users WHERE id = :user_id");
    $stmt->execute(['user_id' => $userId]);

    // Check if the deletion was successful
    if ($stmt->rowCount() > 0) {
        // Redirect back to the admin dashboard with a success message
        header("Location: admin_dashboard.php?message=User+deleted+successfully");
    } else {
        // Redirect with an error message if the deletion failed
        header("Location: admin_dashboard.php?error=User+deletion+failed");
    }
    exit;
} else {
    // Redirect to admin dashboard if no user ID provided
    header("Location: admin_dashboard.php?error=No+UserId+Provided");
    exit;
}
