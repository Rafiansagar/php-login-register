<?php
    include 'session_check.php';
?>

<?php include 'inc/head.php'; ?>
    <body class="main-page">
        <?php if ($loggedIn): ?>

            <div class="st-header">
                <?php include 'layout/header.php'; ?>
            </div>

            <div class="main-content">
                <div class="container">
                    <h1>Enterd Successfully</h1>
                </div>
            </div>

        <?php else: ?>
            <div class="container">
                <h1>Nothing Found</h1>
                <a href="index.php">Login</a>
            </div>
        <?php endif; ?>
    </body>
<?php include 'inc/footer.php'; ?>