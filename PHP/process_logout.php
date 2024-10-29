<?php
session_start(); // Start the session

// Clear all session variables
session_unset();

// Destroy the session
session_destroy();

// Redirect to the main page (index.php)
header("Location: ../index.php");
exit;
