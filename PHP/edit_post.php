<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

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

        <!-- Module -->
            <!-- SQL statement to show all modules -->
            <?php
            $stmt = $pdo->query("SELECT id, module_name FROM modules");
            $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
            ?>

            <!-- Module Selection -->
            <select name="module_id" id="module" required class="w-full p-2 border mb-4">
                    <option value="">Select Module</option>
                    <?php foreach ($modules as $module): ?>
                        <option value="<?= $module['id'] ?>"><?= htmlspecialchars($module['module_name']) ?></option>
                    <?php endforeach; ?>
                </select>
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

include '../Template/layout.html.php';
?>
