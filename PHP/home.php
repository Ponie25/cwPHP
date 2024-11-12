<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';
$title = 'Home - Student Social Media';

// Fetch Modules
$stmt = $pdo->query("SELECT * FROM modules");
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Check if a specific module is selected to filter posts
if (isset($_GET['module_id'])) {    
    $module_id = $_GET['module_id'];
    $stmt = $pdo->prepare("
        SELECT posts.title, posts.content, posts.user_id, posts.likes, posts.comments, posts.bookmarks, posts.image, posts.created_at,
               modules.module_name 
        FROM posts 
        LEFT JOIN modules ON posts.module_id = modules.id
        WHERE posts.module_id = :module_id
        ORDER BY posts.created_at DESC
    ");
    $stmt->execute(['module_id' => $module_id]);
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
} else {
    // Fetch all posts if no module is selected
    $stmt = $pdo->query("
        SELECT posts.title, posts.content, posts.user_id, posts.likes, posts.comments, posts.bookmarks, posts.image, posts.created_at,
               modules.module_name 
        FROM posts 
        LEFT JOIN modules ON posts.module_id = modules.id 
        ORDER BY posts.created_at DESC
    ");
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
}


ob_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/Template/home.html.php';
$content = ob_get_clean();

include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/Template/layout.html.php';
?>