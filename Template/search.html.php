<main class="p-4">
    <h1 class="text-2xl font-bold mb-4">Search Results</h1>
    
    <?php if (empty($posts)): ?>
        <p>No posts found matching your search criteria.</p>
    <?php else: ?>
        <?php foreach ($posts as $post): ?>
            <div class='bg-white shadow-lg rounded-lg p-4 mb-4 w-full'>
                <h2 class='text-xl font-bold'><?php echo htmlspecialchars($post['title']); ?></h2>
                <p class='text-gray-700'><?php echo htmlspecialchars($post['content']); ?></p>
                <p class='text-gray-500 text-sm'>
                    Posted by <?php echo htmlspecialchars($post['author'] ?? 'Unknown') . " on " . htmlspecialchars($post['created_at']); ?>
                </p>
                <div class='flex items-center mt-2'>
                    <i class='fa-regular fa-heart'></i>
                    <span class='ml-1.5'><?php echo htmlspecialchars($post['likes'] ?? 0); ?></span>
                    <i class='fa-regular fa-comment ml-4'></i>
                    <span class='ml-1.5'><?php echo htmlspecialchars($post['comments'] ?? 0); ?></span>
                    <i class='fa-regular fa-bookmark ml-4'></i>
                    <span class='ml-1.5'><?php echo htmlspecialchars($post['bookmarks'] ?? 0); ?></span>
                </div>
            </div>
        <?php endforeach; ?>
    <?php endif; ?>
</main>
