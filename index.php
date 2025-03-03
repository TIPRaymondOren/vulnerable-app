<?php
session_start(); // Start a session (optional, for future use)
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ShopSphere - Home</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        /* Custom Cybersecurity Theme */
        :root {
            --primary-color: #007BFF; /* Blue */
            --secondary-color: #28A745; /* Green */
            --background-color: #F8F9FA; /* Light Gray */
            --text-color: #333; /* Dark Gray */
            --hover-color: #0056b3; /* Darker Blue */
        }

        body {
            background-color: var(--background-color);
            color: var(--text-color);
        }

        .hero-section {
            background-color: var(--primary-color);
            color: white;
            padding: 100px 0;
            text-align: center;
        }

        .hero-section h1 {
            font-size: 3rem;
            font-weight: bold;
        }

        .hero-section p {
            font-size: 1.2rem;
            margin-top: 20px;
        }

        .cta-button {
            margin-top: 30px;
        }

        .cta-button .btn {
            font-size: 1.2rem;
            padding: 10px 30px;
        }

        .features-section {
            padding: 50px 0;
            text-align: center;
        }

        .features-section h2 {
            color: var(--primary-color);
            margin-bottom: 30px;
        }

        .feature-card {
            background-color: white;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
        }

        .feature-card h3 {
            color: var(--primary-color);
        }

        .footer {
            background-color: var(--primary-color);
            color: white;
            padding: 20px 0;
            text-align: center;
        }
    </style>
</head>
<body>
    <!-- Hero Section -->
    <div class="hero-section">
        <div class="container">
            <h1>Welcome to ShopSphere</h1>
            <p>Your one-stop destination for all your shopping needs. Join us today and explore a world of possibilities!</p>
            <div class="cta-button">
                <a href="register.php" class="btn btn-light btn-lg">Get Started</a>
            </div>
        </div>
    </div>

    <!-- Features Section -->
    <div class="features-section">
        <div class="container">
            <h2>Why Choose ShopSphere?</h2>
            <div class="row">
                <div class="col-md-4">
                    <div class="feature-card">
                        <h3>Wide Range of Products</h3>
                        <p>Explore thousands of products across various categories.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <h3>Secure Transactions</h3>
                        <p>Shop with confidence using our secure payment gateway.</p>
                    </div>
                </div>
                <div class="col-md-4">
                    <div class="feature-card">
                        <h3>Fast Delivery</h3>
                        <p>Get your orders delivered right to your doorstep.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Footer -->
    <footer class="footer">
        <div class="container">
            <p>&copy; 2023 ShopSphere. All rights reserved.</p>
        </div>
    </footer>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>