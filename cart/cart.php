<?php
// Cart page skeleton
// Fetch and display cart items for the user here
// ... existing code ... 


require_once '../connection.php';
include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Login/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
$sql = "SELECT cart.id as cart_id, products.name, products.price, products.image, cart.quantity FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$total = 0;
?>
<div class='container mt-5'>
    <h2>Your Cart</h2>
    <table class='table'>
        <thead>
            <tr>
                <th>Image</th>
                <th>Name</th>
                <th>Price</th>
                <th>Quantity</th>
                <th>Total</th>
                <th>Action</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    <td><img src="../<?php echo htmlspecialchars($row['image']); ?>" width="50"></td>
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td>Rs.<?php echo number_format($row['price'], 2); ?></td>
                    <td><?php echo $row['quantity']; ?></td>
                    <td>Rs.<?php echo number_format($row['price'] * $row['quantity'], 2); ?></td>
                    <td>
                        <form action="remove_from_cart.php" method="POST" style="display:inline;">
                            <input type="hidden" name="cart_id" value="<?php echo $row['cart_id']; ?>">
                            <button type="submit" class="btn btn-danger btn-sm">Remove</button>
                        </form>
                    </td>
                </tr>
                <?php $total += $row['price'] * $row['quantity']; ?>
            <?php endwhile; ?>
        </tbody>
    </table>
    <h4>Total: Rs.<?php echo number_format($total, 2); ?></h4>
    <a href="../cart/checkout.php" class="btn btn-secondary">Continue Shopping</a>
</div>
<?php include '../includes/footer.php'; ?> 