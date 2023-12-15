<?php
include 'db.php';
include 'session_check.php';

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
            $post_meta = $row['created_at'];
            ?>
            <!DOCTYPE html>
            <html lang="en">
                <head>
                    <?php include 'inc/head.php'; ?>
                </head>
                <body class="single-post">
                    <?php include 'layout/header.php'; ?>
                    <div class="main-content">
                        <div class="single-blog">
                            <h2><?php echo $title; ?></h2>
                            <p><?php echo $content; ?></p>
                            <p>Posted on <?php echo $post_meta; ?></p>
                        </div>
                    </div>
                </body>
            </html>
            <?php
        } else {
            echo "Post not found.";
        }
    } else {
        echo "Error: " . $stmt->error;
    }

    $stmt->close();
} else {
    echo "Invalid request.";
}
?>
