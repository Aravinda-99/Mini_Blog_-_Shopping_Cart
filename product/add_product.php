<?php
require_once '../connection.php';
include '../includes/header.php';

// Handle form submission
$message = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = trim($_POST['name']);
    $price = floatval($_POST['price']);
    $image_path = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $ext = pathinfo($_FILES['image']['name'], PATHINFO_EXTENSION);
        $filename = uniqid('prod_', true) . '.' . $ext;
        $target = '../images/' . $filename;
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $image_path = 'images/' . $filename;
        } else {
            $message = 'Image upload failed.';
        }
    }

    if ($name && $price && $image_path) {
        $stmt = $conn->prepare('INSERT INTO products (name, price, image) VALUES (?, ?, ?)');
        $stmt->bind_param('sds', $name, $price, $image_path);
        if ($stmt->execute()) {
            $message = 'Product added successfully!';
        } else {
            $message = 'Database error: ' . $conn->error;
        }
    } elseif (!$message) {
        $message = 'Please fill all fields and upload an image.';
    }
}
?>
<div class="container mt-5">
    <h2>Add New Product</h2>
    <?php if ($message): ?>
        <div class="alert alert-info"><?php echo htmlspecialchars($message); ?></div>
    <?php endif; ?>
    <form method="POST" enctype="multipart/form-data">
        <div class="mb-3">
            <label for="name" class="form-label">Product Name</label>
            <input type="text" class="form-control" id="name" name="name" required>
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" step="0.01" class="form-control" id="price" name="price" required>
        </div>
        <div class="mb-3">
            <label for="image" class="form-label">Product Image</label>
            <input type="file" class="form-control" id="image" name="image" accept="image/*" required>
        </div>
        <button type="submit" class="btn btn-success">Add Product</button>
    </form>
</div>
<?php include '../includes/footer.php'; ?> 