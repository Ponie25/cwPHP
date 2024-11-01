<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['post_id'])) {
    $postId = $_POST['post_id'];
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $module_id = $_POST['module_id'];
    
    // Fetch current image path
    $stmt = $pdo->prepare("SELECT image FROM posts WHERE id = :post_id");
    $stmt->execute(['post_id' => $postId]);
    $currentPost = $stmt->fetch(PDO::FETCH_ASSOC);
    $currentImage = $currentPost['image'];

    // Handle new image upload if provided
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        // Delete the old image if it exists
        if ($currentImage && file_exists($_SERVER['DOCUMENT_ROOT'] . $currentImage)) {
            unlink($_SERVER['DOCUMENT_ROOT'] . $currentImage);
        }

        $image = $_FILES['image'];
        $imageName = uniqid() . '-' . basename($image['name']);
        $imagePath = '/PHP-Web-main/uploads/' . $imageName;
        move_uploaded_file($image['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imagePath);
    } else {
        // Keep the current image if no new image is uploaded
        $imagePath = $currentImage;
    }

    // SQL update post
    $stmt = $pdo->prepare("UPDATE posts SET title = :title, content = :content, image = :image , module_id = :module_id WHERE id = :post_id");
    $stmt->execute(['title' => $title, 'content' => $content, 'image' => $imagePath, 'post_id' => $postId, 'module_id' => $module_id]);

    // Redirect back to my_question.php
    header("Location: my_question.php");
    exit;
}
