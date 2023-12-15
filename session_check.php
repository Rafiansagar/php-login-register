<?php
session_start();
// Check if the user is logged in
if (isset($_SESSION["username"])) {
    // User is logged in
    $loggedIn = true;
    $username = $_SESSION["username"];
} else {
    // User is not logged in
    $loggedIn = false;
    $username = null;
}
?>