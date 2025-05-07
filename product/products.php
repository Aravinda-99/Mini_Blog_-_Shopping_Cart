<?php
require_once '../connection.php';
include '../includes/header.php';

// Handle search
$search = isset($_GET['search']) ? trim($_GET['search']) : '';
$where_clause = $search ? "WHERE name LIKE ?" : "";
$sql = "SELECT * FROM products $where_clause";

$stmt = $conn->prepare($sql);
if ($search) {
    $search_term = "%$search%";
    $stmt->bind_param('s', $search_term);
    $stmt->execute();
    $result = $stmt->get_result();
} else {
    $result = $conn->query($sql);
}
?>
<div class="container mt-5">
    <h2 class="mb-4">Products</h2>
    <form class="d-flex mb-4" method="GET">
        <input type="text" name="search" class="form-control me-2" placeholder="Search products..." value="<?php echo htmlspecialchars($search); ?>">
        <button type="submit" class="btn btn-outline-primary">Search</button>
    </form>
    <div class="row row-cols-1 row-cols-md-3 g-4">
        <?php if ($result && $result->num_rows > 0): ?>
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
        <?php else: ?>
            <div class="col-12">
                <div class="alert alert-info">No products found.</div>
            </div>
        <?php endif; ?>
    </div>
</div>
<?php include '../includes/footer.php'; ?>
