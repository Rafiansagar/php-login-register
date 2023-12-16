<?php
include 'db.php';
    // Creating Necessary Directory
    $uploadsFolder = 'uploads';
    if (!is_dir($uploadsFolder)) {
        mkdir($uploadsFolder, 0777, true);
    }
    $blogFolder = $uploadsFolder . '/blog';
    if (!is_dir($blogFolder)) {
        mkdir($blogFolder, 0777, true);
    }

    // SQL query to create the admin_users table    
    $sqlAdminUsers = "CREATE TABLE IF NOT EXISTS admin_users (
        id INT AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(255) NOT NULL,
        password VARCHAR(255) NOT NULL,
        email VARCHAR(255) NOT NULL,
        role VARCHAR(50) DEFAULT 'user'
    )";

    // SQL query to create the blog_posts table
    $sqlBlogPosts = "CREATE TABLE IF NOT EXISTS blog_posts (
        id INT PRIMARY KEY AUTO_INCREMENT,
        title VARCHAR(255) NOT NULL,
        content TEXT NOT NULL,
        image_path VARCHAR(255),
        author VARCHAR(255) NOT NULL,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    )";

    // Execute all query
    if ($conn->query($sqlAdminUsers) === TRUE) {
        header("Location: signup.php");
    } else {
        echo "Error creating admin_users table: " . $conn->error;
        echo '<a href="index.php">Return</a>';
    }
    if ($conn->query($sqlBlogPosts) === TRUE) {
        header("Location: signup.php");
    } else {
        echo "Error creating blog_posts table: " . $conn->error;
        echo '<a href="index.php">Return</a>';
    }

    $conn->close();
?>