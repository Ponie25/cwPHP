<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    header("Location: PHP/login.php");
    exit;
}

// Retrieve the user’s questions
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT title, content, created_at, id, image FROM posts WHERE user_id = :user_id ORDER BY created_at DESC");
$stmt->execute(['user_id' => $userId]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'My Questions';

// Start output buffering to capture the main content
ob_start();
?>

<main class="p-4">
    <?php if (!empty($questions)): ?>
        <?php foreach ($questions as $question): ?>
            <div class="flex bg-white shadow-lg rounded-lg p-4 mb-4">
                <div class="flex-grow">
                    <h2 class="text-xl font-bold"><?php echo htmlspecialchars($question['title']); ?></h2>
                    <p><?php echo htmlspecialchars($question['content']); ?></p>
                    
                    <!-- Display Image if Available -->
                    <?php if (!empty($question['image'])): ?>
                        <img src="<?php echo htmlspecialchars($question['image']); ?>" alt="Post Image" class="w-32 h-auto mt-4 rounded-lg">
                    <?php endif; ?>
                    
                    <p class="text-gray-500 text-sm">Posted on <?php echo $question['created_at']; ?></p>
                </div>

                <!-- Edit Post -->
                <div class="mr-2">
                    <form action="edit_post.php" method="get">
                        <input type="hidden" name="post_id" value="<?php echo $question['id']; ?>">
                        <button type="submit" class="hover:text-blue-900 focus:outline-none">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>
                </div>

                <!-- Delete Post -->
                <div class="ml-auto">
                    <form action="delete_post.php" method="post">
                        <input type="hidden" name="post_id" value="<?php echo $question['id']; ?>">
                        <button type="submit" class="hover:text-red-900 focus:outline-none">
                            <i class="fa-solid fa-trash"></i>  
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You haven't posted any questions yet.</p>
    <?php endif; ?>
</main>

<?php
// Assign the captured output to $content
$content = ob_get_clean();

include '../Template/layout.html.php';
