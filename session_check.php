<?php
session_start();
if (isset($_SESSION["username"])) {
    $loggedIn = true;
    $username = $_SESSION["username"];
} else {
    $loggedIn = false;
    $username = null;
}
?>