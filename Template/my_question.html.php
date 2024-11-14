<main class="mt-4 flex-grow grid grid-cols-3 gap-8">
    <?php if (!empty($questions)): ?>
        <?php foreach ($questions as $post): ?>
                <div class='bg-white shadow-lg rounded-lg p-4 mb-4 w-full col-span-1 relative h-full flex justify-between'>
                    <div>
                        <h2 class='text-xl font-bold'><?php echo htmlspecialchars($post['title']); ?></h2>
                        <p><?php echo htmlspecialchars($post['content']); ?></p>
                        
                        <!-- Display the module name -->
                        <?php if (!empty($post['module_name'])): ?>
                            <p class='text-sm text-gray-600'>Module: <?php echo htmlspecialchars($post['module_name']); ?></p>
                        <?php endif; ?>
                        
                        <!-- Display the image -->
                        <?php if (!empty($post['image'])): ?>
                            <img src='<?php echo htmlspecialchars($post['image']); ?>' alt='Post Image' class='w-32 h-auto mt-4 rounded-lg'>
                        <?php endif; ?>
                        
                        <div class='flex items-center justify-between mt-2 absolute bottom-2 w-full'>
                            <div class="flex items-center">
                                <i class='fa-regular fa-heart'></i><span class='ml-1.5'><?php echo $post['likes']; ?></span>
                                <i class='fa-regular fa-comment ml-4'></i><span class='ml-1.5'><?php echo $post['comments']; ?></span>
                                <i class='fa-regular fa-bookmark ml-4'></i><span class='ml-1.5'><?php echo $post['bookmarks']; ?></span>
                            </div>
                            <div class='flex text-gray-500 text-sm space-x-2 px-6'>
                                <p>Author: <?php echo $post['user_id']; ?></p>
                                <p>at: <?php echo $post['created_at']; ?></p>
                            </div>
                        </div>
                    </div>
                    <!-- Edit Post -->
                    <div class="flex">
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
                </div>
        <?php endforeach; ?>
    <?php else: ?>
        <p>You haven't posted any questions yet.</p>
    <?php endif; ?>
</main>

