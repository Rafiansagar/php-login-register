<?php
    $allUsersQuery = "SELECT * FROM admin_users";
    $result = $conn->query($allUsersQuery);
    if ($result->num_rows > 0) {?>
        <div class="chat-offcan-wrapper">
            <i class="user-offcan-trigger ri-chat-3-line"></i>
            <ul class="user-chat-list">
                <?php
                while ($row = $result->fetch_assoc()) {
                    echo '<li>';
                    echo '<a href="open_conversation.php?recipient=' . $row['username'] . '">' . $row['username'] . '</a>';
                    echo '</li>';
                }
                ?>
            </ul>
        </div>
    <?php } 
?>