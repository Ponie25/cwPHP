<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';
$title = 'Home - Student Social Media';
ob_start();

?>

<div class="flex items-center justify-between mb-4 w-full"> 
    <div class="text-2xl font-bold">Newsfeed</div>
    <button onclick="toggleModal('uploadModal')" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-blue-600" type="button">Upload</button>
</div>

<section class="mt-4">
    <?php
    // SQL statement
    $stmt = $pdo->query("
        SELECT posts.title, posts.content, posts.user_id, posts.likes, posts.comments, posts.bookmarks, posts.image, posts.created_at,
            modules.module_name 
        FROM posts 
        LEFT JOIN modules ON posts.module_id = modules.id 
        ORDER BY posts.created_at DESC
    ");
    while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='bg-white shadow-lg rounded-lg p-4 mb-4 w-full'>";
        
        // Display the title and content
        echo "<h2 class='text-xl font-bold'>{$post['title']}</h2>";
        echo "<p>{$post['content']}</p>";
        
        // Display the module name
        if (!empty($post['module_name'])) {
            echo "<p class='text-sm text-gray-600'>Module: {$post['module_name']}</p>";
        }
        
        // Display the image
        if (!empty($post['image'])) {
            echo "<img src='{$post['image']}' alt='Post Image' class='w-32 h-auto mt-4 rounded-lg'>";
        }
        
        // Display post details and stats
        echo "<div class='flex text-gray-500 text-sm space-x-4'>";
        echo "<p>Posted by User ID: {$post['user_id']}</p>";
        echo "<p>at: {$post['created_at']}</p>";
        echo "</div>";
        echo "<div class='flex items-center mt-2'>";
        echo "<i class='fa-regular fa-heart'></i><span class='ml-1.5'>{$post['likes']}</span>";
        echo "<i class='fa-regular fa-comment ml-4'></i><span class='ml-1.5'>{$post['comments']}</span>";
        echo "<i class='fa-regular fa-bookmark ml-4'></i><span class='ml-1.5'>{$post['bookmarks']}</span>";
        echo "</div></div>";
    }
    ?>
</section>

<?php
$content = ob_get_clean();
include 'Template/layout.html.php';
?>
