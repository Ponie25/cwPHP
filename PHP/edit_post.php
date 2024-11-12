<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];

    // Fetch the post data
    $stmt = $pdo->prepare("SELECT title, content, image FROM posts WHERE id = :post_id");
    $stmt->execute(['post_id' => $postId]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // Fetch modules
    $stmt = $pdo->query("SELECT id, module_name FROM modules");
    $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    header("Location: my_question.php");
    exit;
}

$title = 'Edit Post';

ob_start();
include '../Template/edit_post.html.php';
$content = ob_get_clean();

include '../Template/layout.html.php';
?>
