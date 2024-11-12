<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/session_start.php';
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $username = trim($_POST["username"]);
    $password = trim($_POST["password"]);
    $role = $_POST["role"];

    if (!empty($username) && !empty($password) && isset($role)) {
        // Check if username already exists
        $checkStmt = $pdo->prepare("SELECT COUNT(*) FROM users WHERE username = :username");
        $checkStmt->execute([':username' => $username]);
        $userExists = $checkStmt->fetchColumn() > 0;

        if ($userExists) {
            // If username exists
            echo "<script>
                alert('Username already exists');
                window.location.href = '/PHP-Web-main/PHP/admin_dashboard.php';
                </script>";
        } else {
            $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
            $stmt->execute([
                ':username' => $username,
                ':password' => password_hash($password, PASSWORD_DEFAULT),
                ':role' => $role
            ]);
            // Success
            echo "<script>
                alert('User added successfully.');
                window.location.href = '/PHP-Web-main/PHP/admin_dashboard.php';
                </script>";
        }
    } else {
        // If empty 
        echo "<script>
            alert('Please fill in all fields.');    
            window.location.href = '/PHP-Web-main/PHP/admin_dashboard.php';
            </script>";
    }
}
?>
