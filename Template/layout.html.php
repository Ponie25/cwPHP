<?php
session_start();
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?? 'Student Social Media'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
<body>
    <?php include 'PHP/config/db.php'; ?>
    
    <!-- Header -->
    <header class="flex items-center justify-between bg-white text-black p-4">
        <div class="logo">
            <img src="images/logo.jpeg" alt="Student Social Media" class="w-16 h-12 rounded-lg">
        </div>
        <div class="mid flex item-center justify-center flex-grow"> 
            <a href="../index.php" class="hover:text-yellow-900 px-3 py-2 rounded"><i class="fa-solid fa-igloo ml-4"></i> Home</a>
            <a href="/about" class="hover:text-yellow-900 px-3 py-2 rounded"><i class="fa-regular fa-address-card ml-4"></i> About</a>
            <a href="PHP/my_question.php" class="hover:text-yellow-900 px-3 py-2 rounded"><i class="fa-solid fa-user-tie"></i> My Questions</a>
            <form action="" class="relative flex items-center">
                <i class="fa-solid fa-magnifying-glass absolute left-3 text-gray-500"></i>
                <input type="text" name="search" placeholder="Type anything to search..." 
                    class="pl-10 hover:text-yellow-900 px-3 py-2 border rounded w-full md:w-64 lg:w-80"">
            </form>

        </div>

        <!-- Login/Register section -->
        <div class="login flex space-x-4">
            <?php if (isset($_SESSION['username'])): ?>
                <!-- Show "Me" Section when logged in -->
                <div class="me-section">
                    <a class="hover:text-yellow-900 px-3 py-2 rounded">
                        <i class="fa-solid fa-user"></i>
                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                    </a>
                    <a href="PHP/process_logout.php" class="hover:text-yellow-900 px-3 py-2 rounded">Logout</a>
                </div>
            <?php else: ?>
                <!-- Show Login and Register buttons if not logged in -->
                <button onclick="toggleModal('loginModal')" class="hover:text-yellow-900 px-3 py-2 rounded">Login</button>
                <button onclick="toggleModal('registerModal')" class="hover:text-yellow-900 px-3 py-2 rounded">Register</button>
            <?php endif; ?>
        </div>

    </header>

    <!-- Main Content -->
    <main class="px-40">
        <?php echo $content; ?>
    </main>

    <!-- Footer -->
    <footer class="bg-white text-black py-4">
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

    <script src="/PHP-Web-Main/JS/script.js"></script>


</body>
</html>
