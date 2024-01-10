<?php
include 'session_check.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    include 'db.php';

    // Check connection
    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    // Sanitize and retrieve form data
    $inputUsername = filter_var($_POST["username"], FILTER_SANITIZE_STRING);
    $inputPassword = filter_var($_POST["password"], FILTER_SANITIZE_STRING);

    // Prepare and execute a statement to check if the username exists
    $checkUserQuery = "SELECT * FROM admin_users WHERE username = ?";
    $stmt = $conn->prepare($checkUserQuery);
    $stmt->bind_param("s", $inputUsername);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];

        // Verify the password
        if (password_verify($inputPassword, $hashedPassword)) {
            // Authentication successful
            $_SESSION["username"] = $inputUsername;
            $_SESSION["role"] = $row["role"];
            header("Location: main_content.php");
            exit();
        } else {
            header("Location: index.php");
            exit();
        }
    } else {
        header("Location: index.php");
        exit();
    }

    $stmt->close();
    $conn->close();
}
?>