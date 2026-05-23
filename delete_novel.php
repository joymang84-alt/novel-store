<?php
session_start();
require_once 'includes/db.php';

if(!isset($_SESSION['username']) || $_SESSION['role'] != 'admin'){
    header("Location: login.php");
    die();
}

$id = $_GET['id'];
$sql = "DELETE FROM novels WHERE id=$id";

if(mysqli_query($conn, $sql)){
    header("Location: novels.php");
    die();
} else {
    echo "Failed to delete novel!";
}
?>