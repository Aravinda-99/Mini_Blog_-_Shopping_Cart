<?php

include '../includes/header.php';
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
    echo '<div class="alert alert-danger rounded-3 shadow-sm">Post not found.</div>';
    include '../includes/footer.php';
    exit();
}

$post = $result->fetch_assoc();
?>

<div class="container my-5">
    <div class="card border-0 shadow-lg rounded-3 overflow-hidden">
        <div class="card-body p-4">
            <h2 class="card-title fw-bold mb-3 text-dark"><?php echo htmlspecialchars($post['title']); ?></h2>
            <div class="d-flex align-items-center text-muted mb-3 fs-6">
                <div class="profile-pic"></div>
                <span class="fw-medium"><?php echo htmlspecialchars($post['author']); ?></span> 
                · <?php echo date('M d, Y', strtotime($post['created_at'])); ?>
            </div>
            <p class="card-text text-dark fs-5 lh-base"><?php echo nl2br(htmlspecialchars($post['content'])); ?></p>
            <div class="d-flex gap-2 mt-4">
                <?php if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $post['user_id']): ?>
                    <a href="edit.php?id=<?php echo $post['id']; ?>" class="btn btn-warning btn-sm fw-medium px-3 shadow-sm">Edit</a>
                    <a href="delete.php?id=<?php echo $post['id']; ?>" class="btn btn-danger btn-sm fw-medium px-3 shadow-sm" onclick="return confirm('Are you sure you want to delete this post?');">Delete</a>
                <?php endif; ?>
                <a href="index.php" class="btn btn-outline-secondary btn-sm fw-medium px-3 shadow-sm">Back to Posts</a>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>