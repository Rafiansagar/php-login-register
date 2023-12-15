<?php
    include 'session_check.php';
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <?php include 'inc/head.php'; ?>
</head>

<body class="main-page">
    <?php if ($loggedIn): ?>

        <?php include 'layout/header.php'; ?>

        <div class="main-content">
            <h1>Enterd Successfully</h1>
            <div><a href="logout.php">Logout</a></div>
            <div><a href="create_blog.php">Make post</a></div>
        </div>

    <?php else: ?>
        <h1>Nothing Found</h1>
        <a href="index.php">Login</a>
    <?php endif; ?>

</body>
</html>