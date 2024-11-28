<?php
session_start(); // Start the session

// Check for an existing session and redirect if logged in
if (isset($_SESSION['username'])) {
    header("Location: upload.php");
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="styles.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <?php if (isset($_GET['error'])): ?>
        <div style="color: red;">
            Incorrect email or password! Please try again.
        </div>
        <?php endif; ?>
        <form action="php_login.php" method="post">
            <div class="input-group">
                <label for="email">Email</label>
                <input type="email" name="email" required>
            </div>
            <div class="input-group">
                <label for="password">Password</label>
                <input type="password" name="password" required>
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.html">Sign Up</a></p>
    </div>
</body>
</html>
