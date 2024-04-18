<?php
include 'session_check.php';
include 'db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = $_POST['title'];
    $content = $_POST['content'];

    if (!empty($_FILES['image']['name'])) {
        $image_dir = 'uploads/blog/';
        $image_name = basename($_FILES['image']['name']);

        $image_name_parts = pathinfo($image_name);
        $image_extension = isset($image_name_parts['extension']) ? '.' . $image_name_parts['extension'] : '';
        $image_name = uniqid() . '_' . $image_name;

        $image_path = $image_dir . $image_name;

        if (!move_uploaded_file($_FILES['image']['tmp_name'], $image_path)) {
            echo "Error uploading the image.";
            echo '<a href="main_content.php">Return Home</a>';
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

<!DOCTYPE html>
<html lang="en">
    <?php include 'inc/head.php'; ?>
    <body class="create-blog-page">
        <?php if ($loggedIn) {?>
            <div class="st-header">
                <?php include 'layout/header.php'; ?>
            </div>
        <?php } ?>
        <div class="main-content">
            <div class="container">
                <div class="creeate-blog-form-wrapper">
                    <?php
                        if ($loggedIn) {?>
                            <?php $role = $_SESSION["role"];
                            if ($role === "administrator" || $role === "admin" ) { ?>
                                
                                    <h2>Create a Blog Post</h2>
                                    <form method="post" action="" enctype="multipart/form-data">
                                        <label for="title">Blog Title <span>*</span></label>
                                        <input type="text" name="title" required>

                                        <label for="content">Blog Content <span>*</span></label>
                                        <textarea name="content" required></textarea>

                                        <label for="image">Upload Blog Image:</label>
                                        <input type="file" name="image">

                                        <div class="submit-button">
                                            <button type="submit">Create Post</button>
                                        </div>
                                    </form>
                                
                            <?php } else {
                                echo "Sorry Youre Not a Admin.";
                                echo '<br><a href="main_content.php">Return Home</a>';
                            }
                        } else {
                            echo "Request Invalid";
                            echo '<br><a href="index.php">LogIn</a>';
                        }
                    ?>
                </div>
            </div>
        </div>
    <?php include 'inc/footer.php'; ?>
</body>
</html>

