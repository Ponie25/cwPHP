<?php include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/session_start.php'; ?>
<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?? 'Student Social Media'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body class="bg-gray-100 min-h-screen">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php'; ?>
    
    <!-- Header -->
    <header class="flex items-center justify-between bg-white text-black p-4 shadow-md">
        <div class="logo">
            <img src="/PHP-Web-main/images/logo.jpeg" alt="Student Social Media" class="w-16 h-12 rounded-lg">
        </div>
        <div class="mid flex item-center justify-center flex-grow"> 
            <a href="/PHP-Web-main/index.php" class="hover:text-yellow-900 px-3 py-2 rounded"><i class="fa-solid fa-igloo ml-4"></i> Home</a>
            <a href="/PHP-Web-main/PHP/contact.php" class="hover:text-yellow-900 px-3 py-2 rounded"><i class="fa-regular fa-address-card ml-4"></i> Contact</a>
            <a href="/PHP-Web-main/PHP/my_question.php" class="hover:text-yellow-900 px-3 py-2 rounded"><i class="fa-solid fa-user-tie"></i> My Questions</a>
            <!-- Search bar -->
            <form action="PHP/process_search.php" method="POST" class="relative flex items-center ml-2">
                <i class="fa-solid fa-magnifying-glass absolute left-3 text-gray-500"></i>
                <input type="text" name="search" placeholder="Type anything to search..." 
                    class="pl-10 hover:text-yellow-900 px-3 py-2 border rounded w-full md:w-64 lg:w-80"">
            </form>
        </div>
        <!-- Admin Dashboard -->
        <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 1): ?>
            <a href="/PHP-Web-main/PHP/admin_dashboard.php" class="hover:text-blue-700">Admin Dashboard</a>
        <?php endif; ?>


        
        <!-- Login/Register section -->
        <div class="login flex space-x-4">
            <?php if (isset($_SESSION['username'])): ?>
                <!-- Show "Me" Section when logged in -->
                <div class="me-section">
                    <a class="hover:text-yellow-900 px-3 py-2 rounded">
                        <i class="fa-solid fa-user"></i>
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </a>
                    <a href="/PHP-Web-main/PHP/process_logout.php" class="hover:text-yellow-900 px-3 py-2 rounded">Logout</a>
                </div>
            <?php else: ?>
                <!-- Show Login and Register buttons if not logged in -->
                <button onclick="toggleModal('loginModal')" class="hover:text-yellow-900 px-3 py-2 rounded">Login</button>
                <button onclick="toggleModal('registerModal')" class="hover:text-yellow-900 px-3 py-2 rounded">Register</button>
            <?php endif; ?>
        </div>

    </header>

    <!-- Main Content -->
    <main class="px-40 min-h-screen">
        <?php echo $content; ?>
    </main>




    <!-- Modal -->

    <!-- Upload post modal -->
    <div id="uploadModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
        <div class="bg-white p-6 rounded-lg w-1/3">
            <h2 class="text-xl font-bold mb-4">Upload Post</h2>
            <form action="/PHP-Web-main/PHP/upload_post.php" method="POST" enctype="multipart/form-data">
                <!-- Module -->
                <!-- SQL statement to show all modules -->
                <?php
                $stmt = $pdo->query("SELECT id, module_name FROM modules");
                $modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
                ?>

                <!-- Module Selection -->
                <select name="module_id" id="module" required class="w-full p-2 border mb-4">
                    <option value="">Select Module</option>
                    <?php foreach ($modules as $module): ?>
                        <option value="<?= $module['id'] ?>"><?= htmlspecialchars($module['module_name']) ?></option>
                    <?php endforeach; ?>
                </select>

                <!-- Title -->
                <input type="text" name="title" placeholder="Title" class="w-full p-2 border mb-4">
                <!-- Content -->
                <textarea name="content" placeholder="Content" class="w-full p-2 border mb-4"></textarea>
                <!-- Image Upload -->
                <input type="file" name="image" class="w-full p-2 border mb-4">
                
                <div class="flex space-x-4 justify-between">
                    <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-lg">Post</button>
                    <button type="button" onclick="toggleModal('uploadModal')" class="text-red-500 px-4 py-2">Cancel</button>
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

    <script src="/PHP-Web-main/JS/script.js"></script>




    


</body>
    <!-- Footer -->
<footer class="bg-white text-black py-4 shadow-md">
<div class="container mx-auto text-center">
    <p>© 2024 Student Social Media. All rights reserved.</p>
    <p>Dev : Thanh</p>
    <div class="flex space-x-4 justify-center items-center mt-2">
        <i class="fa-brands fa-facebook"></i>
        <i class="fa-brands fa-github"></i>
        <i class="fa-brands fa-telegram"></i>
    </div>
</div>
</footer>
</html>
