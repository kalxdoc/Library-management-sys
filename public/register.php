<?php
// public/register.php
session_start();
require_once __DIR__ . '/../src/Models/User.php';

$error = '';
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $userModel = new User();
    $username = $_POST['username'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $role = $_POST['role'] ?? 'student';

    if ($userModel->register($username, $email, $password, $role)) {
        header("Location: login.php?success=1");
        exit();
    } else {
        $error = "Registration failed. Email or Username might already exist.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Library LMS - Register</title>
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <div class="auth-container">
        <form method="POST" class="auth-form">
            <h2>Create Account</h2>
            <?php if($error): ?> <p class="error"><?php echo htmlspecialchars($error); ?></p> <?php endif; ?>
            <input type="text" name="username" placeholder="Username" required>
            <input type="email" name="email" placeholder="Email Address" required>
            <input type="password" name="password" placeholder="Password" required>
            <select name="role">
                <option value="student">Student</option>
                <option value="admin">Administrator</option>
            </select>
            <button type="submit">Register</button>
            <p>Already have an account? <a href="login.php">Login here</a></p>
        </form>
    </div>
</body>
</html>
