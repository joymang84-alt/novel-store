<?php
session_start();
require_once 'includes/db.php';

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    die();
}

// Get stats
$total_novels = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM novels"))['total'];
$total_users = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM users"))['total'];
$total_orders = mysqli_fetch_assoc(mysqli_query($conn, "SELECT COUNT(*) as total FROM orders"))['total'];
?>
<!DOCTYPE html>
<html>
<head>
    <title>Novel Store - Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-dark bg-dark border-bottom border-secondary px-4">
        <span class="navbar-brand">📚 Novel Store</span>
        <div>
            <a href="novels.php" class="btn btn-outline-light btn-sm me-2">Browse Novels</a>
            <a href="cart.php" class="btn btn-outline-warning btn-sm me-2">🛒 Cart</a>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Welcome back, <?php echo $_SESSION['username']; ?>! 👋</h2>
        <p class="text-muted">Here's what's happening in your store today</p>

        <div class="row mt-4">
            <div class="col-md-4 mb-3">
                <div class="card bg-primary text-white text-center p-3">
                    <h1><?php echo $total_novels; ?></h1>
                    <h5>📚 Total Novels</h5>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-success text-white text-center p-3">
                    <h1><?php echo $total_users; ?></h1>
                    <h5>👥 Total Users</h5>
                </div>
            </div>
            <div class="col-md-4 mb-3">
                <div class="card bg-warning text-dark text-center p-3">
                    <h1><?php echo $total_orders; ?></h1>
                    <h5>🛒 Total Orders</h5>
                </div>
            </div>
        </div>

        <div class="row mt-3">
            <div class="col-md-6 mb-3">
                <div class="card bg-secondary text-white p-3">
                    <h5>Quick Actions</h5>
                    <a href="novels.php" class="btn btn-primary w-100 mb-2">Browse Novels</a>
                    <a href="cart.php" class="btn btn-warning w-100 mb-2">View Cart</a>
                    <?php if($_SESSION['role'] == 'admin'): ?>
                        <a href="add_novel.php" class="btn btn-success w-100">+ Add Novel</a>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </div>
</body>
</html>