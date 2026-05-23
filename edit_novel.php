<?php
session_start();
require_once 'includes/db.php';

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    die();
}

$id = $_GET['id'];
$sql = "SELECT * FROM novels WHERE id=$id";
$result = mysqli_query($conn, $sql);
$novel = mysqli_fetch_assoc($result);

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $title = $_POST['title'];
    $author = $_POST['author'];
    $genre = $_POST['genre'];
    $price = $_POST['price'];
    $stock = $_POST['stock'];
    $description = $_POST['description'];
    
    $sql = "UPDATE novels SET title='$title', author='$author', genre='$genre', 
            price='$price', stock='$stock', description='$description' WHERE id=$id";
    
    if(mysqli_query($conn, $sql)){
        header("Location: novels.php");
        die();
    } else {
        $error = "Failed to update novel!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Edit Novel</title>
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
                        <h3 class="mb-4">Edit Novel</h3>
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="POST">
                            <div class="mb-3">
                                <label class="form-label">Title</label>
                                <input type="text" name="title" class="form-control" value="<?php echo $novel['title']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Author</label>
                                <input type="text" name="author" class="form-control" value="<?php echo $novel['author']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Genre</label>
                                <select name="genre" class="form-control" required>
                                    <option value="Romance" <?php if($novel['genre']=='Romance') echo 'selected'; ?>>Romance</option>
                                    <option value="Horror" <?php if($novel['genre']=='Horror') echo 'selected'; ?>>Horror</option>
                                    <option value="Mystery" <?php if($novel['genre']=='Mystery') echo 'selected'; ?>>Mystery</option>
                                    <option value="Fantasy" <?php if($novel['genre']=='Fantasy') echo 'selected'; ?>>Fantasy</option>
                                    <option value="Animation" <?php if($novel['genre']=='Animation') echo 'selected'; ?>>Animation</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Price (KSh)</label>
                                <input type="number" name="price" class="form-control" value="<?php echo $novel['price']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Stock</label>
                                <input type="number" name="stock" class="form-control" value="<?php echo $novel['stock']; ?>" required>
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Description</label>
                                <textarea name="description" class="form-control" rows="3"><?php echo $novel['description']; ?></textarea>
                            </div>
                            <button type="submit" class="btn btn-warning w-100">Update Novel</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>