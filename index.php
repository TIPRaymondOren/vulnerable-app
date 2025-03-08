<?php
session_start();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopSphere - Home</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome for Icons -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        /* Custom Theme */
        :root {
            --primary-color: #007BFF;
            --secondary-color: #28A745;
            --background-color: #F8F9FA;
            --text-color: #333;
            --hover-color: #0056b3;
        }

        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }

        html, body {
            background-color: var(--background-color);
            color: var(--text-color);
            font-family: 'Poppins', sans-serif;
            height: 100vh;
            overflow: hidden;
        }

        .container-fluid {
            padding: 0;
            margin: 0;
            width: 100%;
            height: 100vh;
            display: flex;
            flex-direction: column;
            justify-content: space-between;
        }

        /* Hero Section */
        .hero-section {
            background: linear-gradient(to right, var(--primary-color), var(--hover-color));
            color: white;
            padding: 40px 20px;
            text-align: center;
            border-radius: 0 0 20px 20px;
        }

        .hero-section h1 {
            font-size: 2rem;
            font-weight: bold;
        }

        .hero-section p {
            font-size: 1rem;
            margin-top: 10px;
        }

        .cta-button .btn {
            font-size: 1rem;
            padding: 10px 25px;
            border-radius: 50px;
            transition: 0.3s;
            background-color: white;
            color: var(--primary-color);
        }

        .cta-button .btn:hover {
            background-color: var(--primary-color);
            color: white;
            box-shadow: 0px 0px 10px rgba(0, 123, 255, 0.5);
        }

        /* Features Section */
        .features-section {
            padding: 30px 20px;
            text-align: center;
            flex-grow: 1;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .features-section h2 {
            color: var(--primary-color);
            margin-bottom: 20px;
        }

        .feature-card {
            background: rgba(255, 255, 255, 0.2);
            backdrop-filter: blur(10px);
            padding: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.1);
            transition: transform 0.3s ease-in-out;
            border: 1px solid rgba(255, 255, 255, 0.3);
        }

        .feature-card:hover {
            transform: translateY(-10px);
        }

        .feature-card h3 {
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        .feature-card i {
            font-size: 40px;
            color: var(--primary-color);
            margin-bottom: 10px;
        }

        /* Footer */
        .footer {
            background: var(--primary-color);
            color: white;
            padding: 10px 0;
            text-align: center;
            border-radius: 20px 20px 0 0;
        }

        .footer .social-icons a {
            color: white;
            font-size: 20px;
            margin: 0 10px;
            transition: 0.3s;
        }

        .footer .social-icons a:hover {
            color: #ccc;
        }

        /* Responsive */
        @media (max-width: 768px) {
            .hero-section h1 {
                font-size: 1.8rem;
            }

            .feature-card {
                margin-bottom: 10px;
            }
        }
    </style>
</head>
<body>

    <div class="container-fluid">
        <!-- Hero Section -->
        <div class="hero-section">
            <h1>Welcome to ShopSphere</h1>
            <p>Your one-stop destination for all your shopping needs. Explore a world of possibilities!</p>
            <div class="cta-button">
                <a href="register.php" class="btn">Get Started</a>
            </div>
        </div>

        <!-- Features Section -->
        <div class="features-section">
            <div class="container">
                <h2>Why Choose ShopSphere?</h2>
                <div class="row">
                    <div class="col-md-4">
                        <div class="feature-card">
                            <i class="fas fa-shopping-cart"></i>
                            <h3>Wide Range of Products</h3>
                            <p>Explore thousands of products across various categories.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <i class="fas fa-lock"></i>
                            <h3>Secure Transactions</h3>
                            <p>Shop with confidence using our secure payment gateway.</p>
                        </div>
                    </div>
                    <div class="col-md-4">
                        <div class="feature-card">
                            <i class="fas fa-truck"></i>
                            <h3>Fast Delivery</h3>
                            <p>Get your orders delivered right to your doorstep.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Footer -->
        <footer class="footer">
            <p>&copy; 2023 ShopSphere. All rights reserved.</p>
            <div class="social-icons">
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-twitter"></i></a>
                <a href="#"><i class="fab fa-instagram"></i></a>
            </div>
        </footer>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>

</body>
</html>
