<?php
include 'session_check.php';
include 'db.php';
include 'inc/head.php';
?>



<body class="users-page">
    <?php if ($loggedIn) { ?>
        <div class="st-header">
            <?php include 'layout/header.php'; ?>
        </div>
    <?php } ?>
    <div class="users-content">
        <div class="container">
            <?php
                $allUsersQuery = "SELECT * FROM admin_users";
                $result = $conn->query($allUsersQuery);
                if ($result->num_rows > 0) {?>
                    <ul class="user-list">
                        <?php
                        while ($row = $result->fetch_assoc()) {
                            echo '<li>';
                            echo '<a href="open_conversation.php?recipient=' . $row['username'] . '">' . $row['username'] . '</a>';
                            echo '</li>';
                        }
                        ?>
                    </ul>
                <?php } 
            ?>
        </div>
    </div>
</body>
<?php include 'inc/footer.php'; ?>
