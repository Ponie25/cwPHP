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

                <div class="space-y-3 ">
                    <label class="px-3 text-xs text-gray-500 uppercase">content</label>

                    <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 14.25v-2.625a3.375 3.375 0 00-3.375-3.375h-1.5A1.125 1.125 0 0113.5 7.125v-1.5a3.375 3.375 0 00-3.375-3.375H8.25m0 12.75h7.5m-7.5 3H12M10.5 2.25H5.625c-.621 0-1.125.504-1.125 1.125v17.25c0 .621.504 1.125 1.125 1.125h12.75c.621 0 1.125-.504 1.125-1.125V11.25a9 9 0 00-9-9z" />
                        </svg>

                        <span class="mx-2 text-sm font-medium">Guides</span>
                    </a>

                    <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M19.5 12c0-1.232-.046-2.453-.138-3.662a4.006 4.006 0 00-3.7-3.7 48.678 48.678 0 00-7.324 0 4.006 4.006 0 00-3.7 3.7c-.017.22-.032.441-.046.662M19.5 12l3-3m-3 3l-3-3m-12 3c0 1.232.046 2.453.138 3.662a4.006 4.006 0 003.7 3.7 48.656 48.656 0 007.324 0 4.006 4.006 0 003.7-3.7c.017-.22.032-.441.046-.662M4.5 12l3 3m-3-3l-3 3" />
                        </svg>

                        <span class="mx-2 text-sm font-medium">Hotspots</span>
                    </a>

                    <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M9 12h3.75M9 15h3.75M9 18h3.75m3 .75H18a2.25 2.25 0 002.25-2.25V6.108c0-1.135-.845-2.098-1.976-2.192a48.424 48.424 0 00-1.123-.08m-5.801 0c-.065.21-.1.433-.1.664 0 .414.336.75.75.75h4.5a.75.75 0 00.75-.75 2.25 2.25 0 00-.1-.664m-5.8 0A2.251 2.251 0 0113.5 2.25H15c1.012 0 1.867.668 2.15 1.586m-5.8 0c-.376.023-.75.05-1.124.08C9.095 4.01 8.25 4.973 8.25 6.108V8.25m0 0H4.875c-.621 0-1.125.504-1.125 1.125v11.25c0 .621.504 1.125 1.125 1.125h9.75c.621 0 1.125-.504 1.125-1.125V9.375c0-.621-.504-1.125-1.125-1.125H8.25zM6.75 12h.008v.008H6.75V12zm0 3h.008v.008H6.75V15zm0 3h.008v.008H6.75V18z" />
                        </svg>

                        <span class="mx-2 text-sm font-medium">Checklists</span>
                    </a>
                </div>

                <div class="space-y-3 ">
                    <label class="px-3 text-xs text-gray-500 uppercase">Customization</label>

                    <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.098 19.902a3.75 3.75 0 005.304 0l6.401-6.402M6.75 21A3.75 3.75 0 013 17.25V4.125C3 3.504 3.504 3 4.125 3h5.25c.621 0 1.125.504 1.125 1.125v4.072M6.75 21a3.75 3.75 0 003.75-3.75V8.197M6.75 21h13.125c.621 0 1.125-.504 1.125-1.125v-5.25c0-.621-.504-1.125-1.125-1.125h-4.072M10.5 8.197l2.88-2.88c.438-.439 1.15-.439 1.59 0l3.712 3.713c.44.44.44 1.152 0 1.59l-2.879 2.88M6.75 17.25h.008v.008H6.75v-.008z" />
                        </svg>

                        <span class="mx-2 text-sm font-medium">Themes</span>
                    </a>

                    <a class="flex items-center px-3 py-2 text-gray-600 transition-colors duration-300 transform rounded-lg hover:bg-gray-100 hover:text-gray-700" href="#">
                        <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor" class="w-5 h-5">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M10.343 3.94c.09-.542.56-.94 1.11-.94h1.093c.55 0 1.02.398 1.11.94l.149.894c.07.424.384.764.78.93.398.164.855.142 1.205-.108l.737-.527a1.125 1.125 0 011.45.12l.773.774c.39.389.44 1.002.12 1.45l-.527.737c-.25.35-.272.806-.107 1.204.165.397.505.71.93.78l.893.15c.543.09.94.56.94 1.109v1.094c0 .55-.397 1.02-.94 1.11l-.893.149c-.425.07-.765.383-.93.78-.165.398-.143.854.107 1.204l.527.738c.32.447.269 1.06-.12 1.45l-.774.773a1.125 1.125 0 01-1.449.12l-.738-.527c-.35-.25-.806-.272-1.203-.107-.397.165-.71.505-.781.929l-.149.894c-.09.542-.56.94-1.11.94h-1.094c-.55 0-1.019-.398-1.11-.94l-.148-.894c-.071-.424-.384-.764-.781-.93-.398-.164-.854-.142-1.204.108l-.738.527c-.447.32-1.06.269-1.45-.12l-.773-.774a1.125 1.125 0 01-.12-1.45l.527-.737c.25-.35.273-.806.108-1.204-.165-.397-.505-.71-.93-.78l-.894-.15c-.542-.09-.94-.56-.94-1.109v-1.094c0-.55.398-1.02.94-1.11l.894-.149c.424-.07.765-.383.93-.78.165-.398.143-.854-.107-1.204l-.527-.738a1.125 1.125 0 01.12-1.45l.773-.773a1.125 1.125 0 011.45-.12l.737.527c.35.25.807.272 1.204.107.397-.165.71-.505.78-.929l.15-.894z" />
                            <path stroke-linecap="round" stroke-linejoin="round" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z" />
                        </svg>

                        <span class="mx-2 text-sm font-medium">Setting</span>
                    </a>
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
