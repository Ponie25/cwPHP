<?php
    session_start();
    include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-main/PHP/config/db.php';

    // Get uswername and password 
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $username = trim(htmlspecialchars($_POST['username']));
        $password = trim(htmlspecialchars($_POST['password']));
    }

        if (empty($username) || empty($password)) {
            echo 'Please enter username and password';
            exit;
        }
    
    // SQL statement  
    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = :username");
    $stmt->execute(['username' => $username]);
    $user = $stmt->fetch(PDO::FETCH_ASSOC);

    // Check if the user exists and verify the password
    if ($user && password_verify($password, $user['password'])) {
    // Password is correct, create a session for the user
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];

    // Redirect to the home page or dashboard
        header("Location: ../index.php");
        exit;
    } else {
        // Invalid login credentials
        echo "Invalid username or password.";
    }
$host = 'localhost';
