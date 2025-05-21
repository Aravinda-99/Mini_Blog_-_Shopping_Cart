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


Design the system to handle form validation, including checking for valid dates and 
ensuring users are 21+.



<div class="register-container">
    <div class="register-card">
        <div class="row g-0">
            <div class="col-md-6 d-none d-md-block">
                <img src="https://media.istockphoto.com/id/2175370570/photo/login-with-username-and-password-secure-access-to-users-personal-information-cyber-security.jpg?s=612x612&w=0&k=20&c=VA4nj5vYW2KVTnGDO5vV-2eDwJehmqPor8QHepT3NJ4="
                     alt="Register Visual" class="register-image" loading="lazy">
            </div>
            <div class="col-md-6 register-form-container">
                <div class="text-center mb-3">
                    <span class="register-icon"><i class="bi bi-leaf"></i></span>
                    <h2 class="register-title">Company registration</h2>
                    <p class="register-subtitle">Register to get started</p>
                </div>
                <?php
                if (isset($_GET['error'])) {
                    echo '<div class="alert alert-danger">';
                    if ($_GET['error'] == 'emptyfields') {
                        echo 'Please fill in all fields';
                    } else if ($_GET['error'] == 'invalidemail') {
                        echo 'Invalid email format';
                    } else if ($_GET['error'] == 'emailtaken') {
                        echo 'Email already taken';
                    } else if ($_GET['error'] == 'sqlerror') {
                        echo 'Database error occurred';
                    } else if ($_GET['error'] == 'passwordMismatch') {
                        echo 'Passwords do not match';
                    }
                    echo '</div>';
                }
                if (isset($_GET['success']) && $_GET['success'] == 'registered') {
                    echo '<div class="alert alert-success">Registration successful!.</div>';
                }
                ?>
                <form action="process_Cregister.php" method="POST">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                    </div>

                    <div class="mb-2">
                        <label for="birthday" class="form-label">birthday</label>
                        <input type="date" class="form-control" id="birthday" name="birthday" placeholder="Your birthday" value="<?php echo isset($_POST['birthday']) ? htmlspecialchars($_POST['birthday']) : ''; ?>" required>
                    </div>

                    <div class="mb-2">
                        <label for="gender" class="form-label">Gender</label>
                        <input type="text" class="form-control" id="gender" name="gender" placeholder="Your gender" value="<?php echo isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : ''; ?>" required>
                    </div>

                    <div class="mb-2">
                        <label for="address" class="form-label">address</label>
                        <input type="text" class="form-control" id="address" name="address" placeholder="Your address" value="<?php echo isset($_POST['address']) ? htmlspecialchars($_POST['address']) : ''; ?>" required>
                    </div>

                    <div class="mb-2">
                        <label for="country" class="form-label">country</label>
                        <input type="text" class="form-control" id="country" name="country" placeholder="Your country" value="<?php echo isset($_POST['country']) ? htmlspecialchars($_POST['country']) : ''; ?>" required>
                    </div>

                    <div class="mb-2">
                        <label for="city" class="form-label">city</label>
                        <input type="text" class="form-control" id="city" name="city" placeholder="Your city" value="<?php echo isset($_POST['city']) ? htmlspecialchars($_POST['city']) : ''; ?>" required>
                    </div>

                    <div class="mb-2">
                        <label for="region" class="form-label">region</label>
                        <input type="text" class="form-control" id="region" name="region" placeholder="Your region" value="<?php echo isset($_POST['region']) ? htmlspecialchars($_POST['region']) : ''; ?>" required>
                    </div>
                    <div class="d-grid mb-2">
                        <button type="submit" class="btn btn-success">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>




<?php
require_once '../connection.php';
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name     = trim($_POST['name']);
    $birthday = trim($_POST['birthday']);
    $gender   = trim($_POST['gender']);
    $address  = trim($_POST['address']);
    $country  = trim($_POST['country']);
    $city     = trim($_POST['city']);
    $region   = trim($_POST['region']);

    // 1. Check for empty fields
    if (empty($name) || empty($birthday) || empty($gender) || empty($address) || empty($country) || empty($city) || empty($region)) {
        header("Location: register.php?error=emptyfields");
        exit();
    }

    // 2. Validate birthday format (YYYY-MM-DD) and check if it's a valid date
    $birthDate = DateTime::createFromFormat('Y-m-d', $birthday);
    $birthErrors = DateTime::getLastErrors();

    if (!$birthDate || $birthErrors['warning_count'] > 0 || $birthErrors['error_count'] > 0) {
        header("Location: register.php?error=invaliddate");
        exit();
    }

    // 3. Check if user is at least 21 years old
    $today = new DateTime();
    $age = $today->diff($birthDate)->y;

    if ($age < 21) {
        header("Location: register.php?error=underage");
        exit();
    }

    // 4. If all valid, insert to DB (example query)
    $stmt = $conn->prepare("INSERT INTO user (name, birthday, gender, address, country, city, region) VALUES (?, ?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("sssssss", $name, $birthday, $gender, $address, $country, $city, $region);

    if ($stmt->execute()) {
        header("Location: register.php?success=registered");
    } else {
        header("Location: register.php?error=sqlerror");
    }

    $stmt->close();
    $conn->close();
} else {
    header("Location: register.php");
    exit();
}
?>
