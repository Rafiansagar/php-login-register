
<?php
    include 'db.php';
    include 'session_check.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Your post handling logic here
    }
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'inc/head.php'; ?>
    </head>

    <body class="all-blog">
        <?php if ($loggedIn): ?>
            
            <?php include 'layout/header.php'; ?>

            <div class="main-content">
                <div class="st-blog">
                    <?php
                        $result = $conn->query("SELECT * FROM blog_posts");
                        if ($result->num_rows > 0) {
                            while ($row = $result->fetch_assoc()) {
                                $title = $row['title'];
                                $content = $row['content'];
                                $post_meta = $row['created_at'];
                            ?>
                            <div class="single-blog">
                                <h2><a href="single_post.php?id=<?php echo $row['id']; ?>"><?php echo $title; ?></a></h2>
                                <p><?php echo $content; ?></p>
                                <p>Posted on <?php echo $post_meta; ?></p>
                            </div>

                        <?php } } else {
                            echo "No posts yet.";
                        } $conn->close();
                    ?>
                </div>
            </div>

        <?php else: ?>
            <h1>Nothing Found</h1>
            <a href="index.php">Login</a>
        <?php endif; ?>
    </body>
</html>
        