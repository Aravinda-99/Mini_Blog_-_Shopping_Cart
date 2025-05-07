<?php
// Handle removing a product from the cart
// ... existing code ... 

session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Login/login.php');
    exit();
}

if (isset($_POST['cart_id'])) {
    $cart_id = intval($_POST['cart_id']);
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare('DELETE FROM cart WHERE id = ? AND user_id = ?');
    $stmt->bind_param('ii', $cart_id, $user_id);
    $stmt->execute();
}
header('Location: cart.php');
exit(); 