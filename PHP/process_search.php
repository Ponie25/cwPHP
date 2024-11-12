<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $content = trim($_POST['search']);
    
    // SQL statement 
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE content LIKE :content");
    $stmt->execute([':content' => '%' . $content . '%']); 
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

    $title = 'Search Results';


    ob_start();
    include '../Template/search.html.php';
    $content = ob_get_clean();

    include '../Template/layout.html.php';
}
