<?php
    include 'session_check.php';
    include 'db.php';

    if ($_SERVER["REQUEST_METHOD"] == "POST") {

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
                                $encodedTitle = urlencode(strtolower(str_replace(' ', '_', $title)));
                                $content = $row['content'];
                                $posted_by = $row['author'];
                                $post_date = $row['created_at'];
                                $datetime = new DateTime($post_date);
                                $formattedDate = $datetime->format('d-m-Y');
                                $formattedTime = $datetime->format('h:i A');
                            ?>
                            <div class="single-blog">
                                <h2><a href="single_post.php?title=<?php echo $encodedTitle; ?>"><?php echo $title; ?></a></h2>
                                <p><?php echo $content; ?></p>
                                <p>Posted on <?php echo $formattedDate; ?> at <?php echo $formattedTime; ?></p>
                                <p>by <?php echo $posted_by; ?></p>
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