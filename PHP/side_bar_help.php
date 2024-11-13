<?php
include $_SERVER['DOCUMENT_ROOT'] . '/PHP-Web-Main/PHP/config/db.php';

// Fetch Modules
$stmt = $pdo->query("SELECT * FROM modules");
$modules = $stmt->fetchAll(PDO::FETCH_ASSOC);
