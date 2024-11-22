<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';
include 'session_start.php';

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST['post_id']) && isset($_SESSION['user_id'])) {
    $post_id = intval($_POST['post_id']);
    $user_id = intval($_SESSION['user_id']);

    // Check if the user already liked the post
    $stmt = $pdo->prepare("SELECT * FROM post_likes WHERE user_id = :user_id AND post_id = :post_id");
    $stmt->execute([
        ':user_id' => $user_id,
        ':post_id' => $post_id
    ]);

    $like = $stmt->fetch();

    if ($like) {
        // User already liked the post, so unlike it
        $stmt = $pdo->prepare("DELETE FROM post_likes WHERE user_id = :user_id AND post_id = :post_id");
        $stmt->execute([
            ':user_id' => $user_id,
            ':post_id' => $post_id
        ]);

        // -1 like in POSTS
        $stmt = $pdo->prepare("UPDATE posts SET likes = likes - 1 WHERE id = :post_id");
        $stmt->execute([':post_id' => $post_id]);

    } else {
        // Add the like to the post_likes table
        $stmt = $pdo->prepare("INSERT INTO post_likes (user_id, post_id) VALUES (:user_id, :post_id)");
        $stmt->execute([
            ':user_id' => $user_id,
            ':post_id' => $post_id
        ]);

        // +1 like in POSTS
        $stmt = $pdo->prepare("UPDATE posts SET likes = likes + 1 WHERE id = :post_id");
        $stmt->execute([':post_id' => $post_id]);
    }

    // Redirect back to the previous page
    header("Location: /PHP-Web-main/index.php");
    exit;
} else {
    // Redirect if accessed incorrectly
    $_SESSION['error'] = "You need to log in to comment.";
    header("Location: /PHP-Web-main/index.php");
    exit;
}
?>
