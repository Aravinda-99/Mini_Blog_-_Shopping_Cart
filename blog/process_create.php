<?php
require_once '../connection.php';
session_start();

if (!isset($_SESSION['user_id'])) {
    header('Location: ../login/login.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $title = trim($_POST['title']);
    $content = trim($_POST['content']);
    $user_id = $_SESSION['user_id'];

    if (empty($title) || empty($content)) {
        header('Location: create.php?error=emptyfields');
        exit();
    }

    $stmt = $conn->prepare('INSERT INTO posts (user_id, title, content) VALUES (?, ?, ?)');
    $stmt->bind_param('iss', $user_id, $title, $content);
    if ($stmt->execute()) {
        header('Location: index.php?success=created');
        exit();
    } else {
        header('Location: create.php?error=sqlerror');
        exit();
    }
} else {
    header('Location: create.php');
    exit();
}
?> 