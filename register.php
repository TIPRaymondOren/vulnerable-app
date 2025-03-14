<?php
session_start(); // Start the session
include 'db.php';
include 'logging.php'; // Include the logging function
require 'vendor/autoload.php'; // Include PHPMailer

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Log page visit
logInteraction('Guest', 'REGISTER', "User visited the registration page.", 'success');

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['register'])) {
        // Step 1: Collect user data
        $username = $_POST['username'];
        $email = $_POST['email'];
        $password = md5($_POST['password']); // Weak hashing (MD5)

        // Generate a 6-digit OTP
        $otp = rand(100000, 999999);

        // Store OTP and user data in the session
        $_SESSION['otp'] = $otp;
        $_SESSION['temp_user'] = [
            'username' => $username,
            'email' => $email,
            'password' => $password
        ];

        // Send OTP via email
        $mail = new PHPMailer(true);
        try {
            // Server settings
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com'; // Google SMTP server
            $mail->SMTPAuth = true;
            $mail->Username = 'daltonersjohn123@gmail.com'; // Your Gmail address
            $mail->Password = 'lrff spop bwjx cdgi'; // Your Gmail app password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 587;

            // Recipients
            $mail->setFrom('daltonersjohn123@gmail.com', 'ShopSphere');
            $mail->addAddress($email, $username); // Add a recipient

            // Content
            $mail->isHTML(true);
            $mail->Subject = 'Your OTP for ShopSphere Registration';
            $mail->Body = "Your OTP is: <b>$otp</b>";

            $mail->send();
            echo "<div class='alert alert-success text-center'>OTP sent to your email. Please check your inbox.</div>";
        } catch (Exception $e) {
            // Log email sending failure
            logInteraction($username, 'REGISTER', "Failed to send OTP: " . $mail->ErrorInfo, 'failure');
            echo "<div class='alert alert-danger text-center'>Failed to send OTP. Please try again.</div>";
        }
    } elseif (isset($_POST['verify_otp'])) {
        // Step 2: Verify OTP
        $user_otp = $_POST['otp'];

        if ($user_otp == $_SESSION['otp']) {
            // OTP is correct, save user data to the database
            $username = $_SESSION['temp_user']['username'];
            $email = $_SESSION['temp_user']['email'];
            $password = $_SESSION['temp_user']['password'];

            try {
                // Insert user into the database
                $stmt = $conn->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
                $stmt->execute([$username, $password, $email]);

                // Log successful registration
                logInteraction($username, 'REGISTER', "User registered successfully. Username: $username, Email: $email", 'success');

                // Clear session data
                unset($_SESSION['otp']);
                unset($_SESSION['temp_user']);

                // Redirect to login page
                header("Location: login.php");
                exit();
            } catch (PDOException $e) {
                // Log registration failure
                logInteraction($username, 'REGISTER', "Registration failed: " . $e->getMessage(), 'failure');
                echo "<div class='alert alert-danger text-center'>Error: Registration failed. Please try again.</div>";
            }
        } else {
            // Log OTP verification failure
            logInteraction($_SESSION['temp_user']['username'], 'REGISTER', "OTP verification failed.", 'failure');
            echo "<div class='alert alert-danger text-center'>Invalid OTP. Please try again.</div>";
        }
    }
}
?>

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
            overflow: hidden;
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
            min-height: 400px;
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

            <!-- Registration Form -->
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
                <button type="submit" name="register" class="btn btn-primary">Send OTP</button>
            </form>

            <!-- OTP Verification Form -->
            <?php if (isset($_SESSION['otp'])): ?>
                <hr>
                <h4 class="mt-4">Verify OTP</h4>
                <form method="POST">
                    <div class="mb-3">
                        <label for="otp" class="form-label">Enter OTP</label>
                        <input type="text" class="form-control" id="otp" name="otp" required>
                    </div>
                    <button type="submit" name="verify_otp" class="btn btn-primary">Verify OTP</button>
                </form>
            <?php endif; ?>

            <p class="text-center mt-3">Already have an account? <a href="login.php">Login here</a></p>
        </div>
        <div class="image-section"></div>
    </div>
</body>
</html>