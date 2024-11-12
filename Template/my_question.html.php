<main class="p-4">
    <?php if (!empty($questions)): ?>
        <?php foreach ($questions as $question): ?>
            <div class="flex bg-white shadow-lg rounded-lg p-4 mb-4">
                <div class="flex-grow">
                    <h2 class="text-xl font-bold"><?php echo htmlspecialchars($question['title']); ?></h2>
                    <p><?php echo htmlspecialchars($question['content']); ?></p>

                    <!-- Display the module name -->
                    <?php if (!empty($question['module_name'])): ?>
                        <p class='text-sm text-gray-600'>Module: <?php echo htmlspecialchars($question['module_name']); ?></p>
                    <?php endif; ?>
                    
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
