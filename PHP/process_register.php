<?php
session_start();
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

// Check if the form was submitted
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Get form data
    $username = trim(htmlspecialchars($_POST['username']));
    $password = trim(htmlspecialchars($_POST['password']));

    // Check if username and password are provided
    if (empty($username) || empty($password)) {
        echo 'Please enter both username and password';
        exit;
    }

    // Check if the username already exists
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

    if ($existingUser) {
        echo "Username already exists. Please choose a different username.";
        exit;
    }

    // Hash the password for secure storage
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Insert the new user into the database
    $stmt = $pdo->prepare("INSERT INTO users (username, password) VALUES (:username, :password)");
    $stmt->execute([
        'username' => $username,
        'password' => $hashedPassword
    ]);

    // Fetch the newly created user's ID
    $newUserId = $pdo->lastInsertId();

    // Store user info in session
    $_SESSION['user_id'] = $newUserId;
    $_SESSION['username'] = $username;

    // Redirect to the home page or dashboard
    header("Location: ../index.php");
    exit;
}
?>
