<div class="p-4">
    <h1 class="text-2xl font-bold mb-4">Edit Post</h1>
    <form action="process_edit.php" method="post" enctype="multipart/form-data" class="space-y-4">
        <input type="hidden" name="post_id" value="<?php echo htmlspecialchars($postId); ?>">

        <!-- Module Selection -->
        <div>
            <label class="block text-sm font-medium">Module</label>
            <select name="module_id" id="module" required class="w-full p-2 border mb-4">
                <option value="">Select Module</option>
                <?php foreach ($modules as $module): ?>
                    <option value="<?= htmlspecialchars($module['id']) ?>"><?= htmlspecialchars($module['module_name']) ?></option>
                <?php endforeach; ?>
            </select>
        </div>

        <!-- Title -->
        <div>
            <label class="block text-sm font-medium">Title</label>
            <input type="text" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" class="w-full p-2 border rounded">
        </div>

        <!-- Content -->
        <div>
            <label class="block text-sm font-medium">Content</label>
            <textarea name="content" rows="5" class="w-full p-2 border rounded"><?php echo htmlspecialchars($post['content']); ?></textarea>
        </div>

        <!-- Image Upload -->
        <div>
            <label class="block text-sm font-medium">Upload New Image (Optional)</label>
            <input type="file" name="image" class="w-full p-2 border rounded mb-4">
            
            <!-- Display current image if available -->
            <?php if (!empty($post['image'])): ?>
                <img src="<?php echo htmlspecialchars($post['image']); ?>" alt="Current Image" class="w-32 h-auto mt-4 rounded-lg">
            <?php endif; ?>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
            Save Changes
        </button>
    </form>
</div>
