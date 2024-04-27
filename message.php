<?php
    include 'session_check.php';
    include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
    <?php include 'inc/head.php'; ?>
    <body class="conversation-page">
        <div class="st-header">
            <?php include 'layout/header.php'; ?>
        </div>
        <div class="conversation-area pt-50">
            <div class="container">
                <div id="data-container"></div>
            </div>
        </div>
        <?php
            include 'inc/user_chat.php';
            include 'inc/footer.php';
        ?>
    </body>
</html>