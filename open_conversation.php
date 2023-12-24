<?php
include 'session_check.php';
include 'db.php';
include 'inc/head.php';

// Check if the user is logged in
if (!$loggedIn) {
    header("Location: login.php"); // Redirect to the login page if not logged in
    exit();
}

// Get the recipient username from the query parameter
if (isset($_GET['recipient'])) {
    $recipientUsername = $_GET['recipient'];

    // Fetch the recipient's messages from the database
    $getRecipientIdQuery = "SELECT id FROM admin_users WHERE username = '$recipientUsername'";
    $recipientResult = $conn->query($getRecipientIdQuery);

    if ($recipientResult->num_rows > 0) {
        $recipientRow = $recipientResult->fetch_assoc();
        $recipientId = $recipientRow['id'];

        // Fetch messages between the logged-in user and the recipient
        $loggedInUserId = $_SESSION["username"];
        $getMessagesQuery = "SELECT * FROM messages WHERE (sender_id = '$loggedInUserId' AND receiver_id = '$recipientUsername') OR (sender_id = '$recipientUsername' AND receiver_id = '$loggedInUserId')";
        $messagesResult = $conn->query($getMessagesQuery);

        if ($messagesResult !== false) {
            // Display existing messages
            if ($messagesResult->num_rows > 0) {
                while ($row = $messagesResult->fetch_assoc()) {
                    echo '<p><strong>' . $row['sender_id'] . ':</strong> ' . $row['message'] . '</p>';
                }
            } else {
                echo '<p>No messages found.</p>';
            }
        } else {
            echo 'MySQL Error: ' . $conn->error;
        }

        // Display a form for sending new messages or replies
        ?>
        <form method="post" action="">
            <input type="hidden" name="recipient_id" value="<?php echo $recipientUsername; ?>">
            <textarea name="message" rows="4" cols="50" required></textarea>
            <br>
            <button type="submit" name="send_message">Send Message</button>
        </form>
        <?php

        // Process the form submission
        if ($_SERVER["REQUEST_METHOD"] === "POST" && isset($_POST["send_message"])) {
            $senderUsername = $_SESSION["username"];
            $recipientUsername = $_POST["recipient_id"];
            $message = $_POST["message"];

            // Add your logic to insert the new message into the database here
            $insertMessageQuery = "INSERT INTO messages (sender_id, receiver_id, message) VALUES ('$senderUsername', '$recipientUsername', '$message')";
            if ($conn->query($insertMessageQuery) === TRUE) {
                // Message inserted successfully

                // Redirect to refresh the page and display the updated messages
                header("Location: ".$_SERVER['PHP_SELF']."?recipient=".$recipientUsername);
                exit();
            } else {
                echo 'Error: ' . $conn->error;
            }
        }

    } else {
        echo '<p>Error: Recipient not found.</p>';
    }
} else {
    echo '<p>Error: Recipient not specified.</p>';
}

include 'inc/footer.php';
?>
