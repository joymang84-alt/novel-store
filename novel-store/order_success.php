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
    <title>Order Success</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-dark bg-dark border-bottom border-secondary px-4">
        <span class="navbar-brand">📚 Novel Store</span>
    </nav>
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <div class="card bg-secondary text-white p-5">
                    <h1>🎉</h1>
                    <h2>Order Placed Successfully!</h2>
                    <p class="mt-3">Thank you for your purchase! Your novels are on their way 📚</p>
                    <a href="novels.php" class="btn btn-primary mt-3">Continue Shopping</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>