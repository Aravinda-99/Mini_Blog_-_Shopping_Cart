<?php

include '../includes/header.php';
require_once '../connection.php';


echo '<link rel="stylesheet" href="blog.css">';

$sql = "SELECT posts.id, posts.title, LEFT(posts.content, 200) AS snippet, posts.created_at, users.name AS author
        FROM posts
        JOIN users ON posts.user_id = users.id
        ORDER BY posts.created_at DESC";
$result = $conn->query($sql);

function getInitials($name) {
    $words = explode(' ', $name);
    if (count($words) >= 2) {
        $first = strtoupper(substr($words[0], 0, 1));
        $last = strtoupper(substr($words[1], 0, 1));
        return $first . $last;
    } else {
        return strtoupper(substr($name, 0, 2));
    }
}
?>

<div class="container mt-5">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h2>Latest Updates</h2>
        <?php if (isset($_SESSION['user_id'])): ?>
            <a href="create.php" class="btn btn-primary rounded-pill px-4">New Post</a>
        <?php endif; ?>
    </div>
    <?php if (isset($_GET['success']) && $_GET['success'] == 'created'): ?>
        <div class="alert alert-success rounded-pill">Post created successfully!</div>
    <?php endif; ?>
    <div class="row row-cols-1 row-cols-md-2 row-cols-lg-3 g-4">
        <?php if ($result && $result->num_rows > 0): ?>
            <?php while ($row = $result->fetch_assoc()): ?>
                <div class="col">
                    <div class="custom-card">
                        <div class="card-body">
                            <h3 class="card-title">
                                <a href="view.php?id=<?php echo $row['id']; ?>" class="text-decoration-none text-dark"><?php echo htmlspecialchars($row['title']); ?></a>
                            </h3>
                            <div class="author-info">
                                <div class="profile-pic" data-author-initial="<?php echo getInitials(htmlspecialchars($row['author'])); ?>">
                                </div>
                                <span class="author-name"><?php echo htmlspecialchars($row['author']); ?></span>
                                <span class="post-date"><?php echo date('F j, Y, g:i a', strtotime($row['created_at'])); ?></span>
                            </div>
                            <p class="card-text text-secondary"><?php echo nl2br(htmlspecialchars($row['snippet'])); ?>...</p>
                            <a href="view.php?id=<?php echo $row['id']; ?>" class="read-more-link">Read more</a>
                        </div>
                    </div>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <div class="col">
                <div class="alert alert-info rounded-pill">No posts found.</div>
            </div>
        <?php endif; ?>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
