<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

// Check if the user is logged in
if (!isset($_SESSION['user_id'])) {
    // Redirect to login page if not logged in
    header("Location: PHP/login.php");
    exit;
}

// Retrieve the user’s questions
$userId = $_SESSION['user_id'];
$stmt = $pdo->prepare("SELECT title, content, created_at FROM posts WHERE user_id = :user_id ORDER BY created_at DESC");
$stmt->execute(['user_id' => $userId]);
$questions = $stmt->fetchAll(PDO::FETCH_ASSOC);

$title = 'My Questions';
?>

<!DOCTYPE html>
<html>
<head>
    <title><?php echo $title; ?></title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body>
    <header class="p-4 bg-white text-black">
        <h1 class="text-2xl font-bold">My Questions</h1>
    </header>

    <main class="p-4">
        <?php if (!empty($questions)): ?>
            <?php foreach ($questions as $question): ?>
                <div class="bg-white shadow-lg rounded-lg p-4 mb-4">
                    <h2 class="text-xl font-bold"><?php echo htmlspecialchars($question['title']); ?></h2>
                    <p><?php echo htmlspecialchars($question['content']); ?></p>
                    <p class="text-gray-500 text-sm">Posted on <?php echo $question['created_at']; ?></p>
                </div>
            <?php endforeach; ?>
        <?php else: ?>
            <p>You haven't posted any questions yet.</p>
        <?php endif; ?>
    </main>
</body>
</html>
