<?php
session_start();
?>
<!DOCTYPE html>
<html>
<head>
    <title>Novel Store - Login</title>
</head>
<body>
    <h1>📚 Novel Store Login</h1>
    <form method="POST" action="login.php">
        <label>Username:</label><br>
        <input type="text" name="username" required><br><br>
        <label>Password:</label><br>
        <input type="password" name="password" required><br><br>
        <button type="submit">Login</button>
    </form>
    <p>Don't have an account? <a href="register.php">Register here</a></p>
</body>
</html>