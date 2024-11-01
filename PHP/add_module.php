<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/session_start.php';
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $module_name = trim($_POST["module_name"]);

    if (!empty($module_name)) {
        // SQL statement
        $stmt = $pdo->prepare("INSERT INTO modules (module_name) VALUES (:module_name)");
        $stmt->execute([
            ':module_name' => $module_name
        ]);

        // Redirect back to the main page with a success message
        header("Location: ../index.php?message=Module+added+successfully");
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
