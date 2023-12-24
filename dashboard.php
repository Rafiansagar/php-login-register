<?php
include 'session_check.php';
include 'db.php';

// Check if the form is submitted for updating the user role or deleting the user
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    if ($loggedIn && isset($_SESSION["role"]) && $_SESSION["role"] === "administrator") {

        // Update user role
        if (isset($_POST["update_role"])) {
            $userId = $_POST["user_id"];
            $newRole = $_POST["new_role"];
            $updateRoleQuery = "UPDATE admin_users SET role = '$newRole' WHERE id = $userId";

            if ($conn->query($updateRoleQuery) === TRUE) {
                echo '<div class="container">';
                echo "<p style='color: green;'>User role updated successfully.</p>";
                echo '<br><a href="dashboard.php">Go back to page</a>';
                echo '</div>';
            }
        }

        // Delete user
        if (isset($_POST["delete_user"])) {
            $userId = $_POST["user_id"];
            $userRoleQuery = "SELECT role FROM admin_users WHERE id = $userId";
            $result = $conn->query($userRoleQuery);

            if ($result->num_rows > 0) {
                $userRole = $result->fetch_assoc()['role'];

                if ($userRole !== 'administrator') {
                    $deleteUserQuery = "DELETE FROM admin_users WHERE id = $userId";
                    if ($conn->query($deleteUserQuery) === TRUE) {
                        echo '<div class="container">';
                        echo "<p style='color: green;'>User deleted successfully.</p>";
                        echo '<br><a href="dashboard.php">Go back to page</a>';
                        echo '</div>';
                    }
                } else {
                    echo '<div class="container">';
                    echo "<p style='color: red;'>Administrators cannot be deleted.</p>";
                    echo '<br><a href="dashboard.php">Go back to page</a>';
                    echo '</div>';
                }
            }
        }
    }
    exit();
}
?>

<?php include 'inc/head.php'; ?>
<body class="dashboard-page">
    <?php if ($loggedIn) { ?>
        <div class="st-header">
            <?php include 'layout/header.php'; ?>
        </div>
    <?php }?>
    <div class="dashbord-content">
        <div class="container">
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

                    if ($role === "administrator") {?>
                        <div class="users_role_control"  style="margin-top: 50px;">
                            <h2>Update User Role</h2>
                            <form method='post' action=''>
                                <span>User List:</span>
                                <select name='user_id'>
                                    <?php 
                                        $userListQuery = "SELECT id, role, username FROM admin_users";
                                        $result = $conn->query($userListQuery);
                                        while ($row = $result->fetch_assoc()) {
                                            $view_user_id_list = $row['id'];
                                            $view_user_list = $row['username'];
                                            $view_role_list = $row['role'];
                                            ?>
                                            <option value=<?php echo $view_user_id_list ?>> <?php echo $view_user_list; echo " - ($view_role_list)"; ?> </option>
                                        <?php }
                                    ?>
                                </select>
                                <br>
                                <br>
                                <span>New Role:</span>
                                <select name='new_role'>
                                    <option value='user'>User</option>
                                    <option value='admin'>Admin</option>
                                    <option value='administrator'>Administrator</option>
                                </select>

                                <button type='submit' name='update_role' value='Update Role'>Update Role</button>
                            </form>
                            
                            <div class="delete-user-area" style="background: #ffa2a2; padding: 30px; margin-top: 50px;">
                                <h2>Delete User</h2>
                                <form method='post' action=''>
                                    <span>User List:</span>
                                    <select name='user_id'>
                                        <?php 
                                            // Display the user list again for deletion
                                            $result = $conn->query($userListQuery);
                                            while ($row = $result->fetch_assoc()) {
                                                $view_user_id_list = $row['id'];
                                                $view_user_list = $row['username'];
                                                $view_role_list = $row['role'];
                                                ?>
                                                <option value=<?php echo $view_user_id_list ?>> <?php echo $view_user_list; echo " - ($view_role_list)"; ?> </option>
                                            <?php }
                                        ?>
                                    </select>

                                    <button type='submit' name='delete_user' value='Delete User'>Delete User</button>
                                </form>
                            </div>
                        </div>
                    <?php }
                }
                echo '<br><a href="logout.php">Logout</a>';
                echo '<br><a href="main_content.php">Main Content</a>';
            } else {
                echo "Access denied. Please log in.";
                echo '<br><a href="index.php">LogIn</a>';
            }
            ?>
        </div>
    </div>
</body>
<?php
include 'inc/user_chat.php';
include 'inc/footer.php';
?>
