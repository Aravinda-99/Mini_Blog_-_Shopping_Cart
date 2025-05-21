<?php
require_once '../connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    
    if (empty($email) || empty($password)) {
        header("Location: ../login/login.php?error=emptyfields");
        exit();
    }

    
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: ../login/login.php?error=nouser");
        exit();
    }

    $user = $result->fetch_assoc();

    
    if (password_verify($password, $user['password'])) {
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['name'] = $user['name'];
        
        
        header("Location: ../adminDash/adminDash.php");
        exit();
    } else {
        header("Location: ../login/login.php?error=wrongpassword");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../login/login.php");
    exit();
}
?> 





<?php
require_once '../connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: ../login/login.php?error=emptyfields");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: ../login/login.php?error=nouser");
        exit();
    }

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: ../adminDash/adminDash.php");
        } else {
            header("Location: ../user/userDashboard.php"); // or any other user dashboard
        }
        exit();
    } else {
        header("Location: ../login/login.php?error=wrongpassword");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../login/login.php");
    exit();
}


Design the system to handle form validation, including checking for valid dates and 
ensuring users are 21+.

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
                        <a href="edit.php?id=<?php echo $row['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        <a href="remove_from_cart.php?id=<?php echo $row['id']; ?>" 
                           class="btn btn-danger btn-sm"
                           onclick="return confirm('Are you sure you want to delete this user?');">
                           Delete
                        </a>
                    </td>

                  
                </tr>
            <?php endwhile; ?>
        </tbody>
    </table>
</div>
<?php include '../includes/footer.php'; ?> 





