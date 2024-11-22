<?php include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/session_start.php'; ?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title ?? 'Student Social Media'; ?></title>
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@400;500;700&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js" defer></script>
    <link href="https://cdn.jsdelivr.net/npm/daisyui@4.12.14/dist/full.min.css" rel="stylesheet" type="text/css" />
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.css" rel="stylesheet" />
</head>
<body class="bg-gray-100 min-h-screen text-black">
    <?php include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php'; ?>
    
    <!-- ALERT (Show by Session error) -->
<?php if (isset($_SESSION['error'])): ?>
    <script>
        alert("<?php echo htmlspecialchars($_SESSION['error']); ?>");
    </script>
    <?php unset($_SESSION['error']); ?>
<?php endif; ?>
    <!-- Header -->
    <nav x-data="{ isOpen: false }" class="relative bg-white shadow">
    <div class="container px-6 mx-auto md:flex w-full">
        <div class="flex items-center justify-between">
            <a href="#">
                <img class="h-12 w-auto object-contain object-center" src="/PHP-Web-main/images/logo1.png" alt="logo">
            </a>

            <!-- Mobile menu button -->
            <div class="flex lg:hidden">
                <button x-cloak @click="isOpen = !isOpen" type="button" class="text-gray-500 hover:text-gray-600 focus:outline-none focus:text-gray-600" aria-label="toggle menu">
                    <svg x-show="!isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M4 8h16M4 16h16" />
                    </svg>
            
                    <svg x-show="isOpen" xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                        <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Mobile Menu open: "block", Menu closed: "hidden" -->
        <div x-cloak :class="[isOpen ? 'translate-x-0 opacity-100 ' : 'opacity-0 -translate-x-full']" class="absolute inset-x-0 z-20 w-full px-6 py-4 transition-all duration-300 ease-in-out bg-white md:mt-0 md:p-0 md:top-0 md:relative md:opacity-100 md:translate-x-0 md:flex md:items-center md:justify-between">
            <div class="flex flex-col px-2 -mx-4 md:flex-row md:mx-10 md:py-0">
                <a href="/PHP-Web-main/index.php" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 md:mx-2">Home</a>
                <a href="/PHP-Web-main/PHP/contact.php" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 md:mx-2">Contact</a>
                <!-- Admin Dashboard -->
                <?php if (isset($_SESSION['role']) && $_SESSION['role'] === 1): ?>
                    <a href="/PHP-Web-main/PHP/admin_dashboard.php" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 md:mx-2">Admin Dashboard</a>
                <?php endif; ?>
            </div>

            <div class="relative mt-4 md:mt-0">
                <span class="absolute inset-y-0 left-0 flex items-center pl-3">
                    <svg class="w-5 h-5 text-gray-400" viewBox="0 0 24 24" fill="none">
                        <path d="M21 21L15 15M17 10C17 13.866 13.866 17 10 17C6.13401 17 3 13.866 3 10C3 6.13401 6.13401 3 10 3C13.866 3 17 6.13401 17 10Z" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"></path>
                    </svg>
                </span>

                <input type="text" class="w-full py-2 pl-10 pr-4 text-gray-700 bg-white border rounded-lg focus:border-blue-400 focus:outline-none focus:ring focus:ring-opacity-40 focus:ring-blue-300" placeholder="Search">
                </div>
            </div>
            <!-- Login/Register section -->
            <div class="login flex space-x-4">
                <?php if (isset($_SESSION['username'])): ?>
                    <!-- Show "Me" Section when logged in -->
                    <div class="flex items-center space-x-4 ml-6">
                        <div class="flex space-x-2 hover:text-yellow-900 items-center">
                            <div x-data="{ isOpen: true }" class="relative inline-block">
                                <!-- Dropdown toggle button -->
                                <button @click="isOpen = !isOpen" class="relative px-2.5 py-2 text-gray-700 rounded-lg transition-colors duration-300 transform hover:bg-gray-100 md:mx-2 w-auto flex space-x-2 items-center">
                                    <i class="fa-solid fa-user"></i>
                                    <span>
                                        <?php echo htmlspecialchars($_SESSION['username']); ?>
                                    </span>
                                </button>

                                <!-- Dropdown menu -->
                                <div x-show="isOpen" 
                                    @click.away="isOpen = false"
                                    x-transition:enter="transition ease-out duration-100"
                                    x-transition:enter-start="opacity-0 scale-90"
                                    x-transition:enter-end="opacity-100 scale-100"
                                    x-transition:leave="transition ease-in duration-100"
                                    x-transition:leave-start="opacity-100 scale-100"
                                    x-transition:leave-end="opacity-0 scale-90" 
                                    class="absolute right-0 z-20 w-48 py-2 mt-2 origin-top-right bg-white rounded-md shadow-xl"
                                >
                                    <a href="/PHP-Web-main/PHP/process_logout.php" class="block px-4 py-3 text-sm text-gray-600 capitalize transition-colors duration-300 transform hover:bg-gray-100">Sign Out</a>
                                </div>
                            </div>
                        </div>
                    </div>
                <?php else: ?>
                    <!-- Show Login and Register buttons if not logged in -->
                    <div class="flex ml-4">
                        <button onclick="toggleModal('loginModal')" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 md:mx-2">Login</button>
                        <button onclick="toggleModal('registerModal')" class="px-2.5 py-2 text-gray-700 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 md:mx-2">Register</button>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
