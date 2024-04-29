<?php
session_start();

// Check if user is not logged in
if (!isset($_SESSION['session_username'])) {
    // Redirect user to the login page
    header("Location: login.php");
    exit(); // Stop further execution
}
