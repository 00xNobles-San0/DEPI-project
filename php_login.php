<?php
session_start(); // Start the session

$servername = "localhost";
$username = "root";
$password = "mohamed"; // your MySQL root password
$dbname = "mysite";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];
    $pass = $_POST['password'];

    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        if (password_verify($pass, $row['password'])) {
            // Set session variables
            session_start();
            $_SESSION['username'] = $row['username']; // Store username in session
            $_SESSION['email'] = $row['email']; // Store email in session
            echo "Login successful! Welcome " . htmlspecialchars($row['username']);
            // Redirect to the upload page or another protected area
            header("Location: upload.php"); // Change to upload.php
            exit();
        }
        
        else {
            // Incorrect password
            header("Location: html_login.php?error=true");
            exit();
        }
    } else {
        // No user found
        header("Location: html_login.php?error=true");
        exit();
    }
}

$conn->close();
?>