</nav>

</header>
<div class="flex">
    <aside class="flex flex-col w-64 h-screen px-5 py-8 overflow-y-auto bg-white border-r rtl:border-r-0 rtl:border-l">
        <a href="#">
            <img class="h-10 w-auto object-contain object-center" src="/PHP-Web-main/images/logo2.png" alt="">
        </a>

        <div class="flex flex-col justify-between flex-1 mt-6">
            <nav class="-mx-3 space-y-6 ">
                <div class="space-y-3">
                    <label class="px-3 text-xs text-gray-500 uppercase">home</label>

                    <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700" href="/PHP-Web-main/index.php">
                        <i class="fa-solid fa-house"></i>
                        <span class="mx-2 text-sm font-medium">Home Page</span>
                    </a>

                    <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700" href="/PHP-Web-main/PHP/my_question.php">
                    <i class="fa-solid fa-folder"></i>
                        <span class="mx-2 text-sm font-medium">My Question</span>
                    </a>

                    <!-- Modules Dropdown -->
                    <div>
                        <!-- Fetch Module -->
                        <?php include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/side_bar_help.php'; ?>
                        <!-- Module (Level 1) -->
                        <button type="button" class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700 justify-between w-full" aria-controls="module-dropdown" data-collapse-toggle="module-dropdown">
                            <i class="fa-solid fa-folder"></i>
                            <span class="flex-1 mx-2 text-left whitespace-nowrap text-sm font-medium">Module</span>
                            <svg class="w-3 h-3" aria-hidden="true" fill="none" viewBox="0 0 10 6" xmlns="http://www.w3.org/2000/svg">
                                <path stroke="currentColor" stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="m1 1 4 4 4-4"/>
                            </svg>
                        </button>
                        <!-- Level 2 items -->
                        <ul id="module-dropdown" class="hidden py-2 pl-8 space-y-2">
                            <?php foreach ($modules as $module): ?>
                                <li>
                                    <a href="/PHP-Web-main/index.php?module_id=<?= $module['id']; ?>" class="block p-2 text-gray-900 rounded-lg hover:bg-gray-100">
                                        <?php echo htmlspecialchars($module['module_name']); ?>
                                    </a>
                                </li>
                            <?php endforeach; ?>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </aside>
    <!-- Main Content -->
        <main class="mx-8 flex-grow min-h-screen">
            <?php echo $content; ?>
        </main> 

    
</div>

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


