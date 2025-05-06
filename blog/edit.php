<?php include '../includes/header.php'; ?>
<?php
require_once '../connection.php';
if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}
if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}
$post_id = intval($_GET['id']);
$sql = "SELECT * FROM posts WHERE id = ? AND user_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ii', $post_id, $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    echo '<div class="alert alert-danger">Post not found or you do not have permission to edit this post.</div>';
    include '../includes/footer.php';
    exit();
}
$post = $result->fetch_assoc();
?>
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Edit Post</h3>
                </div>
                <div class="card-body">
                    <form action="process_edit.php" method="POST">
                        <input type="hidden" name="id" value="<?php echo $post['id']; ?>">
                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control" id="title" name="title" value="<?php echo htmlspecialchars($post['title']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="content" class="form-label">Content</label>
                            <textarea class="form-control" id="content" name="content" rows="7" required><?php echo htmlspecialchars($post['content']); ?></textarea>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary">Update Post</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<?php include '../includes/footer.php'; ?> 