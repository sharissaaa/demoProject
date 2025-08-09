<?php
session_start();
if (!isset($_SESSION['username'])) {
    header("Location: Login.html");
    exit();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Welcome Page</title>
</head>
<body style="font-family: Arial, sans-serif; background: #f2f2f2; text-align: center; padding-top: 50px;">
    <h1>Welcome, <?php echo htmlspecialchars($_SESSION['username']); ?>!</h1>
    <p>You have successfully registered and logged in.</p>
    <a href="logout.php" style="display:inline-block; padding:10px 20px; background:#d04c51; color:white; text-decoration:none; border-radius:5px;">Logout</a>
</body>
</html>
