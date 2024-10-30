<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';
session_start();

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: /PHP-Web-main/PHP/login.php");
    exit;
}

// Retrieve the user’s questions along with likes, comments, and bookmarks
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT id, title, content, created_at, likes, comments, bookmarks FROM posts WHERE user_id = :user_id ORDER BY created_at DESC");
$stmt->execute(['user_id' => $userId]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'My Questions';

// Start output buffering to capture content for layout
ob_start();
?>

<main class="p-4">
    <h1 class="text-2xl font-bold mb-4">My Questions</h1>
    <?php if (!empty($questions)): ?>
        <?php foreach ($questions as $question): ?>
            <div class="bg-white shadow-lg rounded-lg p-4 mb-4">
                <div class="flex justify-between">
                    <h2 class="text-xl font-bold"><?php echo ($question['title']); ?></h2>
                    <div class="flex space-x-4">
                        <!-- Edit Icon with link to open modal and populate fields -->
                        <button title="Edit" onclick="openEditModal('<?php echo $question['id']; ?>', '<?php echo addslashes($question['title']); ?>', '<?php echo addslashes($question['content']); ?>'); return false;">
                            <i class="fa-regular fa-pen-to-square"></i>
                        </button>

                        <a onclick="toggleModal('deleteModal')">
                            <i class="fa-solid fa-trash"></i>
                        </a>
                    </div>
                </div>
                <p><?php echo htmlspecialchars($question['content']); ?></p>
                <p class="text-gray-500 text-sm">Posted on <?php echo $question['created_at']; ?></p>
            </div>
            
            
                <!-- Display likes, comments, and bookmarks -->
                <div class="flex items-center mt-2">
                    <i class="fa-regular fa-heart"></i><span class="ml-1.5"><?php echo $question['likes'] ?? 0; ?></span>
                    <i class="fa-regular fa-comment ml-4"></i><span class="ml-1.5"><?php echo $question['comments'] ?? 0; ?></span>
                    <i class="fa-regular fa-bookmark ml-4"></i><span class="ml-1.5"><?php echo $question['bookmarks'] ?? 0; ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You haven't posted any questions yet.</p>
    <?php endif; ?>
</main>

<!-- Edit Modal -->
<div id="editModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h2 class="text-xl font-bold mb-4">Edit Post</h2>
        <form action="/PHP-Web-main/PHP/edit_post.php" method="POST">
            <!-- Hidden field for post ID -->
            <input type="hidden" name="id" id="postId">
            <!-- Title field -->
            <input type="text" name="title" id="postTitle" placeholder="Title" class="w-full p-2 border mb-4">
            <!-- Content field -->
            <textarea name="content" id="postContent" placeholder="Content" class="w-full p-2 border mb-4"></textarea>

            <div class="flex space-x-4 justify-between">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Save Changes</button>
                <button type="button" onclick="document.getElementById('editModal').classList.add('hidden');" class="text-red-500 px-4 py-2">Cancel</button>
            </div>
        </form>
    </div>
</div>

<?php

// Store the output in $content and end buffering
$content = ob_get_clean();

// Include the main layout, passing in the $content
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/Template/layout.html.php';
