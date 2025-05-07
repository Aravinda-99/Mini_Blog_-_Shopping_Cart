<?php
require_once '../connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $post_id = intval($_POST['id']);
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

 
    $stmt = $conn->prepare('SELECT id FROM posts WHERE id = ? AND user_id = ?');
    $stmt->bind_param('ii', $post_id, $user_id);
    $stmt->execute();
    $result = $stmt->get_result();
    if ($result->num_rows === 0) {
        header('Location: index.php?error=notallowed');
        exit();
    }

    
    $stmt = $conn->prepare('UPDATE posts SET title = ?, content = ? WHERE id = ? AND user_id = ?');
    $stmt->bind_param('ssii', $title, $content, $post_id, $user_id);
    if ($stmt->execute()) {
        header('Location: index.php?success=updated');
        exit();
    } else {
        header('Location: edit.php?id=' . $post_id . '&error=sqlerror');
        exit();
    }
} else {
    header('Location: index.php');
    exit();
}
?> 