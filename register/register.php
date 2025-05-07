<?php include '../includes/header.php'; ?>

<style>
    :root {
        --primary-color: #16a34a;
        --secondary-color: #f5f6fa;
        --text-muted: #6b7280;
        --card-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
        --transition: all 0.3s ease;
    }

    .register-container {
        min-height: 85vh;
        display: flex;
        justify-content: center;
        align-items: center;
        padding: 1rem;
    }

    .register-card {
        max-width: 800px; 
        width: 100%;
        border: none;
        border-radius: 1rem;
        overflow: hidden;
        box-shadow: var(--card-shadow);
        transition: var(--transition);
    }

    .register-image {
        height: 100%;
        object-fit: cover;
        background-color: var(--secondary-color);
    }

    .register-form-container {
        padding: 2rem; 
        background-color: #fff;
    }

    .register-icon {
        font-size: 1.5rem; 
        color: var(--primary-color);
    }

    .register-title {
        font-size: 1.5rem; 
        font-weight: 700;
        margin-bottom: 0.5rem;
    }

    .register-subtitle {
        font-size: 0.9rem;
        color: var(--text-muted);
    }

    .form-label {
        font-size: 0.9rem;
        font-weight: 500;
        margin-bottom: 0.3rem;
    }

    .form-control {
 grasa        padding: 0.5rem 0.75rem; 
        font-size: 0.9rem;
        border-radius: 0.5rem;
        border: 1px solid #d1d5db;
        transition: var(--transition);
    }

    .form-control:focus {
        border-color: var(--primary-color);
        box-shadow: 0 0 0 3px rgba(22, 163, 74, 0.1);
        outline: none;
    }

    .btn-success {
        background-color: var(--primary-color);
        border: none;
        padding: 0.6rem;
        font-size: 0.9rem;
        border-radius: 0.5rem;
        transition: var(--transition);
    }

    .btn-success:hover {
        background-color: #15803d;
        transform: translateY(-2px);
    }

    .alert {
        font-size: 0.85rem;
        padding: 0.5rem;
        margin-bottom: 1rem;
        border-radius: 0.5rem;
    }

    .text-muted a {
        color: var(--primary-color);
        text-decoration: none;
        font-weight: 600;
    }

    .text-muted a:hover {
        text-decoration: underline;
    }

    @media (max-width: 767.98px) {
        .register-card {
            max-width: 100%;
        }

        .register-form-container {
            padding: 1.5rem;
        }

        .register-title {
            font-size: 1.25rem;
        }

        .register-image {
            display: none; 
        }
    }
</style>

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
                    <h2 class="register-title">Create Account</h2>
                    <p class="register-subtitle">Sign up to get started</p>
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
                    echo '<div class="alert alert-success">Registration successful! Please login.</div>';
                }
                ?>
                <form action="process_register.php" method="POST">
                    <div class="mb-2">
                        <label for="name" class="form-label">Name</label>
                        <input type="text" class="form-control" id="name" name="name" placeholder="Your Name" value="<?php echo isset($_POST['name']) ? htmlspecialchars($_POST['name']) : ''; ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="email" class="form-label">Email Address</label>
                        <input type="email" class="form-control" id="email" name="email" placeholder="you@example.com" value="<?php echo isset($_POST['email']) ? htmlspecialchars($_POST['email']) : ''; ?>" required>
                    </div>
                    <div class="mb-2">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                    </div>
                    <div class="mb-2">
                        <label for="confirm_password" class="form-label">Confirm Password</label>
                        <input type="password" class="form-control" id="confirm_password" name="confirm_password" placeholder="Confirm Password" required>
                    </div>
                    <div class="d-grid mb-2">
                        <button type="submit" class="btn btn-success">Sign Up</button>
                    </div>
                    <div class="text-center">
                        <span class="text-muted">Already have an account? <a href="../login/login.php">Sign In</a></span>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>