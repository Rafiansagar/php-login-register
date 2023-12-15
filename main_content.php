<?php
    include 'session_check.php';
?>

<?php include 'inc/head.php'; ?>
    <body class="main-page">
        <?php if ($loggedIn): ?>

            <?php include 'layout/header.php'; ?>

            <div class="main-content">
                <h1>Enterd Successfully</h1>
            </div>

        <?php else: ?>
            <h1>Nothing Found</h1>
            <a href="index.php">Login</a>
        <?php endif; ?>

    </body>
<?php include 'inc/footer.php'; ?>