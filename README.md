# Mini_Blog_-_Shopping_Cart

<?php


session_start();
require_once '../connection.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Login/login.php');
    exit();
}

if (isset($_POST['id'])) {
    $id = intval($_POST['id']);
    $user_id = $_SESSION['user_id'];
    $stmt = $conn->prepare('DELETE FROM user WHERE id = ?');
    $stmt->bind_param('i', $id);
    $stmt->execute();
}
header('Location: adminDash.php');
exit(); 


<?php



require_once '../connection.php';
include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header('Location: ../Login/login.php');
    exit();
}

$user_id = $_SESSION['user_id'];
// $sql = "SELECT cart.id as cart_id, products.name, products.price, products.image, cart.quantity FROM cart JOIN products ON cart.product_id = products.id WHERE cart.user_id = ?";

$sql = "SELECT * FROM user ";

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
                    <a href="edit.php?id=<?php echo $post['id']; ?>" class="btn btn-warning btn-sm fw-medium px-3 shadow-sm">Edit</a>
                    <a href="remove_from_cart.php?id=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm fw-medium px-3 shadow-sm" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                </td>

                  
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include '../includes/footer.php'; ?> 




SELECT id, name, birthday, gender, address, country, city, region FROM your_table_name


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

<?php
// Database connection
$conn = new mysqli("localhost", "your_username", "your_password", "your_database");

// Connection check
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// ID එක URL එකෙන් ගන්නවා
if (isset($_GET['id']) && is_numeric($_GET['id'])) {
    $id = $_GET['id'];

    // SQL DELETE query එක
    $sql = "DELETE FROM your_table_name WHERE id = ?";

    // Prepared statement එක භාවිතා කරන්න (SQL injection වලට ආරක්ෂාවක් ලබාදෙයි)
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $id);

    if ($stmt->execute()) {
        // Delete කිරීම සාර්ථකයි
        header("Location: your_list_page.php?message=deleted");
        exit();
    } else {
        echo "Error deleting record: " . $conn->error;
    }

    $stmt->close();
} else {
    echo "Invalid ID";
}

$conn->close();
?>


