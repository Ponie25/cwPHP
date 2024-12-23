<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

session_start();


// Check user login 
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
    $module_id = $_POST['module_id'];    
    
    // Basic validation
    if (!empty($title) && !empty($content) && !empty($module_id)) {
        // Handle image upload
        $imagePath = null;
        if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
            $image = $_FILES['image'];
            
            // Generate a unique filename to avoid conflicts
            $imageName = uniqid() . '-' . basename($image['name']);
            $imagePath = '/PHP-Web-main/uploads/' . $imageName;
            
            // Move the uploaded file to the uploads directory
            move_uploaded_file($image['tmp_name'], $_SERVER['DOCUMENT_ROOT'] . $imagePath);
        }
        

        // Prepare and execute the SQL statement
        $stmt = $pdo->prepare("INSERT INTO posts (title, content, user_id, module_id, image) VALUES (:title, :content, :user_id, :module_id, :image)");
        $stmt->execute([
            ':title' => $title,
            ':content' => $content,
            ':user_id' => $userId,
            ':module_id' => $module_id,
            ':image' => $imagePath
        ]);

        // Redirect back to the main page
        header("Location: ../index.php");
        exit;
    } else {
        echo "Please fill in all fields.";
    }
}
?>
