<?php
session_start();
require_once 'includes/db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);
    
    $sql = "INSERT INTO users (username, email, password) VALUES ('$username', '$email', '$password')";
    
    if(mysqli_query($conn, $sql)){
        header("Location: login.php");
        die();
    } else {
        $error = "Registration failed!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Novel Store - Register</title>
</head>
<body>
    <h1>📚 Create Account</h1>
    <?php if(isset($error)) echo "<p style='color:red'>$error</p>"; ?>
    <form method="POST" action="register.php">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Email:</label><br>
        <input type="email" name="email" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Register</button>
    </form>
    <p>Already have an account? <a href="login.php">Login here</a></p>
</body>
</html>