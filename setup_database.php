<?php
require_once 'connection.php';

// SQL commands to create tables
$sql_commands = [
    // Orders table
    "CREATE TABLE IF NOT EXISTS orders (
        id INT AUTO_INCREMENT PRIMARY KEY,
        user_id INT NOT NULL,
        total_amount DECIMAL(10,2) NOT NULL,
        status VARCHAR(20) NOT NULL DEFAULT 'pending',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (user_id) REFERENCES users(id)
    )",

    // Order items table
    "CREATE TABLE IF NOT EXISTS order_items (
        id INT AUTO_INCREMENT PRIMARY KEY,
        order_id INT NOT NULL,
        product_id INT NOT NULL,
        quantity INT NOT NULL,
        price DECIMAL(10,2) NOT NULL,
        FOREIGN KEY (order_id) REFERENCES orders(id),
        FOREIGN KEY (product_id) REFERENCES products(id)
    )"
];

$success = true;
$messages = [];

// Execute each SQL command
foreach ($sql_commands as $sql) {
    try {
        if ($conn->query($sql)) {
            $messages[] = "Success: Table created successfully";
        } else {
            $success = false;
            $messages[] = "Error: " . $conn->error;
        }
    } catch (Exception $e) {
        $success = false;
        $messages[] = "Error: " . $e->getMessage();
    }
}

// Display results
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Database Setup</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h2>Database Setup Results</h2>
        
        <?php if ($success): ?>
            <div class="alert alert-success">
                <h4>Setup Completed Successfully!</h4>
                <p>All database tables have been created.</p>
            </div>
        <?php else: ?>
            <div class="alert alert-danger">
                <h4>Setup Encountered Some Issues</h4>
                <p>Please check the messages below.</p>
            </div>
        <?php endif; ?>

        <div class="card mt-4">
            <div class="card-header">
                <h3>Setup Messages</h3>
            </div>
            <div class="card-body">
                <ul class="list-group">
                    <?php foreach ($messages as $message): ?>
                        <li class="list-group-item">
                            <?php echo htmlspecialchars($message); ?>
                        </li>
                    <?php endforeach; ?>
                </ul>
            </div>
        </div>

        <div class="mt-4">
            <a href="index.php" class="btn btn-primary">Go to Homepage</a>
        </div>
    </div>
</body>
</html> 