<?php
include 'session_check.php';
include 'db.php';
include 'note.php';

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
$username = $_SESSION["username"];
?>

<!DOCTYPE html>
<html lang="en">
<?php include 'inc/head.php'; ?>
<body class="dashboard-page">
    <?php if ($loggedIn) { ?>
        <div class="dashbord-content">
            <div class="row">
                <div class="dash_sidebar col-md-2">
                    <ul class="nav nav-tabs flex-column" role="tablist">
                        <li class="nav-item" role="presentation">
                            <button class="nav-link active" data-bs-toggle="tab" data-bs-target="#dashboard">
                                <i class="ri-home-2-line"></i>
                                Dashboard
                            </button>
                        </li>
                        <li class="nav-item" role="presentation">
                            <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#profile">dfgdfg</button>
                        </li>
                    </ul>
                </div>
                <div class="dash_content col-md-10">
                    <div class="tab-content">
                        <!-- Dashboard Content Start -->
                        <div class="tab-pane fade show active" id="dashboard">
                            <div class="welcome-note">
                                <h2 class="welcome">Welcome</h2>
                                <div class="name"><i class="ri-user-line"></i><?php echo $username; ?></div>
                            </div>
                        </div>
                        <!-- Dashboard Content End -->

                        <!-- Intro Content Start -->
                        <div class="tab-pane fade" id="profile">
                            <?php if (isset($_SESSION["role"])) {
                                $role = $_SESSION["role"];
                                echo "Name: $username<br>";
                                echo "Role: $role!<br>";
                                
                                $userInfoQuery = "SELECT * FROM admin_users WHERE username = '$username'";
                                $result = $conn->query($userInfoQuery);

                                if ($result->num_rows > 0) {
                                    $userInfo = $result->fetch_assoc();
                                    echo "Email: " . $userInfo['email'];
                                }
                            } ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
                
        <?php } else { ?>
            <div class="container">
                <?php access_denied_note(); ?>
            </div>
        <?php }
        include 'inc/footer.php';
    ?>

</body>
</html>