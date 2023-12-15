<?php include 'inc/head.php'; ?>
    <body class="signup-page">
        <div class="form-wrapper">
            <h2>SignUp Form</h2>
            <form action="process_signup_form.php" method="post">

                <input type="text" name="username" placeholder="Enter Your Username" autocomplete="off" required>
                <input type="email" name="email" placeholder="Enter Your E-Mail" autocomplete="off" required>
                <input type="password" name="password" placeholder="Enter Your Password" autocomplete="off" required>

                <button type="submit" value="Create User">Create User</button>
            </form>
            <div class="inner-btn">
                <a href="index.php">Goto Login Page</a>
            </div>
        </div>
    </body>
<?php include 'inc/footer.php'; ?>