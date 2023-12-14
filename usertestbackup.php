<?php
include 'session_check.php';
include 'db.php';
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <?php include 'inc/head.php'; ?>
    </head>

    <body class="main-page">
        <?php
            if ($loggedIn) {
                if (isset($_SESSION["role"])) {
                    $role = $_SESSION["role"];
                    $username = $_SESSION["username"];

                    echo "Welcome, $username!<br>";
                    echo "Role: $role!<br>";

                    // Fetch additional user details from the database
                    $userInfoQuery = "SELECT * FROM admin_users WHERE username = '$username'";
                    $result = $conn->query($userInfoQuery);

                    if ($result->num_rows > 0) {
                        $userInfo = $result->fetch_assoc();
                        // Print additional user information
                        echo "Email: " . $userInfo['email'];
                        // Add more fields as needed
                    }
                }
            } else {
                echo "Access denied. Please log in.";
            }

            $conn->close();
        ?>
    </body>
</html>
