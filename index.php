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
    $stmt = $pdo->query("SELECT title, content, user_id, likes, comments, bookmarks, image FROM posts ORDER BY created_at DESC");
    while ($post = $stmt->fetch(PDO::FETCH_ASSOC)) {
        echo "<div class='bg-white shadow-lg rounded-lg p-4 mb-4 w-full'>";
        
        // Display the title and content
        echo "<h2 class='text-xl font-bold'>{$post['title']}</h2>";
        echo "<p>{$post['content']}</p>";
        
        // Display the image if it exists
        if (!empty($post['image'])) {
            echo "<img src='{$post['image']}' alt='Post Image' class='w-32 h-auto mt-4 rounded-lg'>";
        }
        
        // Display post details and stats
        echo "<p class='text-gray-500 text-sm'>Posted by {$post['user_id']}</p>";
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
