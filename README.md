<?php
require_once '../connection.php';
include '../includes/header.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: ../Login/login.php");
    exit();
}

if (!isset($_GET['id'])) {
    echo "<div class='alert alert-danger'>Invalid user ID</div>";
    include '../includes/footer.php';
    exit();
}

$user_id = intval($_GET['id']);

// Fetch user data
$sql = "SELECT * FROM user WHERE id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

if ($result->num_rows === 0) {
    echo "<div class='alert alert-danger'>User not found</div>";
    include '../includes/footer.php';
    exit();
}

$user = $result->fetch_assoc();
?>

<div class="container mt-5">
    <h3>Edit User</h3>
    <form method="POST" action="update_user.php">
        <input type="hidden" name="id" value="<?php echo $user['id']; ?>">

        <div class="mb-3">
            <label>Name</label>
            <input type="text" name="name" class="form-control" value="<?php echo htmlspecialchars($user['name']); ?>" required>
        </div>
        <div class="mb-3">
            <label>Birthday</label>
            <input type="date" name="birthday" class="form-control" value="<?php echo $user['birthday']; ?>" required>
        </div>
        <div class="mb-3">
            <label>Gender</label>
            <select name="gender" class="form-control" required>
                <option value="Male" <?php if ($user['gender'] == 'Male') echo 'selected'; ?>>Male</option>
                <option value="Female" <?php if ($user['gender'] == 'Female') echo 'selected'; ?>>Female</option>
            </select>
        </div>
        <div class="mb-3">
            <label>Address</label>
            <input type="text" name="address" class="form-control" value="<?php echo htmlspecialchars($user['address']); ?>">
        </div>
        <div class="mb-3">
            <label>Country</label>
            <input type="text" name="country" class="form-control" value="<?php echo htmlspecialchars($user['country']); ?>">
        </div>
        <div class="mb-3">
            <label>City</label>
            <input type="text" name="city" class="form-control" value="<?php echo htmlspecialchars($user['city']); ?>">
        </div>
        <div class="mb-3">
            <label>Region</label>
            <input type="text" name="region" class="form-control" value="<?php echo htmlspecialchars($user['region']); ?>">
        </div>

        <button type="submit" class="btn btn-success">Update User</button>
    </form>
</div>

<?php include '../includes/footer.php'; ?>



<?php
require_once '../connection.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id       = intval($_POST['id']);
    $name     = $_POST['name'];
    $birthday = $_POST['birthday'];
    $gender   = $_POST['gender'];
    $address  = $_POST['address'];
    $country  = $_POST['country'];
    $city     = $_POST['city'];
    $region   = $_POST['region'];

    $sql = "UPDATE user SET name = ?, birthday = ?, gender = ?, address = ?, country = ?, city = ?, region = ? WHERE id = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssssssi", $name, $birthday, $gender, $address, $country, $city, $region, $id);

    if ($stmt->execute()) {
        header("Location: adminDash.php?message=User+updated+successfully");
    } else {
        echo "Error updating user: " . $conn->error;
    }
} else {
    header("Location: adminDash.php");
}
