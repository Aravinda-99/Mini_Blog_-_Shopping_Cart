<?php
require_once '../connection.php';
include '../includes/header.php';

// Fetch products
$sql = "SELECT * FROM products";
$result = $conn->query($sql);
?>
<div class="container mt-5">
    <h2 class="mb-4">Products</h2>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="col">
                <div class="card h-100 shadow-sm">
                    <img src="../<?php echo htmlspecialchars($row['image']); ?>" class="card-img-top" alt="<?php echo htmlspecialchars($row['name']); ?>" style="object-fit: cover; height: 200px;">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo htmlspecialchars($row['name']); ?></h5>
                        <p class="card-text">Rs. <?php echo number_format($row['price'], 2); ?></p>
                        <form action="../cart/add_to_cart.php" method="POST">
                            <input type="hidden" name="product_id" value="<?php echo $row['id']; ?>">
                            <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
                        </form>
                    </div>
                </div>
            </div>
        <?php endwhile; ?>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
