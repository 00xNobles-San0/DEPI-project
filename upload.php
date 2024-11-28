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

// Check if the user is logged in
if (!isset($_SESSION['username'])) {
    header("Location: html_login.php");
    exit(); // Prevent further script execution
}

// Set upload directory based on user's email
$email = $_SESSION['email']; // Assume you store the user's email in the session
$uploadDir = __DIR__ . '/uploads/' . $_SESSION['username']; 
// Create the directory if it doesn't exist
if (!file_exists($uploadDir)) {
    if (mkdir($uploadDir, 0777, true)) {
        $checksql = "UPDATE users SET filepath = '$uploadDir' WHERE email = '$email'";
        $conn->query($checksql); // Execute the SQL query
    } else {
        die("Failed to create directory for file uploads.");
    }
}

// Handle file upload
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_FILES['fileToUpload'])) {
    // Sanitize the file name
    $fileName = basename($_FILES['fileToUpload']['name']);
    $fileName = preg_replace("/[^a-zA-Z0-9\.\-_]/", "", $fileName); // Allow only alphanumeric, dot, dash, and underscore
    $targetFile = $uploadDir . '/' . $fileName;
    $uploadOk = 1;
    $imageFileType = strtolower(pathinfo($targetFile, PATHINFO_EXTENSION));

    // Check if image file is an actual image
    $check = getimagesize($_FILES['fileToUpload']['tmp_name']);
    if ($check === false) {
        echo "File is not an image.";
        $uploadOk = 0;
    }

    // Check file size (limit to 1MB)
    if ($_FILES['fileToUpload']['size'] > 9000000) {
        echo "Sorry, your file is too large.";
        $uploadOk = 0;
    }

    // Allow only certain file formats
    if (!in_array($imageFileType, ['jpg', 'jpeg', 'png', 'gif'])) {
        echo "Sorry, only JPG, JPEG, PNG & GIF files are allowed.";
        $uploadOk = 0;
    }

    // Check if $uploadOk is set to 0 by an error
    if ($uploadOk == 0) {
        echo "Sorry, your file was not uploaded.";
    } else {
        // Try to upload the file
        if (move_uploaded_file($_FILES['fileToUpload']['tmp_name'], $targetFile)) {
            echo "The file " . htmlspecialchars($fileName) . " has been uploaded.";
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    }
}

$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Upload Image</title>
</head>
<body>
    <h2>Upload an Image</h2>
    <form action="upload.php" method="post" enctype="multipart/form-data">
        <input type="file" name="fileToUpload" required>
        <button type="submit">Upload Image</button>
    </form>
    <a href="logout.php">Logout</a>
</body>
</html>      