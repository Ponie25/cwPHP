<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';
$title = 'Home - Student Social Media';
ob_start();

?>

<div class="flex items-center justify-between mb-4 w-full"> 
    <div class="text-2xl font-bold">Newsfeed</div>
    <button onclick="uploadModal()" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-blue-600" type="button">Upload</button>
</div>

<section class="mt-4">
    <?php
    $stmt = $pdo->query("SELECT title, content, user_id, likes, comments, bookmarks FROM posts ORDER BY created_at DESC");
    while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='bg-white shadow-lg rounded-lg p-4 mb-4 w-full'>";
        echo "<h2 class='text-xl font-bold'>{$post['title']}</h2>";
        echo "<p>{$post['content']}</p>";
        echo "<p class='text-gray-500 text-sm'>Posted by {$post['user_id']}</p>";
        echo "<div class='flex items-center mt-2'>";
        echo "<i class='fa-regular fa-heart'></i><span class='ml-1.5'>{$post['likes']}</span>";
        echo "<i class='fa-regular fa-comment ml-4'></i><span class='ml-1.5'>{$post['comments']}</span>";
        echo "<i class='fa-regular fa-bookmark ml-4'></i><span class='ml-1.5'>{$post['bookmarks']}</span>";
        echo "</div></div>";
    }
    ?>
</section>


<!-- Upload post modal -->
<div id="uploadModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h2 class="text-xl font-bold mb-4">Upload a new post</h2>
        <form action="/PHP-Web-main/PHP/upload_post.php" method="POST">
            <!-- Title -->
                <input type="text" name="title" placeholder="Title" class="w-full p-2 border mb-4">
            <!-- Content -->
            <textarea name="content" placeholder="Content" class="w-full p-2 border mb-4"></textarea>

            <div class="flex space-x-4 justify-between">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Post</button>
                <button type="button" onclick="uploadModal()" class="text-red-500 px-4 py-2">Cancel</button>
            </div>
        </form>
    </div>
</div>

<!-- Login Modal -->
<div id="loginModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h2 class="text-xl font-bold mb-4">Login</h2>
        <form action="PHP/process_login.php" method="POST">
            <input type="text" name="username" placeholder="Username" class="w-full p-2 border mb-4">
            <input type="password" name="password" placeholder="Password" class="w-full p-2 border mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Login</button>
            <button type="button" onclick="toggleModal('loginModal')" class="text-red-500 px-4 py-2">Cancel</button>
        </form>
    </div>
</div>

<!-- Register Modal -->
<div id="registerModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
    <div class="bg-white p-6 rounded-lg w-1/3">
        <h2 class="text-xl font-bold mb-4">Register</h2>
        <form action="PHP/process_register.php" method="POST">
            <input type="text" name="username" placeholder="Username" class="w-full p-2 border mb-4">
            <input type="password" name="password" placeholder="Password" class="w-full p-2 border mb-4">
            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Register</button>
            <button type="button" onclick="toggleModal('registerModal')" class="text-red-500 px-4 py-2">Cancel</button>
        </form>
    </div>
</div>



<?php
$content = ob_get_clean();
include 'Template/layout.html.php';

?>
