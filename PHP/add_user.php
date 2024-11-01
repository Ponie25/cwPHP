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
        // SQL statement
        $stmt = $pdo->prepare("INSERT INTO users (username, password, role) VALUES (:username, :password, :role)");
        $stmt->execute([
            ':username' => $username,
            ':password' => password_hash($password, PASSWORD_DEFAULT),
            ':role' => $role
        ]);

        // Redirect back to the main page with a success message
        header("Location: ../index.php?message=User+added+successfully");
        exit;
    } else {
        // Redirect back with an error message if fields are empty
        header("Location: ../admin_dashboard.php?error=Please+fill+in+all+fields");
        exit;
    }
} else {
    // Redirect if accessed without POST
    header("Location: ../admin_dashboard.php");
    exit;
}
