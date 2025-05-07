<?php
// Handle adding a product to the cart
// ... existing code ... 

session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Login/login.php');
    exit();
}

if (isset($_POST['product_id'])) {
    $user_id = $_SESSION['user_id'];
    $product_id = intval($_POST['product_id']);
    // Check if product already in cart
    $check = $conn->prepare('SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?');
    $check->bind_param('ii', $user_id, $product_id);
    $check->execute();
    $result = $check->get_result();
    if ($row = $result->fetch_assoc()) {
        // Update quantity
        $new_qty = $row['quantity'] + 1;
        $update = $conn->prepare('UPDATE cart SET quantity = ? WHERE id = ?');
        $update->bind_param('ii', $new_qty, $row['id']);
        $update->execute();
    } else {
        // Insert new
        $insert = $conn->prepare('INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)');
        $insert->bind_param('ii', $user_id, $product_id);
        $insert->execute();
    }
}
header('Location: ../product/products.php');
exit(); 