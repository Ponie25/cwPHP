<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

<<<<<<< HEAD
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
=======
// Check if the post_id is provided
if (isset($_GET['post_id'])) {
    $postId = $_GET['post_id'];

    // Fetch the post details from the database
    $stmt = $pdo->prepare("SELECT title, content, image FROM posts WHERE id = :post_id");
    $stmt->execute(['post_id' => $postId]);
    $post = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the post exists
    if (!$post) {
        echo "Post not found.";
        exit;
    }
} else {
    header("Location: my_question.php");
    exit;
}

$title = 'Edit Post';

// Start output buffering to capture the main content
ob_start();
?>

<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Post</h1>
    <form action="process_edit.php" method="post" enctype="multipart/form-data" class="space-y-4">
        <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($postId); ?>">

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium">Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" class="w-full p-2 border rounded">
        </div>

        <!-- Content -->
        <div>
            <label class="block text-sm font-medium">Content</label>
            <textarea name="content" rows="5" class="w-full p-2 border rounded"><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>

        <!-- Image Upload -->
        <div>
            <label class="block text-sm font-medium">Upload New Image (Optional)</label>
            <input type="file" name="image" class="w-full p-2 border rounded mb-4">
            
            <!-- Display current image if available -->
            <?php if (!empty($post['image'])): ?>
                <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Current Image" class="w-32 h-auto mt-4 rounded-lg">
            <?php endif; ?>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Save Changes
        </button>
    </form>
</div>

<?php
// Assign the captured output to $content
$content = ob_get_clean();

// Include the layout file to display everything within layout.html.php
include '../Template/layout.html.php';
>>>>>>> 574914f (New update)
?>
