<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $content = trim($_POST['search']);
    
    // SQL statement to search posts
    $stmt = $pdo->prepare("SELECT * FROM posts WHERE content LIKE :content");
    $stmt->execute([':content' => '%' . $content . '%']); 
    $posts = $stmt->fetchAll(PDO::FETCH_ASSOC);
    
    // Start output buffering to capture content
    ob_start();
?>

<main class="p-4">
    <h1 class="text-2xl font-bold mb-4">Search Results</h1>
    
    <?php
    if (empty($posts)) {
        echo "<p>No posts found matching your search criteria.</p>";
    } else {
        foreach ($posts as $post) {
            echo "<div class='bg-white shadow-lg rounded-lg p-4 mb-4 w-full'>";
            echo "<h2 class='text-xl font-bold'>" . htmlspecialchars($post['title']) . "</h2>";
            echo "<p class='text-gray-700'>" . htmlspecialchars($post['content']) . "</p>";
            echo "<p class='text-gray-500 text-sm'>Posted by " . htmlspecialchars($post['author'] ?? 'Unknown') . " on " . htmlspecialchars($post['created_at']) . "</p>";
            echo "<div class='flex items-center mt-2'>";
            echo "<i class='fa-regular fa-heart'></i><span class='ml-1.5'>" . htmlspecialchars($post['likes'] ?? 0) . "</span>";
            echo "<i class='fa-regular fa-comment ml-4'></i><span class='ml-1.5'>" . htmlspecialchars($post['comments'] ?? 0) . "</span>";
            echo "<i class='fa-regular fa-bookmark ml-4'></i><span class='ml-1.5'>" . htmlspecialchars($post['bookmarks'] ?? 0) . "</span>";
            echo "</div>";
            echo "</div>";
        }
    }
    ?>
</main>

<?php
    // Capture all output above into $content
    $content = ob_get_clean();

    // Include layout and pass in dynamic content
    include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/Template/layout.html.php';
    
}
