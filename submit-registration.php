<?php
// Database connection settings
$servername = "localhost";
$dbusername = "root";
$dbpassword = "";
$dbname = "demo_db";

$conn = new mysqli($servername, $dbusername, $dbpassword, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Create table if not exists
$createTableSQL = "CREATE TABLE IF NOT EXISTS users (
    id INT AUTO_INCREMENT PRIMARY KEY,
    fullname VARCHAR(100) NOT NULL,
    email VARCHAR(100) NOT NULL UNIQUE,
    username VARCHAR(50) NOT NULL UNIQUE,
    password VARCHAR(255) NOT NULL,
    created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
)";
if (!$conn->query($createTableSQL)) {
    die("Error creating table: " . $conn->error);
}

// Get form data
$fullname = $_POST['fullname'];
$email = $_POST['email'];
$username = $_POST['username'];
$password = $_POST['password'];
$confirm_password = $_POST['confirm_password'];

if ($password !== $confirm_password) {
    echo "<script>alert('Passwords do not match.'); window.history.back();</script>";
    exit();
}

$hashed_password = password_hash($password, PASSWORD_DEFAULT);

$sql = "INSERT INTO users (fullname, email, username, password) VALUES (?, ?, ?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ssss", $fullname, $email, $username, $hashed_password);

if ($stmt->execute()) {
    echo "<script>
        alert('Registration Successful!');
        window.location.href = 'Login.html';
    </script>";
} else {
    echo "<script>
        alert('Error: " . addslashes($stmt->error) . "');
        window.history.back();
    </script>";
}

$stmt->close();
$conn->close();
?>
