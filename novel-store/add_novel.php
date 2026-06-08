<?php
session_start();
require_once 'includes/db.php';

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    die();
}

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    
    $sql = "INSERT INTO novels (title, author, genre, price, stock, description) 
            VALUES ('$title', '$author', '$genre', '$price', '$stock', '$description')";
    
    if(mysqli_query($conn, $sql)){
        header("Location: novels.php");
        die();
    } else {
        $error = "Failed to add novel!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Add Novel</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-dark bg-dark border-bottom border-secondary px-4">
        <span class="navbar-brand">📚 Novel Store</span>
        <a href="novels.php" class="btn btn-outline-light btn-sm">Back to Novels</a>
    </nav>
    <div class="container mt-4">
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card bg-secondary text-white">
                    <div class="card-body p-4">
                        <h3 class="mb-4">Add New Novel</h3>
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="POST" action="add_novel.php">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Author</label>
                                <input type="text" name="author" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <select name="genre" class="form-control" required>
                                    <option value="Romance">Romance</option>
                                    <option value="Horror">Horror</option>
                                    <option value="Mystery">Mystery</option>
                                    <option value="Fantasy">Fantasy</option>
                                    <option value="Animation">Animation</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price (KSh)</label>
                                <input type="number" name="price" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3"></textarea>
                            </div>
                            <button type="submit" class="btn btn-success w-100">Add Novel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>