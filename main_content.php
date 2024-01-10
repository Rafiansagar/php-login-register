<?php
    include 'session_check.php';
    include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'inc/head.php'; ?>
    <body class="main-page">
        <?php if ($loggedIn): ?>

            <div class="st-header">
                <?php include 'layout/header.php'; ?>
            </div>

            <div class="main-content">
                <div class="intro-content">
                    <div class="container">
                        <h1>Enterd Successfully</h1>
                        <div style="margin-top: 50px;">
                            <h2>Want to test this site?</h2>
                            As (Administrator)<br>
                            User: administrator123<br>
                            Pass: administrator123
                            <br>
                            <br>
                            As (admin)<br>
                            User: test-admin123<br>
                            Pass: test-admin123
                            <br>
                            <br>
                            As (visitor or user)<br>
                            User: user123<br>
                            Pass: user123

                        </div>
                    </div>
                </div>
            </div>

        <?php else: ?>
            <div class="container">
                <h1>Nothing Found</h1>
                <a href="index.php">Login</a>
            </div>
        <?php endif; ?>
        <?php
            if ($loggedIn) {
                include 'inc/user_chat.php';
            }
            include 'inc/footer.php'; 
        ?>
    </body>
</html>