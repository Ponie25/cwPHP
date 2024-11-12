<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/session_start.php';
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

if (!isset($_SESSION['user_id'])) {
    echo "<script>
            alert('Please login first');
            window.location.href = '../index.php';
          </script>";
    exit;
}

// Retrieve the user’s questions
$userId = $_SESSION['user_id'];

// SQL statement
$stmt = $pdo->prepare("
    SELECT posts.id, posts.title, posts.content, posts.user_id, posts.likes, posts.comments, posts.bookmarks, posts.image, posts.created_at,
           modules.module_name 
    FROM posts
    LEFT JOIN modules ON posts.module_id = modules.id
    WHERE posts.user_id = :user_id
    ORDER BY posts.created_at DESC
");
$stmt->execute(['user_id' => $userId]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'My Questions';

ob_start();
include '../Template/my_question.html.php';
$content = ob_get_clean(); 

include '../Template/layout.html.php';
?>
