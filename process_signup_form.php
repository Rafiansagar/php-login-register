<?php
include 'db.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $inputUsername = $_POST["username"];
    $inputEmail = $_POST["email"];
    $inputPassword = $_POST["password"];

    // Additional validation and sanitization can be added here

    // Check if the username or email already exists
    $checkUserQuery = "SELECT * FROM admin_users WHERE username = '$inputUsername' OR email = '$inputEmail'";
    $result = $conn->query($checkUserQuery);

    if ($result->num_rows > 0) {
        // Redirect or handle existing username or email
        header("Location: main_content.php");
        exit();
    } else {
        // Hash the password for security
        $hashedPassword = password_hash($inputPassword, PASSWORD_DEFAULT);

        // Insert user data into the database with the 'user' role
        $insertQuery = "INSERT INTO admin_users (username, password, email, role) VALUES ('$inputUsername', '$hashedPassword', '$inputEmail', 'user')";

        if ($conn->query($insertQuery) === TRUE) {
            // Redirect to main_content.php or display success message
            header("Location: index.php");
            exit();
        } else {
            echo "Error: " . $insertQuery . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>

<!--  SQL Command for create signup form table
CREATE TABLE admin_users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    username VARCHAR(255) NOT NULL,
    password VARCHAR(255) NOT NULL,
    email VARCHAR(255) NOT NULL
    role VARCHAR(50) DEFAULT 'user'
);
-->