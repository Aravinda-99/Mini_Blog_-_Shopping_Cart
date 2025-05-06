<?php include '../includes/header.php'; ?>
<?php
require_once '../connection.php';
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}
$post_id = intval($_GET['id']);
$sql = "SELECT posts.*, users.name AS author FROM posts JOIN users ON posts.user_id = users.id WHERE posts.id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('i', $post_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo '<div class="alert alert-danger">Post not found.</div>';
    include '../includes/footer.php';
    exit();
}
$post = $result->fetch_assoc();
?>
<div class="container mt-5">
    <div class="card">
        <div class="card-body">
            <h2 class="card-title"><?php echo htmlspecialchars($post['title']); ?></h2>
            <p class="text-muted mb-2">By <?php echo htmlspecialchars($post['author']); ?> &middot; <?php echo date('M d, Y H:i', strtotime($post['created_at'])); ?></p>
            <p class="card-text"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                <a href="edit.php?id=<?php echo $post['id']; ?>" class="btn btn-warning btn-sm">Edit</a>
                <a href="delete.php?id=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
            <?php endif; ?>
            <a href="index.php" class="btn btn-secondary btn-sm">Back to Posts</a>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?> 