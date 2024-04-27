<?php
    function not_administrator_note() {
        echo "Sorry Youre Not a Administrator.";
        echo '<br><a href="main_content.php">Return Home</a>';
    }
    function not_admin_note() {
        echo "Sorry Youre Not a Admin.";
        echo '<br><a href="main_content.php">Return Home</a>';
    }
    function invalid_req_note() {
        echo "Request Invalid";
        echo '<br><a href="index.php">LogIn</a>';
    }
    function access_denied_note() {
        echo "Access denied. Please log in.";
        echo '<br><a href="index.php">LogIn</a>';
    }
?>