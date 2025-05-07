<?php
require_once '../connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = trim($_POST['name']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    
    if (empty($name) || empty($email) || empty($password)) {
        header("Location: ../register/register.php?error=emptyfields");
        exit();
    }

    
    if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        header("Location: ../register/register.php?error=invalidemail");
        exit();
    }

    
    $stmt = $conn->prepare("SELECT id FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        header("Location: ../register/register.php?error=emailtaken");
        exit();
    }

    
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    
    $stmt = $conn->prepare("INSERT INTO users (name, email, password) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $name, $email, $hashedPassword);

    if ($stmt->execute()) {
        header("Location: ../register/register.php?success=registered");
        exit();
    } else {
        header("Location: ../register/register.php?error=sqlerror");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../register/register.php");
    exit();
}
?>