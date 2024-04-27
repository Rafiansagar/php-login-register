<?php
include 'session_check.php';
include 'db.php';


// Fetch data from the database
$sql = "SELECT * FROM messages";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    // Output data of each row
    while($row = $result->fetch_assoc()) {?>
        ID: <?php echo $row["id"] ?> <br>
        Sender: <?php echo $row["sender_id"] ?> <br>
        Receiver: <?php echo $row["receiver_id"] ?> <br>
        Message: <?php echo $row["message"] ?> <br>
        Timestamp: <?php echo $row["timestamp"] ?><br><br>
    <?php }
} else {
    echo "0 results";
}

$conn->close();