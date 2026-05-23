<?php
session_start();
if(!isset($_SESSION['username'])){
    header("Location: login.php");
    die();
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Novel Store - Dashboard</title>
</head>
<body>
    <h1>Welcome, <?php echo $_SESSION['username']; ?>! 📚</h1>
    <p>You are now logged in to Novel Store.</p>
    <a href="novels.php">Browse Novels</a> | 
    <a href="logout.php">Logout</a>
</body>
</html>