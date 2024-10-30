<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

session_start();


// Check user login or not
if (!isset($_SESSION['user_id'])) {
    echo "User is not logged in. Please log in to upload a post.";
    exit;
}

$userId = $_SESSION['user_id'];



// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Get form data
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $userId = $_SESSION['user_id'] ?? null;
    // $author = trim($_POST['author']);

    // Basic validation
    if (!empty($title) && !empty($content)) {
        // Prepare and execute the SQL statement
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id) VALUES (:title, :content, :user_id)");
        $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':user_id' => $userId
        ]);

        // Redirect back to the main page
        header("Location: ../index.php");
        exit;
    } else {
        echo "Please fill in all fields.";
    }
}
?>
