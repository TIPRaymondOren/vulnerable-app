<?php
session_start(); // Start the session
include 'db.php';
include 'logging.php'; // Include the logging function

// Redirect to login if the user is not an admin
if (!isset($_SESSION['username']) || $_SESSION['role'] !== 'admin') {
    header("Location: login.php");
    exit();
}

// Log page visit
logInteraction($_SESSION['username'], 'ADMIN', "Admin visited the admin page.", 'success');

// Fetch all products
$sql = "SELECT * FROM products";
$products = $conn->query($sql)->fetchAll(PDO::FETCH_ASSOC);

// Handle form submissions
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['add'])) {
        // Add product
        $name = $_POST['name'];
        $price = $_POST['price'];
        $sql = "INSERT INTO products (name, price) VALUES ('$name', '$price')";
        $conn->exec($sql);

        // Log product addition
        logInteraction($_SESSION['username'], 'ADMIN', "Added product: $name, Price: $price", 'success');
        header("Location: admin.php"); // Refresh the page
        exit();
    } elseif (isset($_POST['delete'])) {
        // Delete product
        $id = $_POST['id'];
        $sql = "DELETE FROM products WHERE id='$id'";
        $conn->exec($sql);

        // Log product deletion
        logInteraction($_SESSION['username'], 'ADMIN', "Deleted product with ID: $id", 'success');
        header("Location: admin.php"); // Refresh the page
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - ShopSphere</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #F8F9FA;
        }

        .admin-container {
            background-color: white;
            padding: 2rem;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            max-width: 800px;
            margin: 5rem auto;
        }
    </style>
</head>

<body>
    <div class="admin-container">
        <h2 class="text-center mb-4">Admin Panel</h2>

        <!-- Add Product Form -->
        <form method="POST" class="mb-4">
            <h4>Add Product</h4>
            <div class="mb-3">
                <label for="name" class="form-label">Product Name</label>
                <input type="text" class="form-control" id="name" name="name" required>
            </div>
            <div class="mb-3">
                <label for="price" class="form-label">Price</label>
                <input type="number" class="form-control" id="price" name="price" required>
            </div>
            <button type="submit" name="add" class="btn btn-primary">Add Product</button>
        </form>

        <!-- Product List -->
        <h4>Product List</h4>
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Name</th>
                    <th>Price</th>
                    <th>Action</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($product['id']); ?></td>
                        <td><?php echo htmlspecialchars($product['name']); ?></td>
                        <td>$<?php echo htmlspecialchars($product['price']); ?></td>
                        <td>
                            <form method="POST" style="display:inline;">
                                <input type="hidden" name="id" value="<?php echo $product['id']; ?>">
                                <button type="submit" name="delete" class="btn btn-danger btn-sm">Delete</button>
                            </form>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>