<?php
session_start(); // Start a session to manage the cart
include 'db.php';

// Initialize the cart if it doesn't exist
if (!isset($_SESSION['cart'])) {
    $_SESSION['cart'] = [];
}

// Add item to cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['add_to_cart'])) {
    $product_id = $_POST['product_id'];
    $quantity = $_POST['quantity'];

    // Fetch product details
    $sql = "SELECT * FROM products WHERE id='$product_id'";
    $product = $conn->query($sql)->fetch(PDO::FETCH_ASSOC);

    if ($product) {
        // Add product to cart
        $_SESSION['cart'][$product_id] = [
            'name' => $product['name'],
            'price' => $product['price'],
            'quantity' => $quantity
        ];
        echo "<div class='alert alert-success text-center'>Product added to cart!</div>";
    }
}

// Remove item from cart
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['remove_from_cart'])) {
    $product_id = $_POST['product_id'];
    if (isset($_SESSION['cart'][$product_id])) {
        unset($_SESSION['cart'][$product_id]);
        echo "<div class='alert alert-success text-center'>Product removed from cart!</div>";
    }
}

// Handle checkout
if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['checkout'])) {
    $card_number = $_POST['card_number'];
    $expiry_date = $_POST['expiry_date'];
    $cvv = $_POST['cvv'];

    // Basic validation
    $errors = [];
    if (!preg_match('/^\d{16}$/', $card_number)) {
        $errors[] = "Invalid card number. Must be 16 digits.";
    }
    if (!preg_match('/^(0[1-9]|1[0-2])\/\d{2}$/', $expiry_date)) {
        $errors[] = "Invalid expiry date. Must be in MM/YY format.";
    }
    if (!preg_match('/^\d{3}$/', $cvv)) {
        $errors[] = "Invalid CVV. Must be 3 digits.";
    }

    if (empty($errors)) {
        // Process the order (for demonstration, we'll just clear the cart)
        $total_cost = array_sum(array_map(function($item) {
            return $item['price'] * $item['quantity'];
        }, $_SESSION['cart']));

        // Insert order into the database
        $user_id = 1; // Replace with the actual logged-in user ID
        $sql = "INSERT INTO orders (user_id, total_cost) VALUES ('$user_id', '$total_cost')";
        $conn->exec($sql);
        $order_id = $conn->lastInsertId();

        // Insert order items into the database
        foreach ($_SESSION['cart'] as $product_id => $item) {
            $sql = "INSERT INTO order_items (order_id, product_id, quantity, price) VALUES ('$order_id', '$product_id', '{$item['quantity']}', '{$item['price']}')";
            $conn->exec($sql);
        }

        // Clear the cart
        $_SESSION['cart'] = [];
        echo "<div class='alert alert-success text-center'>Order placed successfully! Total cost: $$total_cost</div>";
    } else {
        foreach ($errors as $error) {
            echo "<div class='alert alert-danger text-center'>$error</div>";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard - ShopSphere</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F8F9FA;
        }
        .dashboard-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 1200px;
            margin: 5rem auto;
        }
        .cart-summary {
            background-color: #f8f9fa;
            padding: 1rem;
            border-radius: 8px;
            margin-bottom: 2rem;
        }
    </style>
</head>
<body>
    <div class="dashboard-container">
        <h2 class="text-center mb-4">Welcome to Your Dashboard</h2>

        <!-- Cart Summary -->
        <div class="cart-summary">
            <h4>Your Cart</h4>
            <?php if (empty($_SESSION['cart'])): ?>
                <p>Your cart is empty.</p>
            <?php else: ?>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Product</th>
                            <th>Price</th>
                            <th>Quantity</th>
                            <th>Total</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($_SESSION['cart'] as $product_id => $item): ?>
                            <tr>
                                <td><?php echo htmlspecialchars($item['name']); ?></td>
                                <td>$<?php echo htmlspecialchars($item['price']); ?></td>
                                <td><?php echo htmlspecialchars($item['quantity']); ?></td>
                                <td>$<?php echo htmlspecialchars($item['price'] * $item['quantity']); ?></td>
                                <td>
                                    <form method="POST" style="display:inline;">
                                        <input type="hidden" name="product_id" value="<?php echo $product_id; ?>">
                                        <button type="submit" name="remove_from_cart" class="btn btn-danger btn-sm">Remove</button>
                                    </form>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <p class="text-end"><strong>Total: $<?php echo array_sum(array_map(function($item) {
                    return $item['price'] * $item['quantity'];
                }, $_SESSION['cart'])); ?></strong></p>
            <?php endif; ?>
        </div>

        <!-- Product List -->
        <h4>Available Products</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Fetch all products
                $sql = "SELECT * FROM products";
                $products = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

                foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td>$<?php echo htmlspecialchars($product['price']); ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="product_id" value="<?php echo $product['id']; ?>">
                                <input type="number" name="quantity" value="1" min="1" style="width: 60px;">
                        </td>
                        <td>
                                <button type="submit" name="add_to_cart" class="btn btn-primary btn-sm">Add to Cart</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>

        <!-- Checkout Form -->
        <h4>Checkout</h4>
        <form method="POST">
            <div class="mb-3">
                <label for="card_number" class="form-label">Card Number</label>
                <input type="text" class="form-control" id="card_number" name="card_number" placeholder="1234 5678 9012 3456" required>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="expiry_date" class="form-label">Expiry Date</label>
                    <input type="text" class="form-control" id="expiry_date" name="expiry_date" placeholder="MM/YY" required>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="cvv" class="form-label">CVV</label>
                    <input type="text" class="form-control" id="cvv" name="cvv" placeholder="123" required>
                </div>
            </div>
            <button type="submit" name="checkout" class="btn btn-success w-100">Checkout</button>
        </form>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>