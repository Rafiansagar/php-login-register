<?php
include 'session_check.php';
include 'db.php';

if (isset($_GET['title'])) {
    $encodedTitle = $_GET['title'];
    $post_title = str_replace('_', ' ', urldecode($encodedTitle));

    $stmt = $conn->prepare("SELECT * FROM blog_posts WHERE title = ?");
    $stmt->bind_param("s", $post_title);

    if ($stmt->execute()) {
        $result = $stmt->get_result();
        if ($result->num_rows > 0) {
            $row = $result->fetch_assoc();
            $title = $row['title'];
            $content = $row['content'];
            $posted_by = $row['author'];
            $post_date = $row['created_at'];
            $datetime = new DateTime($post_date);
            $formattedDate = $datetime->format('d-m-Y');
            $formattedTime = $datetime->format('h:i A');
            ?>
            
            <?php include 'inc/head.php'; ?>
            <body class="single-post">
                <div class="st-header">
                    <?php include 'layout/header.php'; ?>
                </div>
                <div class="main-content">
                    <div class="container">
                        <div class="single-blog">
                            <?php if (!empty($row['image_path'])): ?>
                                <img src="<?php echo $row['image_path']; ?>" alt="Blog Image">
                            <?php endif; ?>
                            <h2><?php echo $title; ?></h2>
                            <p><?php echo $content; ?></p>
                            <p>Posted on <?php echo $formattedDate; ?> at <?php echo $formattedTime; ?></p>

                            <?php if ($loggedIn && isset($_SESSION["role"]) && $_SESSION["role"] === "administrator") { ?>
                                <form method="post" action="">
                                    <input type="hidden" name="post_id" value="<?php echo $row['id']; ?>">
                                    <button type="submit" name="delete_post">Delete This Post</button>
                                </form>
                            <?php } ?>
                        </div>
                    </div>
                </div>
            </body>
            <?php include 'inc/footer.php'; ?>

            <?php
        } else {
            echo '<div class="container">Post not found.</div>';
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}

// Handle post deletion
if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["delete_post"])) {
    if ($loggedIn && isset($_SESSION["role"]) && $_SESSION["role"] === "administrator") {
        $postId = $_POST["post_id"];
        $deletePostQuery = "DELETE FROM blog_posts WHERE id = $postId";

        if ($conn->query($deletePostQuery) === TRUE) {
            echo '<div class="container">';
            echo "<p style='color: green;'>Post deleted successfully.</p>";
            echo '<br><a href="blog.php">Go back to Blog</a>';
            echo '</div>';
        } else {
            echo "Error deleting post: " . $conn->error;
        }
    }
    exit();
}
?>
