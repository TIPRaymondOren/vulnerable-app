<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $item = $_POST['item'];
    echo "<div class='alert alert-success text-center'>Added to cart: " . htmlspecialchars($item) . "</div>"; // Vulnerable to XSS if htmlspecialchars is removed
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart - ShopSphere</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F8F9FA;
        }
        .cart-form {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 400px;
            margin: 5rem auto;
        }
    </style>
</head>
<body>
    <div class="cart-form">
        <h2 class="text-center mb-4">Shopping Cart</h2>
        <form method="POST">
            <div class="mb-3">
                <label for="item" class="form-label">Item Name</label>
                <input type="text" class="form-control" id="item" name="item" required>
            </div>
            <button type="submit" class="btn btn-primary w-100">Add to Cart</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>