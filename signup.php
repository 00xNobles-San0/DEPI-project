<?php
$servername = "localhost";
$username = "root";
$password = "mohamed"; // your MySQL root password
$dbname = "mysite";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $user = $_POST['username'];  
    $email = $_POST['email'];    
    $pass = password_hash($_POST['password'], PASSWORD_DEFAULT); 

    $sql = "INSERT INTO users (username, email, password) VALUES ('$user', '$email', '$pass')"; 
    if ($conn->query($sql) === TRUE) {
        echo "Sign up successful. You can now <a href='html_login.php'>login</a>.";
    } else {
        echo "Error inserting into users(username,email,password) values('$user','$email','$pass') " . $conn->error;
    }
}

$conn->close();
?>
