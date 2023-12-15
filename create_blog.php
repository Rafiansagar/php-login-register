<?php
include 'session_check.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (!empty($_FILES['image']['name'])) {
        $image_dir = 'uploads/';
        $image_name = basename($_FILES['image']['name']);
        $image_path = $image_dir . $image_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            echo "Error uploading the image.";
            exit();
        }
    } else {
        $image_path = '';
    }

    $userName = $_SESSION['username'];

    $sql = "INSERT INTO blog_posts (title, content, image_path, author) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    
    $stmt->bind_param("ssss", $title, $content, $image_path, $userName);

    // Execute the statement
    if ($stmt->execute()) {
        header("Location: blog.php");
        exit();
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
}
?>

<!--
CREATE TABLE IF NOT EXISTS blog_posts (
    id INT PRIMARY KEY AUTO_INCREMENT,
    title VARCHAR(255) NOT NULL,
    content TEXT NOT NULL,
    image_path VARCHAR(255),
    author VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);
-->


<?php include 'inc/head.php'; ?>
    <body class="create-blog-page">
        <?php
            if ($loggedIn) {?>
                <div class="st-header">
                    <?php include 'layout/header.php'; ?>
                </div>
                <?php $role = $_SESSION["role"];
                if ($role === "administrator" || $role === "admin" ) { ?>
                    <div class="main-content">
                        <div class="container">
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
                    </div>
                <?php } else {
                    echo '<div class="container">';
                    echo "Sorry Youre Not a Admin.";
                    echo '<br><a href="main_content.php">Return Home</a>';
                    echo '</div>';
                }
            } else {
                echo "Request Invalid";
                echo '<br><a href="index.php">LogIn</a>';
            }
        ?>
    </body>
<?php include 'inc/footer.php'; ?>
