<?php
session_start();
include 'connect.php';

$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username'] ?? '');
    $password = trim($_POST['password'] ?? '');

    $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ?");
    $stmt->execute([$username]);
    $user = $stmt->fetch();

    if ($user && password_verify($password, $user['password'])) {
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['username'] = $user['username'];
        header("Location: userhome.php");
        exit;
    } else {
        $error = "Invalid username or password.";
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Login | Maik-a-Meal</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>

<header id="main-header" class="header"> 
    <div class="header-top">
        <div class="logo">
            <img src="Maik--7.png" alt="M-a-M Logo">
        </div>
        <div class="top-right-space">
    <a href="/contact.php" class="book-button">Book a Lesson Today!</a>

    <?php if (isset($_SESSION['user_id'])): ?>
        <span style="color: pink;">🧑‍🍳Logged in as: <?= htmlspecialchars($_SESSION['username']) ?></span>
        <a href="/logout.php" class="login-button">Logout</a>
        <a href="userhome.php" class="nav-button">🍽 My Recipes</a>
    <?php else: ?>
        <a href="/login.php" class="login-button">Login</a>
        <a href="/register.php" class="register-button">Register</a>
    <?php endif; ?>

        </div>
    </div>

    <nav class="main-nav">
        <ul>
            <li><a href="/index.php">Home</a></li> 
            <li><a href="/contact.php">Contact</a></li> 
            <li><a href="/recipes.php">Recipes</a></li> 
        </ul>
    </nav>
</header>

<main class="login-page">
    <h1>Welcome Back!</h1>
    <p>Please log in to manage your recipes.</p>

    <?php if ($error): ?>
        <p class="error"><?php echo htmlspecialchars($error); ?></p>
    <?php endif; ?>

    <form method="POST" action="login.php" class="login-form">
        <label for="username">Username:</label>
        <input type="text" name="username" required>

        <label for="password">Password:</label>
        <input type="password" name="password" required>

        <button type="submit" class="login-button">Login</button>
    </form>
</main>

<footer> 
    <p>&copy; 2025 Maik-a-Meal | <a href="mailto:240134699@aston.ac.uk">Contact Us</a></p>
    <p>Made by Malaika Ahmed 240134699</p>
    <div class="social-links">
        <a href="https://facebook.com" target="_blank">Facebook</a> | 
        <a href="https://instagram.com" target="_blank">Instagram</a> | 
        <a href="https://twitter.com" target="_blank">Twitter</a>
    </div>
</footer>

</body>
</html>
