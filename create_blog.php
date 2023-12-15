
<!--  SQL Command for create blog post table
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-->

<?php
    include 'db.php';
    include 'session_check.php';

    if ($_SERVER['REQUEST_METHOD'] === 'POST') {
        $title = $_POST['title'];
        $content = $_POST['content'];

        // Use prepared statement
        $sql = "INSERT INTO blog_posts (title, content) VALUES (?, ?)";
        $stmt = $conn->prepare($sql);

        // Bind parameters
        $stmt->bind_param("ss", $title, $content);

        // Execute the statement
        if ($stmt->execute()) {
            header("Location: blog.php");
            exit();
        } else {
            echo "Error: " . $stmt->error;
        }

        // Close the statement
        $stmt->close();
    }
?>

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
                <form method="post" action="">
                    <label for="title">Title:</label>
                    <input type="text" name="title" required><br>

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
