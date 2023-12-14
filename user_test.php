<?php
include 'session_check.php';
include 'db.php';

// Check if the form is submitted for updating the user role
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($loggedIn && isset($_SESSION["role"]) && $_SESSION["role"] === "admin") {
        // Retrieve form data
        $userId = $_POST["user_id"];
        $newRole = $_POST["new_role"];

        // Update the user role in the database
        $updateRoleQuery = "UPDATE admin_users SET role = '$newRole' WHERE id = $userId";

        if ($conn->query($updateRoleQuery) === TRUE) {
            echo "User role updated successfully.";
            echo '<br><a href="main_content.php">Main Content</a>';
        } else {
            echo "Error updating user role: " . $conn->error;
        }
    } else {
        echo "Access denied. Please log in as an admin.";
    }
    exit(); // Stop further execution to prevent displaying HTML content
}
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

            // Display a form to update the user role (only visible to admin)
            if ($role === "admin") {
                echo "<h2>Update User Role</h2>";
                echo "<form method='post' action=''>";

                // Add a dropdown menu to select the user to update
                echo "Select User: <select name='user_id'>";
                $userListQuery = "SELECT id, username FROM admin_users";
                $result = $conn->query($userListQuery);
                while ($row = $result->fetch_assoc()) {
                    echo "<option value='" . $row['id'] . "'>" . $row['username'] . "</option>";
                }
                echo "</select><br>";

                // Add a dropdown menu to select the new role
                echo "New Role: <select name='new_role'>";
                echo "<option value='admin'>Admin</option>";
                echo "<option value='user'>User</option>";
                echo "</select><br>";

                echo "<input type='submit' value='Update Role'>";
                echo "</form>";
            }
        }
        echo '<br><a href="logout.php">Logout</a>';
        echo '<br><a href="main_content.php">Main Content</a>';
    } else {
        echo "Access denied. Please log in.";
    }

    $conn->close();
    ?>
</body>
</html>
