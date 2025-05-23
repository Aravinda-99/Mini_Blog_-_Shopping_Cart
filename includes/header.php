<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mini Blog & Shopping Cart</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.0/font/bootstrap-icons.css">
    <link rel="stylesheet" href="header.css">
    <style>
        
        html, body {
            height: 100%;
            margin: 0;
            padding: 0;
        }

        .page-wrapper {
            min-height: 100vh;
            display: flex;
            flex-direction: column;
        }

        main {
            flex: 1; 
        }

        
        footer {
            margin-top: auto !important; 
            width: 100%; 
            background: linear-gradient(90deg, #232526 0%, #414345 100%); 
            color: #fff; 
            padding: 0; 
        }

        
        footer .footer-content {
            width: 100%; 
            max-width: 1200px; 
            margin: 0 auto; 
            padding: 3rem 15px; 
        }

        
        footer h6 {
            font-weight: bold;
            margin-bottom: 1rem;
            color: #fff;
        }

        
        footer ul.list-unstyled li a {
            color: rgba(255, 255, 255, 0.5); 
            text-decoration: none;
        }

        footer ul.list-unstyled li a:hover {
            color: #fff; 
            text-decoration: underline;
        }

        
        footer hr {
            border-color: rgba(255, 255, 255, 0.1);
            margin: 2rem 0;
        }

        
        footer .social-icons a {
            color: rgba(255, 255, 255, 0.5); 
            font-size: 1.25rem; 
            margin-left: 1rem; 
            text-decoration: none;
        }

        footer .social-icons a:hover {
            color: #fff; 
        }

        
        footer .copyright {
            color: rgba(255, 255, 255, 0.5); 
        }
    </style>
</head>
<body>
    <div class="page-wrapper">
        <nav class="navbar navbar-expand-lg navbar-dark bg-dark">
            <div class="container">
                <a class="navbar-brand" href="index.php">Mini Blog & Shop</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarNav">
                    <ul class="navbar-nav me-auto">
                        <li class="nav-item">
                            <a class="nav-link" href="../blog/index.php">Blog</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="../product/products.php">Shop</a>
                        </li>
                    </ul>
                    <ul class="navbar-nav">
                        <?php if (isset($_SESSION['user_id'])): ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../cart/cart.php">
                                    <i class="bi bi-cart"></i> Cart
                                </a>
                            </li>
                            <li class="nav-item dropdown">
                                <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown">
                                    <?php echo htmlspecialchars($_SESSION['name']); ?>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-end">
                                    <li><a class="dropdown-item" href="profile.php">Profile</a></li>
                                    <li><a class="dropdown-item" href="my_orders.php">My Orders</a></li>
                                    <li><hr class="dropdown-divider"></li>
                                    <li><a class="dropdown-item" href="../login/logout.php">Logout</a></li>
                                </ul>
                            </li>
                        <?php else: ?>
                            <li class="nav-item">
                                <a class="nav-link" href="../login/login.php">Login</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="../register/register.php">Register</a>
                            </li>
                        <?php endif; ?>
                    </ul>
                </div>
            </div>
        </nav>