<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /PHP-Web-main/PHP/login.php");
    exit;
}

// Process the form submission
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    // Retrieve post data from form
    $id = $_POST['id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $userId = $_SESSION['user_id']; // Retrieve user ID from session

    // Validate the form fields
    if (empty($title) || empty($content)) {
        echo "Title and content cannot be empty.";
        exit;
    }

    // Prepare and execute the update statement
    $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content WHERE id = :id AND user_id = :user_id");
    $stmt->execute([
        ':title' => $title,
        ':content' => $content,
        ':id' => $id,
        ':user_id' => $userId
    ]);

    // Redirect back to the My Questions page
    header("Location: /PHP-Web-main/PHP/my_question.php");
    exit;
}

// If no post data is submitted, redirect to My Questions page
header("Location: /PHP-Web-main/PHP/my_question.php");
exit;
?>
