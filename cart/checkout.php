<?php

require_once '../connection.php';
include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Login/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$message = '';

// Process order submission
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['place_order'])) {
    // Start transaction
    $conn->begin_transaction();
    try {
        // Create order
        $stmt = $conn->prepare('INSERT INTO orders (user_id, total_amount, status) VALUES (?, ?, "pending")');
        $total = 0;
        $stmt->bind_param('id', $user_id, $total);
        $stmt->execute();
        $order_id = $conn->insert_id;

        // Get cart items
        $cart_items = $conn->prepare('SELECT cart.*, products.price, products.name FROM cart 
                                    JOIN products ON cart.product_id = products.id 
                                    WHERE cart.user_id = ?');
        $cart_items->bind_param('i', $user_id);
        $cart_items->execute();
        $result = $cart_items->get_result();

        // Add order items and calculate total
        while ($item = $result->fetch_assoc()) {
            $stmt = $conn->prepare('INSERT INTO order_items (order_id, product_id, quantity, price) VALUES (?, ?, ?, ?)');
            $stmt->bind_param('iiid', $order_id, $item['product_id'], $item['quantity'], $item['price']);
            $stmt->execute();
            $total += $item['price'] * $item['quantity'];
        }

        // Update order total
        $update_total = $conn->prepare('UPDATE orders SET total_amount = ? WHERE id = ?');
        $update_total->bind_param('di', $total, $order_id);
        $update_total->execute();

        // Clear cart
        $clear_cart = $conn->prepare('DELETE FROM cart WHERE user_id = ?');
        $clear_cart->bind_param('i', $user_id);
        $clear_cart->execute();

        $conn->commit();
        $message = 'Order placed successfully!';
    } catch (Exception $e) {
        $conn->rollback();
        $message = 'Error processing order. Please try again.';
    }
}

// Get cart items for display
$sql = "SELECT cart.quantity, products.name, products.price, (cart.quantity * products.price) as subtotal 
        FROM cart 
        JOIN products ON cart.product_id = products.id 
        WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$total = 0;
?>

<div class="container mt-5">
    <h2>Checkout</h2>
    
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>

    <?php if ($result->num_rows > 0): ?>
        <div class="card">
            <div class="card-body">
                <h3>Order Summary</h3>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Quantity</th>
                            <th>Price</th>
                            <th>Subtotal</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php while ($row = $result->fetch_assoc()): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['name']); ?></td>
                                <td><?php echo $row['quantity']; ?></td>
                                <td>Rs.<?php echo number_format($row['price'], 2); ?></td>
                                <td>Rs.<?php echo number_format($row['subtotal'], 2); ?></td>
                            </tr>
                            <?php $total += $row['subtotal']; ?>
                        <?php endwhile; ?>
                    </tbody>
                    <tfoot>
                        <tr>
                            <th colspan="3">Total</th>
                            <th>RS.<?php echo number_format($total, 2); ?></th>
                        </tr>
                    </tfoot>
                </table>

                <form method="POST" class="mt-4">
                    <button type="submit" name="place_order" class="btn btn-success btn-lg">Place Order</button>
                    <a href="cart.php" class="btn btn-secondary btn-lg">Back to Cart</a>
                </form>
            </div>
        </div>
    <?php else: ?>
        <div class="alert alert-info">Your cart is empty.</div>
        <a href="../product/products.php" class="btn btn-primary">Continue Shopping</a>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?> 