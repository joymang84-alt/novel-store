<?php
session_start();
require_once 'includes/db.php';

$sql = "SELECT * FROM novels";
$result = mysqli_query($conn, $sql);
?>
<!DOCTYPE html>
<html>
<head>
    <title>Novel Store - Browse Novels</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-dark bg-dark border-bottom border-secondary px-4">
        <span class="navbar-brand">📚 Novel Store</span>
        <div>
            <?php if(isset($_SESSION['username'])): ?>
                <span class="me-3">Welcome, <?php echo $_SESSION['username']; ?>!</span>
                <?php if($_SESSION['role'] == 'admin'): ?>
                    <a href="add_novel.php" class="btn btn-success btn-sm me-2">+ Add Novel</a>
                <?php endif; ?>
                <a href="logout.php" class="btn btn-outline-light btn-sm">Logout</a>
            <?php else: ?>
                <a href="login.php" class="btn btn-primary btn-sm">Login</a>
            <?php endif; ?>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">Browse Novels</h2>
        <div class="row">
            <?php while($novel = mysqli_fetch_assoc($result)): ?>
            <div class="col-md-3 mb-4">
                <div class="card bg-secondary text-white h-100">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo $novel['title']; ?></h5>
                        <p class="card-text">By <?php echo $novel['author']; ?></p>
                        <p class="card-text">Genre: <?php echo $novel['genre']; ?></p>
                        <h6 class="text-warning">KSh <?php echo $novel['price']; ?></h6>
                        <?php if(isset($_SESSION['role']) && $_SESSION['role'] == 'admin'): ?>
                            <a href="edit_novel.php?id=<?php echo $novel['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                            <a href="delete_novel.php?id=<?php echo $novel['id']; ?>" class="btn btn-danger btn-sm">Delete</a>
                        <?php endif; ?>
                    </div>
                </div>
            </div>
            <?php endwhile; ?>
        </div>
    </div>
</body>
</html>