<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register - ShopSphere</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            display: flex;
            height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #c2e9fb, #a1c4fd);
            justify-content: center;
            align-items: center;
        }
        .container {
            display: flex;
            padding: 0px;
            width:100%;
            max-width: 1000px;
            background: white;
            border-radius: 15px;
            box-shadow: 0px 4px 10px rgba(0, 0, 0, 0.1);
            overflow: hidden; /* Ensures the rounded corners apply */
        }
        .form-section {
            flex: 1;
            padding: 2rem;
        }
        .image-section {
            flex: 1;
            background: url('assets/reg.jpg') center/cover no-repeat;
            border-top-right-radius: 15px;
            border-bottom-right-radius: 15px;
            min-height: 400px; /* Ensures it has enough space */
        }

 

        .form-control {
            border-radius: 8px;
        }
        .btn-primary {
            width: 100%;
            border-radius: 8px;
        }
        .brand {
            display: flex;
            align-items: center;
            font-weight: bold;
        }
        .brand img {
            width: 30px;
            margin-right: 10px;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="form-section">
            <div class="brand mb-3">
                <img src="https://img.icons8.com/ios/50/000000/shop.png" alt="logo">
                <span>ShopSphere</span>
            </div>
            <h2 class="mb-3">Create Your Account</h2>
            <p class="text-muted">Join us today and explore amazing deals!</p>
            <form method="POST">
                <div class="mb-3">
                    <label for="username" class="form-label">Username</label>
                    <input type="text" class="form-control" id="username" name="username" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" class="form-control" id="email" name="email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input type="password" class="form-control" id="password" name="password" required>
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
            </form>
            <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
        </div>
        <div class="image-section"></div>
    </div>
</body>
</html>
