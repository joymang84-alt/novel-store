<?php
session_start();
require_once 'includes/db.php';

if(!isset($_SESSION['username'])){
    header("Location: login.php");
    die();
}

// Add to cart
if(isset($_GET['add'])){
    $id = $_GET['add'];
    $sql = "SELECT * FROM novels WHERE id=$id";
    $result = mysqli_query($conn, $sql);
    $novel = mysqli_fetch_assoc($result);
    
    if($novel){
        if(isset($_SESSION['cart'][$id])){
            $_SESSION['cart'][$id]['quantity']++;
        } else {
            $_SESSION['cart'][$id] = [
                'title' => $novel['title'],
                'price' => $novel['price'],
                'quantity' => 1
            ];
        }
    }
    header("Location: cart.php");
    die();
}

// Remove from cart
if(isset($_GET['remove'])){
    $id = $_GET['remove'];
    unset($_SESSION['cart'][$id]);
    header("Location: cart.php");
    die();
}

// Calculate total
$total = 0;
if(isset($_SESSION['cart'])){
    foreach($_SESSION['cart'] as $item){
        $total += $item['price'] * $item['quantity'];
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Novel Store - Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-dark text-white">
    <nav class="navbar navbar-dark bg-dark border-bottom border-secondary px-4">
        <span class="navbar-brand">📚 Novel Store</span>
        <div>
            <a href="novels.php" class="btn btn-outline-light btn-sm me-2">Browse Novels</a>
            <a href="logout.php" class="btn btn-outline-danger btn-sm">Logout</a>
        </div>
    </nav>

    <div class="container mt-4">
        <h2 class="mb-4">🛒 Your Cart</h2>
        
        <?php if(empty($_SESSION['cart'])): ?>
            <div class="alert alert-info">
                Your cart is empty! <a href="novels.php">Browse novels</a>
            </div>
        <?php else: ?>
            <table class="table table-dark table-bordered">
                <thead>
                    <tr>
                        <th>Title</th>
                        <th>Price</th>
                        <th>Quantity</th>
                        <th>Subtotal</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach($_SESSION['cart'] as $id => $item): ?>
                    <tr>
                        <td><?php echo $item['title']; ?></td>
                        <td>KSh <?php echo $item['price']; ?></td>
                        <td><?php echo $item['quantity']; ?></td>
                        <td>KSh <?php echo $item['price'] * $item['quantity']; ?></td>
                        <td><a href="cart.php?remove=<?php echo $id; ?>" class="btn btn-danger btn-sm">Remove</a></td>
                    </tr>
                    <?php endforeach; ?>
                </tbody>
                <tfoot>
                    <tr>
                        <td colspan="3"><strong>Total</strong></td>
                        <td colspan="2"><strong>KSh <?php echo $total; ?></strong></td>
                    </tr>
                </tfoot>
            </table>
            <a href="checkout.php" class="btn btn-success">Proceed to Checkout</a>
        <?php endif; ?>
    </div>
</body>
</html>