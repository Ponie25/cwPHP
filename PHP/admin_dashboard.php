<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

// Check if user is logged in and is admin
if (!isset($_SESSION['user_id']) || $_SESSION['role'] !== 1) {
    header("Location: ../index.php");
    exit;
}

// Fetch all posts for management
$stmt = $pdo->query("SELECT * FROM posts ORDER BY created_at DESC");
$posts = $stmt->fetchAll(PDO::FETCH_ASSOC);

// Fetch all users for management
$userStmt = $pdo->query("SELECT * FROM users ORDER BY created_at DESC");
$users = $userStmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'Admin Dashboard';

// Start output buffering to capture the main content
ob_start();
?>

<main class="p-4">
    <h1 class="text-2xl font-bold mb-4">Admin Dashboard</h1>
    <!-- Toggle Buttons -->
    <div class="flex space-x-4 mb-6">
        <button onclick="toggleModal('managepostModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Manage Posts</button>
        <button onclick="toggleModal('manageuserModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Manage Users</button>
        <button onclick="toggleModal('adduserModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Add user</button>
        <button onclick="toggleModal('addmoduleModal')" class="bg-blue-500 text-white px-4 py-2 rounded">Add module</button>
    </div>

    <!-- Manage Posts Modal -->
    <div id="managepostModal" class="hidden mb-6">
        <h2 class="text-xl font-semibold mb-3">Manage Posts</h2>
        <?php foreach ($posts as $post): ?>
            <div class="flex bg-white shadow-lg rounded-lg p-4 mb-4">
                <div class="flex-grow">
                    <h2 class="text-xl font-bold"><?php echo htmlspecialchars($post['title']); ?></h2>
                    <p><?php echo htmlspecialchars($post['content']); ?></p>
                    
                    <!-- Display Image if Available -->
                    <?php if (!empty($post['image'])): ?>
                        <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Post Image" class="w-32 h-auto mt-4 rounded-lg">
                    <?php endif; ?>
                    
                    <p class="text-gray-500 text-sm">Posted on <?php echo $post['created_at']; ?></p>
                </div>

                <!-- Edit Post -->
                <div class="mr-2">
                    <form action="edit_post.php" method="get">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <button type="submit" class="hover:text-blue-900 focus:outline-none">
                            <i class="fa-solid fa-pen-to-square"></i>
                        </button>
                    </form>
                </div>

                <!-- Delete Post -->
                <div class="ml-auto">
                    <form action="delete_post.php" method="post">
                        <input type="hidden" name="post_id" value="<?php echo $post['id']; ?>">
                        <button type="submit" class="hover:text-red-900 focus:outline-none">
                            <i class="fa-solid fa-trash"></i>  
                        </button>
                    </form>
                </div>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Manage Users Modal -->
    <div id="manageuserModal" class="hidden">
        <h2 class="text-xl font-semibold mb-3">Manage Users</h2>
        <?php foreach ($users as $user): ?>
            <div class="bg-white shadow-lg rounded-lg p-4 mb-4">
                <p><strong>Username:</strong> <?php echo htmlspecialchars($user['username']); ?></p>
                <p><strong>Role:</strong> <?php echo $user['role'] ? 'Admin' : 'User'; ?></p>
                <p><strong>Created_at:</strong> <?php echo htmlspecialchars($user['created_at']); ?></p>
                
                <!-- Admin controls for each user -->
                <?php if ($user['role'] !== 1): // Prevent self-deletion for admin ?>
                    <form action="delete_user.php" method="post" onsubmit="return confirm('Are you sure you want to delete this user?');">
                        <input type="hidden" name="user_id" value="<?php echo $user['id']; ?>">
                        <button type="submit" class="hover:text-red-700 focus:outline-none">Delete User</button>
                    </form>
                <?php endif; ?>
            </div>
        <?php endforeach; ?>
    </div>

    <!-- Add User Modal -->
    <div id="adduserModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Add user</h2>
            <form action="/PHP-Web-main/PHP/add_user.php" method="POST" enctype="multipart/form-data">
                <!-- Username -->
                <input type="text" name="username" placeholder="Enter username" class="w-full p-2 border mb-4">
                <!-- Password -->
                <input type="text" name="password" placeholder="Enter password" class="w-full p-2 border mb-4">
                <!-- Role -->
                <select name="role" id="role" class="w-full p-2 border mb-4">
                    <option value="0">User</option>
                    <option value="1">Admin</option>
                </select>
                <div class="flex space-x-4 justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add</button>
                    <button type="button" onclick="toggleModal('adduserModal')" class="text-red-500 px-4 py-2">Cancel</button>
                </div>
            </form>
        </div>
    </div>

    <!-- Add Module Modal -->
    <div id="addmoduleModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Add user</h2>
            <form action="/PHP-Web-main/PHP/add_module.php" method="POST" enctype="multipart/form-data">
                <!-- Module name -->
                <input type="text" name="module_name" placeholder="Enter Module name" class="w-full p-2 border mb-4">
                <div class="flex space-x-4 justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Add</button>
                    <button type="button" onclick="toggleModal('addmoduleModal')" class="text-red-500 px-4 py-2">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</main>

<?php
$content = ob_get_clean();
include '../Template/layout.html.php';