<!-- Sign In -->
<div id="loginModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md relative">
        <!-- Close Button -->
        <button onclick="toggleModal('loginModal')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <!-- Info -->
        <div class="px-6 py-4">
            <div class="flex justify-center mx-auto">
                <img class="w-auto h-7 sm:h-8" src="/PHP-Web-main/images/logo.svg" alt="">
            </div>

            <h3 class="mt-3 text-xl font-medium text-center text-gray-600">Welcome Back</h3>

            <p class="mt-1 text-center text-gray-500">Login or create account</p>

            <form action="PHP/process_login.php" method="POST">
                <div class="w-full mt-4">
                    <input name="username" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="text" placeholder="Username" aria-label="Username" />
                </div>

                <div class="w-full mt-4">
                    <input name="password" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="password" placeholder="Password" aria-label="Password" />
                </div>

                <div class="flex items-center justify-between mt-4">
                    <a href="#" class="text-sm text-gray-600 hover:text-gray-500">Forget Password?</a>
                    <button class="px-6 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        Sign In
                    </button>
                </div>
            </form>
        </div>

        <div class="flex items-center justify-center py-4 text-center bg-gray-50">
            <span class="text-sm text-gray-600">Don't have an account? </span>

            <button onclick="toggleModal('loginModal'), toggleModal('registerModal')" class="mx-2 text-sm font-bold text-blue-500 hover:underline">Register</button>
        </div>
    </div>
</div>

<!-- Register -->
<div id="registerModal" class="fixed inset-0 flex items-center justify-center bg-gray-900 bg-opacity-50 hidden">
    <div class="w-full max-w-sm mx-auto overflow-hidden bg-white rounded-lg shadow-md relative">
        <!-- Close Button -->
        <button onclick="toggleModal('registerModal')" class="absolute top-4 right-4 text-gray-500 hover:text-gray-700 focus:outline-none">
            <svg xmlns="http://www.w3.org/2000/svg" class="w-6 h-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
            </svg>
        </button>
        <!-- Info -->
        <div class="px-6 py-4">
            <div class="flex justify-center mx-auto">
                <img class="w-auto h-7 sm:h-8" src="/PHP-Web-main/images/logo.svg" alt="">
            </div>

            <h3 class="mt-3 text-xl font-medium text-center text-gray-600">Welcome to our system</h3>

            <p class="mt-1 text-center text-gray-500">Login or create account</p>

            <form action="PHP/process_register.php" method="POST">
                <div class="w-full mt-4">
                    <input name="username" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="text" placeholder="Username" aria-label="Username" />
                </div>

                <div class="w-full mt-4">
                    <input name="password" class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="password" placeholder="Password" aria-label="Password" />
                </div>

                <div class="w-full mt-4">
                    <input class="block w-full px-4 py-2 mt-2 text-gray-700 placeholder-gray-500 bg-white border rounded-lg focus:border-blue-400 focus:ring-opacity-40 focus:outline-none focus:ring focus:ring-blue-300" type="password" placeholder="Confirm Password" aria-label="Confirm Password" />
                </div>

                <div class="flex items-center justify-center mt-4">
                    <button class="px-6 py-2 text-sm font-medium tracking-wide text-white capitalize transition-colors duration-300 transform bg-blue-500 rounded-lg hover:bg-blue-400 focus:outline-none focus:ring focus:ring-blue-300 focus:ring-opacity-50">
                        Register
                    </button>
                </div>

            </form>
        </div>

        <div class="flex items-center justify-center py-4 text-center bg-gray-50">
            <span class="text-sm text-gray-600">Have account already? </span>

            <button onclick="toggleModal('loginModal'), toggleModal('registerModal')" class="mx-2 text-sm font-bold text-blue-500 hover:underline">Sign In</button>
        </div>
    </div>
</div>
                    
    <script src="/PHP-Web-main/JS/script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/flowbite@2.5.2/dist/flowbite.min.js"></script>

</body>

</html>
