<?php
require_once '../connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}

if (!isset($_GET['id'])) {
    header('Location: index.php');
    exit();
}
$post_id = intval($_GET['id']);
$user_id = $_SESSION['user_id'];


$stmt = $conn->prepare('SELECT id FROM posts WHERE id = ? AND user_id = ?');
$stmt->bind_param('ii', $post_id, $user_id);
$stmt->execute();
$result = $stmt->get_result();
if ($result->num_rows === 0) {
    header('Location: index.php?error=notallowed');
    exit();
}


$stmt = $conn->prepare('DELETE FROM posts WHERE id = ? AND user_id = ?');
$stmt->bind_param('ii', $post_id, $user_id);
if ($stmt->execute()) {
    header('Location: index.php?success=deleted');
    exit();
} else {
    header('Location: index.php?error=sqlerror');
    exit();
}
?> 