<?php include '../includes/header.php'; ?>

<div class="container d-flex justify-content-center align-items-center" style="min-height: 90vh;">
    <div class="card shadow-lg border-0 rounded-4 overflow-hidden" style="max-width: 900px; width: 100%;">
        <div class="row g-0">
            <!-- Left: Image -->
            <div class="col-md-6 d-none d-md-block" style="background: #f5f6fa;">
                <img src="https://images.unsplash.com/photo-1506744038136-46273834b3fb?auto=format&fit=crop&w=600&q=80"
                     alt="Login Visual" class="img-fluid h-100 w-100" style="object-fit: cover;">
            </div>
            <!-- Right: Form -->
            <div class="col-md-6 bg-white p-5">
                <div class="text-center mb-4">
                    <span class="mb-2" style="font-size:2rem; color:#16a34a;"><i class="bi bi-leaf"></i></span>
                    <h2 class="fw-bold mt-2">Welcome Back</h2>
                    <p class="text-muted">Sign in to continue</p>
                </div>
                <?php
                if (isset($_GET['error'])) {
                    echo '<div class="alert alert-danger">';
                    if ($_GET['error'] == 'emptyfields') {
                        echo 'Please fill in all fields';
                    } else if ($_GET['error'] == 'wrongpassword') {
                        echo 'Incorrect password';
                    } else if ($_GET['error'] == 'nouser') {
                        echo 'No user found with this email';
                    }
                    echo '</div>';
                }
                if (isset($_GET['success']) && $_GET['success'] == 'registered') {
                    echo '<div class="alert alert-success">Registration successful! Please login.</div>';
                }
                ?>
                <form action="process_login.php" method="POST">
                    <div class="mb-3">
                        <input type="email" class="form-control form-control-lg" name="email" placeholder="Email Address" required>
                    </div>
                    <div class="mb-3">
                        <input type="password" class="form-control form-control-lg" name="password" placeholder="Password" required>
                    </div>
                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="rememberMe" name="remember">
                            <label class="form-check-label" for="rememberMe">Remember me</label>
                        </div>
                        <a href="#" class="text-decoration-none text-success">Forgot password?</a>
                    </div>
                    <div class="d-grid mb-3">
                        <button type="submit" class="btn btn-success btn-lg">Sign In</button>
                    </div>
                    <div class="text-center mb-3 text-muted">
                        <span>───────── Or continue with ─────────</span>
                    </div>
                    <div class="d-flex justify-content-center gap-2 mb-3">
                        <button type="button" class="btn btn-outline-secondary w-50"><i class="bi bi-google"></i> Google</button>
                        <button type="button" class="btn btn-outline-secondary w-50"><i class="bi bi-apple"></i> Apple</button>
                    </div>
                    <div class="text-center">
                        <span>Don't have an account? <a href="../register/register.php" class="text-success fw-bold">Sign up</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?> 