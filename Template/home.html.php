<div class="flex items-center justify-between w-full mt-4"> 
    <div class="text-2xl font-bold">Newsfeed</div>
    <button onclick="toggleModal('uploadModal')" class="bg-black text-white px-4 py-2 rounded-lg hover:bg-blue-600" type="button">Upload</button>
</div>

<div class="flex w-full space-x-8">

    <!-- Main content -->
    <section class="mt-4 flex-grow grid grid-cols-3 gap-8">
        <?php if (!empty($posts)): ?>
            <?php foreach ($posts as $post): ?>
                <div class='bg-white shadow-lg rounded-lg p-4 mb-4 w-full col-span-1 relative h-full'>
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
            <?php endforeach; ?>
        <?php else: ?>
            <p>No posts available.</p>
        <?php endif; ?>
    </section>
</div>
