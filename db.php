<?php
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "php_test";

    // Server DB
    // $servername = "localhost";
    // $username = "id21674725_root";
    // $password = "7*******#";
    // $dbname = "id21674725_php_test";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }
?>