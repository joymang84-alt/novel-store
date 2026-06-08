<?php
session_start();
require_once 'includes/db.php';

if($_SERVER['REQUEST_METHOD'] == 'POST'){
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    $sql = "SELECT * FROM users WHERE username='$username'";
    $result = mysqli_query($conn, $sql);
    $user = mysqli_fetch_assoc($result);
    
    if($user && password_verify($password, $user['password'])){
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];
        header("Location: dashboard.php");
        die();
    } else {
        $error = "Invalid username or password!";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
    <title>Novel Store - Login</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body style="background-image: url('/novel-store/images/background.jpg'); background-size: cover; background-position: center; min-height: 100vh;">

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-4">
                <div class="card shadow">
                    <div class="card-body p-4">
                        <h2 class="text-center mb-4">📚 Novel Store</h2>
                        <?php if(isset($error)): ?>
                            <div class="alert alert-danger"><?php echo $error; ?></div>
                        <?php endif; ?>
                        <form method="POST" action="login.php" onsubmit="return validateForm()">
                            <div class="mb-3">
                                <label class="form-label">Username</label>
                                <input type="text" name="username" id="username" class="form-control">
                            </div>
                            <div class="mb-3">
                                <label class="form-label">Password</label>
                                <input type="password" name="password" id="password" class="form-control">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>
                        <p class="text-center mt-3">Don't have an account? <a href="register.php">Register here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <script>
function validateForm(){
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    
    if(username == ""){
        alert("Please enter your username!");
        return false;
    }
    
    if(password == ""){
        alert("Please enter your password!");
        return false;
    }
    
    if(password.length < 6){
        alert("Password must be at least 6 characters!");
        return false;
    }
    
    return true;
}

</body>
</html><script>
function validateForm(){
    var username = document.getElementById('username').value;
    var password = document.getElementById('password').value;
    
    if(username == ""){
        alert("Please enter your username!");
        return false;
    }
    
    if(password == ""){
        alert("Please enter your password!");
        return false;
    }
    
    if(password.length < 6){
        alert("Password must be at least 6 characters!");
        return false;
    }
    
    return true;
}
</script>