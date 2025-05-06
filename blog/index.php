<?php include '../includes/header.php'; ?>

<?php
require_once '../connection.php';

$sql = "SELECT posts.id, posts.title, LEFT(posts.content, 200) AS snippet, posts.created_at, users.name AS author
        FROM posts
        JOIN users ON posts.user_id = users.id
        ORDER BY posts.created_at DESC";
$result = $conn->query($sql);
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Blog Posts</h2>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="create.php" class="btn btn-success">Create New Post</a>
        <?php endif; ?>
    </div>
    <?php if (isset($_GET['success']) && $_GET['success'] == 'created'): ?>
        <div class="alert alert-success">Post created successfully!</div>
    <?php endif; ?>
    <?php if ($result && $result->num_rows > 0): ?>
        <?php while ($row = $result->fetch_assoc()): ?>
            <div class="card mb-4">
                <div class="card-body">
                    <h4 class="card-title">
                        <a href="view.php?id=<?php echo $row['id']; ?>" class="text-decoration-none"><?php echo htmlspecialchars($row['title']); ?></a>
                    </h4>
                    <p class="card-text text-muted mb-1">
                        By <?php echo htmlspecialchars($row['author']); ?> &middot; <?php echo date('M d, Y H:i', strtotime($row['created_at'])); ?>
                    </p>
                    <p class="card-text"><?php echo nl2br(htmlspecialchars($row['snippet'])); ?>...</p>
                    <a href="view.php?id=<?php echo $row['id']; ?>" class="btn btn-outline-primary btn-sm">Read More</a>
                </div>
            </div>
        <?php endwhile; ?>
    <?php else: ?>
        <div class="alert alert-info">No posts found.</div>
    <?php endif; ?>
</div>

<?php include '../includes/footer.php'; ?> 