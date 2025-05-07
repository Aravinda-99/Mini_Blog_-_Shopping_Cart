<?php
// Handle adding a product to the cart
// ... existing code ... 

session_start();
require_once '../connection.php';

header('Content-Type: application/json');
$response = ['success' => false, 'message' => ''];

// Initialize cart in session if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $product_id = isset($_POST['product_id']) ? intval($_POST['product_id']) : 0;
    
    if ($product_id > 0) {
        if (isset($_SESSION['user_id'])) {
            // Logged in user - store in database
            $user_id = $_SESSION['user_id'];
            $check = $conn->prepare('SELECT id, quantity FROM cart WHERE user_id = ? AND product_id = ?');
            $check->bind_param('ii', $user_id, $product_id);
            $check->execute();
            $result = $check->get_result();
            
            if ($row = $result->fetch_assoc()) {
                // Update quantity
                $new_qty = $row['quantity'] + 1;
                $update = $conn->prepare('UPDATE cart SET quantity = ? WHERE id = ?');
                $update->bind_param('ii', $new_qty, $row['id']);
                if ($update->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'Cart updated successfully!';
                }
            } else {
                // Insert new
                $insert = $conn->prepare('INSERT INTO cart (user_id, product_id, quantity) VALUES (?, ?, 1)');
                $insert->bind_param('ii', $user_id, $product_id);
                if ($insert->execute()) {
                    $response['success'] = true;
                    $response['message'] = 'Added to cart successfully!';
                }
            }
        } else {
            // Guest user - store in session
            if (isset($_SESSION['cart'][$product_id])) {
                $_SESSION['cart'][$product_id]++;
            } else {
                $_SESSION['cart'][$product_id] = 1;
            }
            $response['success'] = true;
            $response['message'] = 'Added to cart successfully!';
        }
    } else {
        $response['message'] = 'Invalid product ID';
    }
} else {
    $response['message'] = 'Invalid request method';
}

echo json_encode($response); 