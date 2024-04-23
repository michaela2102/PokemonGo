<?php
// Start the session
session_start();

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

if (isset($_COOKIE['auth_token'])) {
    // Set the expiration time of the cookie to the past
    setcookie('auth_token', '', time() - 3600, '/');
}

// Redirect to the login page or any other appropriate page
header("Location: home.php");
exit();
?>

