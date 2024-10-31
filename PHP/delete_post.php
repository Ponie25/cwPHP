<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

session_start();



// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $post_id = $_POST["post_id"];
    // Prepare and execute the SQL statement
    $stmt = $pdo->prepare("DELETE FROM posts WHERE id = :post_id");
    $stmt->execute([
        ':post_id' => $post_id
    ]);

    // Redirect back to the main page
    header("Location: ../index.php");
    exit;
} else {
    echo "Please fill in all fields.";
}
?>
