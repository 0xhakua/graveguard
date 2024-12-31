<?php
session_start();
require 'db_connect.php'; // Database connection

$error = ''; // To store error messages

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    if (isset($_POST['action'])) {
        // Process login
        if ($_POST['action'] === 'login') {
            $username = trim($_POST['username']);
            $password = trim($_POST['password']);

            try {
                $stmt = $conn->prepare("SELECT * FROM account_tbl WHERE account_uname = :username");
                $stmt->bindParam(':username', $username);
                $stmt->execute();

                $user = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($user && $password === $user['account_pword']) {
                    // Successful login
                    $_SESSION['user_id'] = $user['account_id'];
                    $_SESSION['username'] = $user['account_uname'];
                    header("Location: dashboard.php"); // Redirect to dashboard
                    exit();
                } else {
                    $error = "Invalid username or password.";
                }
            } catch (PDOException $e) {
                $error = "Error: " . $e->getMessage();
            }
        }

        // Process registration
        if ($_POST['action'] === 'register') {
            $username = trim($_POST['username']);
            $email = trim($_POST['email']);
            $password = trim($_POST['password']);

            try {
                // Check if username or email already exists
                $stmt = $conn->prepare("SELECT * FROM account_tbl WHERE account_uname = :username OR account_email = :email");
                $stmt->execute(['username' => $username, 'email' => $email]);
                $existingUser = $stmt->fetch(PDO::FETCH_ASSOC);

                if ($existingUser) {
                    $error = "Username or email already exists.";
                } else {
                    // Insert new user
                    $stmt = $conn->prepare("INSERT INTO account_tbl (account_uname, account_email, account_pword) VALUES (:username, :email, :password)");
                    $stmt->execute(['username' => $username, 'email' => $email, 'password' => $password]);
                    header("Location: login.php"); // Redirect to login
                    exit();
                }
            } catch (PDOException $e) {
                $error = "Error: " . $e->getMessage();
            }
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>GraveGuard</title>
    <link href="https://unpkg.com/boxicons@2.1.4/css/boxicons.min.css" rel="stylesheet">
    <link rel="stylesheet" href="css/style.css">

    <style>
        body{
    display: flex;
    justify-content: center;
    align-items: center;
    min-height: 100vh;
    background: white;
}
    </style>
</head>
<body>
    
    <div class="container">
        <?php if ($error): ?>
            <div class="error"><?= htmlspecialchars($error) ?></div>
        <?php endif; ?>

        <div class="form-box login">
            <form method="POST" action="">
                <h1>Login</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <input type="hidden" name="action" value="login">
                <div class="forgot-link">
                    <a href="#">Forgot password?</a>
                </div>
                <button type="submit" class="btn">Login</button>
            </form>
        </div>

        <div class="form-box register">
            <form method="POST" action="">
                <h1>Registration</h1>
                <div class="input-box">
                    <input type="text" name="username" placeholder="Username" required>
                    <i class="bx bxs-user"></i>
                </div>
                <div class="input-box">
                    <input type="email" name="email" placeholder="Email" required>
                    <i class="bx bxs-envelope"></i>
                </div>
                <div class="input-box">
                    <input type="password" name="password" placeholder="Password" required>
                    <i class="bx bxs-lock-alt"></i>
                </div>
                <input type="hidden" name="action" value="register">
                <button type="submit" class="btn">Register</button>
            </form>
        </div>

        <div class="toggle-box">
            <div class="toggle-panel toggle-left">
                <h1>Hello, Welcome!</h1>
                <p>Don't have an Account?</p>
                <button class="btn register-btn">Register</button>
            </div>
            <div class="toggle-panel toggle-right">
                <h1>Welcome Back!</h1>
                <p>Already have an Account?</p>
                <button class="btn login-btn">Login</button>
            </div>
        </div>
    </div>

    <script src="script.js"></script>
</body>
</html>
