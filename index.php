<?php
include 'session_check.php';
include 'db.php';

$notificationMsg = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

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

    // Verify the password
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $hashedPassword = $row["password"];
        
        // Authentication successful
        if (password_verify($inputPassword, $hashedPassword)) {
            $_SESSION["username"] = $inputUsername;
            $_SESSION["role"] = $row["role"];
            header("Location: main_content.php");
            exit();
        } else {
            $notificationMsg = "Incorrect password";
        }
    } else {
        $notificationMsg = "Incorrect Username";
    }
    
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
    <?php include 'inc/head.php'; ?>
    <body class="login-page">
        <?php if (!empty($notificationMsg)): ?>
            <div class="notification error"><?php echo $notificationMsg; ?></div>
        <?php endif; ?>
        <div class="container">
            <div class="form-wrapper">
                <h2>Login Form</h2>
                <form action="" method="post">
                    <input type="text" name="username" placeholder="Enter Your Username" autocomplete="off" required>
                    <input type="password" name="password" placeholder="Enter Your Password" autocomplete="off" required>
                    <button type="submit" value="Login">Login</button>
                </form>
                <div class="inner-btn">
                    <a href="signup.php">Or Create Account</a>
                </div>
            </div>
        </div>
        <?php include 'inc/footer.php'; ?>
    </body>
</html>
