<?php include '../includes/header.php'; ?>

<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-6">
            <div class="card">
                <div class="card-header">
                    <h3 class="text-center">Register</h3>
                </div>
                <div class="card-body">
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
                        }
                        echo '</div>';
                    }
                    if (isset($_GET['success']) && $_GET['success'] == 'registered') {
                        echo '<div class="alert alert-success">';
                        echo 'Registration successful! You will be redirected to the login page.';
                        echo '<script>setTimeout(function(){ window.location.href = "../login/login.php"; }, 3000);</script>';
                        echo '</div>';
                    }
                    ?>
                    <form action="process_register.php" method="POST">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="<?php echo isset($_GET['success']) ? '' : (isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control" id="email" name="email" value="<?php echo isset($_GET['success']) ? '' : (isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" class="form-control" id="password" name="password" required>
                        </div>
                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary" <?php echo isset($_GET['success']) ? 'disabled' : ''; ?>>Register</button>
                        </div>
                    </form>
                    <div class="text-center mt-3">
                        <p>Already have an account? <a href="../login/login.php">Login here</a></p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>