<?php
include 'session_check.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    // Image upload handling
    $image_dir = 'uploads/'; // Specify the directory where you want to store the images
    $image_name = basename($_FILES['image']['name']);
    $image_path = $image_dir . $image_name;

    if (move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
        // Use prepared statement
        $sql = "INSERT INTO blog_posts (title, content, image_path) VALUES (?, ?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("sss", $title, $content, $image_path);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: blog.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    } else {
        echo "Error uploading the image.";
    }
}
?>
<!--  SQL Command for create blog post table
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_path VARCHAR(255),
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-->

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'inc/head.php'; ?>
    </head>
    <body class="loggedIn">
        <?php if ($loggedIn): ?>
            <?php
                include 'layout/header.php';
            ?>
            <div class="main-content">
                <h2>Create a Blog Post</h2>
                <form method="post" action="" enctype="multipart/form-data">
                    <label for="title">Title:</label>
                    <input type="text" name="title" required><br>

                    <label for="image">Upload Image:</label>
                    <input type="file" name="image"><br>

                    <label for="content">Content:</label>
                    <textarea name="content" required></textarea><br>

                    <input type="submit" value="Create Post">
                </form>
            </div>

        <?php else: ?>
            <h1>Nothing Found</h1>
            <a href="index.php">Login</a>
        <?php endif; ?>

    </body>
</html>