<?php
// public/login.php
session_start();
require_once __DIR__ . '/../src/Models/User.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userModel = new User();
    $user = $userModel->login($_POST['email'], $_POST['password']);

    if ($user) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        $_SESSION['role'] = $user['role'];

        if ($user['role'] === 'admin') {
            header("Location: admin_dashboard.php");
        } else {
            header("Location: student_dashboard.php");
        }
        exit();
    } else {
        $error = "Invalid email or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library LMS - Login</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="auth-container">
        <form method="POST" class="auth-form">
            <h2>Library Login</h2>
            <?php if(isset($_GET['success'])): ?> <p class="success">Registration successful! Please login.</p> <?php endif; ?>
            <?php if($error): ?> <p class="error"><?php echo htmlspecialchars($error); ?></p> <?php endif; ?>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <button type="submit">Login</button>
            <p>Don't have an account? <a href="register.php">Register here</a></p>
        </form>
    </div>
</body>
</html>
