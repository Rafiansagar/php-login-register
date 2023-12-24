<?php
    include 'session_check.php';
    include 'db.php';
// asc or desc
    $sortOrder = isset($_GET['sort']) ? $_GET['sort'] : 'desc'; // Default to descending order

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Handle any POST requests if needed
    }
?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'inc/head.php'; ?>
    <body class="blog-page">
        <div class="st-header">
            <?php include 'layout/header.php'; ?>
        </div>
        <div class="main-content">
            <div class="st-blog">
                <div class="container">
                    <?php
                        $result = $conn->query("SELECT * FROM blog_posts ORDER BY created_at $sortOrder");
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
                                <h3 class="blog_title"><a href="single_post.php?title=<?php echo $encodedTitle; ?>"><?php echo $title; ?></a></h3>
                                <p class="blog_desc"><?php echo $content; ?></p>
                                <div class="post_meta">Posted on <?php echo $formattedDate; ?> at <?php echo $formattedTime; ?></div>
                                <div class="author">by <span><?php echo $posted_by; ?></span></div>
                            </div>
                        <?php } } else {
                            echo "No posts yet.";
                        }
                    ?>
                </div>
            </div>
        </div>
    <?php
        include 'inc/user_chat.php';
        include 'inc/footer.php';
    ?>
</body>
</html>
