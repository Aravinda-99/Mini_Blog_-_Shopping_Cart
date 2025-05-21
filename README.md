<?php



require_once '../connection.php';
include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Login/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
// $sql = "SELECT cart.id as cart_id, products.name, products.price, products.image, cart.quantity FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";

$sql = "SELECT id, name, birthday, gender, address, country, city, region FROM user";

$stmt = $conn->prepare($sql);
// $stmt->bind_param('i', $user_id);
$stmt->execute();
$result = $stmt->get_result();
$total = 0;
?>
<div class='container mt-5'>
    <h2>Admin DashBoard</h2>
    <table class='table'>
        <thead>
            <tr>
                <th>Name </th>
                <th>birthday</th>
                <th>gender</th>
                <th>address</th>
                <th>country</th>
                <th>city</th>
                <th>region</th>
            </tr>
        </thead>
        <tbody>
            <?php while ($row = $result->fetch_assoc()): ?>
                <tr>
                    
                    <td><?php echo htmlspecialchars($row['name']); ?></td>
                    <td><?php echo htmlspecialchars($row['birthday']); ?></td>
                    <td><?php echo htmlspecialchars($row['gender']); ?></td>
                    <td><?php echo htmlspecialchars($row['address']); ?></td>
                    <td><?php echo htmlspecialchars($row['country']); ?></td>
                    <td><?php echo htmlspecialchars($row['city']); ?></td>
                    <td><?php echo htmlspecialchars($row['region']); ?></td>
                  
                    <td>
                      <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm fw-medium px-3 shadow-sm">Edit</a>
                       <a href="remove_from_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm fw-medium px-3 shadow-sm" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                    </td>

                  
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include '../includes/footer.php'; ?> 

create delete for this code <a href="remove_from_cart.php?id=<?php echo $row['id']; ?>" class="btn btn-danger btn-sm fw-medium px-3 shadow-sm" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>




<?php
require_once '../connection.php';

if (!isset($_GET['id'])) {
    // ID not provided
    header('Location: ../admin/dashboard.php'); // redirect to dashboard or suitable page
    exit();
}

$id = $_GET['id'];

// Protect against SQL injection using prepared statements
$sql = "DELETE FROM user WHERE id = ?";

$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $id);

if ($stmt->execute()) {
    // Successfully deleted
    header("Location: ../admin/dashboard.php?message=User+deleted+successfully");
    exit();
} else {
    echo "Error deleting user: " . $conn->error;
}
?>
