<?php include '../includes/header.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="max-width: 900px; width: 100%;">
        <div class="row g-0">
            <div class="col-md-6 d-none d-md-block" style="background: #f5f6fa;">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80"
                     alt="Register Visual" class="img-fluid h-100 w-100" style="object-fit: cover;">
            </div>
            <div class="col-md-6 bg-white p-5">
                <div class="text-center mb-4">
                    <span class="mb-2" style="font-size:2rem; color:#16a34a;"><i class="bi bi-leaf"></i></span>
                    <h2 class="fw-bold mt-2">Create Account</h2>
                    <p class="text-muted">Sign up to get started</p>
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
                    }  else if ($_GET['error'] == 'passwordMismatch') {
                        echo 'Passwords do not match';
                    }
                    echo '</div>';
                }
                if (isset($_GET['success']) && $_GET['success'] == 'registered') {
                    echo '<div class="alert alert-success">Registration successful! Please login.</div>';
                }
                ?>
                <form action="process_register.php" method="POST">
                    <div class="mb-3">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control form-control-lg" id="name" name="name" placeholder="Your Name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control form-control-lg" id="email" name="email" placeholder="you@example.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control form-control-lg" id="password" name="password" placeholder="Password" required>
                    </div>
                     <div class="mb-3">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control form-control-lg" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-success btn-lg">Sign Up</button>
                    </div>
                    <div class="text-center">
                        <span class="text-muted">Already have an account? <a href="../login/login.php" class="text-success fw-bold">Sign In</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
