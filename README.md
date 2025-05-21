<?php
require_once '../connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    
    if (empty($email) || empty($password)) {
        header("Location: ../login/login.php?error=emptyfields");
        exit();
    }

    
    $stmt = $conn->prepare("SELECT id, name, password FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: ../login/login.php?error=nouser");
        exit();
    }

    $user = $result->fetch_assoc();

    
    if (password_verify($password, $user['password'])) {
        
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['name'] = $user['name'];
        
        
        header("Location: ../adminDash/adminDash.php");
        exit();
    } else {
        header("Location: ../login/login.php?error=wrongpassword");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../login/login.php");
    exit();
}
?> 





<?php
require_once '../connection.php';
session_start();

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = trim($_POST['email']);
    $password = $_POST['password'];

    if (empty($email) || empty($password)) {
        header("Location: ../login/login.php?error=emptyfields");
        exit();
    }

    $stmt = $conn->prepare("SELECT id, name, password, role FROM users WHERE email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows === 0) {
        header("Location: ../login/login.php?error=nouser");
        exit();
    }

    $user = $result->fetch_assoc();

    if (password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['name'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: ../adminDash/adminDash.php");
        } else {
            header("Location: ../user/userDashboard.php"); // or any other user dashboard
        }
        exit();
    } else {
        header("Location: ../login/login.php?error=wrongpassword");
        exit();
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: ../login/login.php");
    exit();
}
