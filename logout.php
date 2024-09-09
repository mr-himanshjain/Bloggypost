<?php
session_start();

// Unset all session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// if (!isset($_SESSION['admin'])) {
//     // Redirect to the index page
//     header("Location: index.php");
//     exit();
// }
// On the restricted page
if (!isset($_SESSION['username'])) {
    // Redirect to the login page
    header("Location: index.php");
    exit();
}
?>