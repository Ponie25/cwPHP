<?php
$host = 'localhost';
$db = 'student_social_media';
$user = 'root'; // XAMPP default
$pass = ''; // 

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    // echo "Success";
} catch (PDOException $e) {
    echo "Connection failed: " . $e->getMessage();
}
?>
