<?php
session_start();
include 'connect.php';

$success = '';
$error = '';

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $username = trim($_POST['username']);
    $email = trim($_POST['email']);
    $password = $_POST['password'];
    $confirm = $_POST['confirm_password'];

    if ($username === '' || $email === '' || $password === '') {
        $error = "All fields are required.";
    } elseif ($password !== $confirm) {
        $error = "Passwords do not match.";
    } else {
        // Check if username or email already exists
        $stmt = $pdo->prepare("SELECT * FROM users WHERE username = ? OR email = ?");
        $stmt->execute([$username, $email]);
        $existing = $stmt->fetch();

        if ($existing) {
            if ($existing['username'] === $username) {
                $error = "Username already taken.";
            } elseif ($existing['email'] === $email) {
                $error = "Email already registered.";
            }
        } else {
            // Hash and insert
            $hashed = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO users (username, password, email) VALUES (?, ?, ?)");
            if ($insert->execute([$username, $hashed, $email])) {
                $success = "✅ Registration successful. <a href='login.php'>Log in now</a>.";
            } else {
                $error = "Something went wrong. Please try again.";
            }
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Register | Maik-a-Meal</title>
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

<main class="register-page">
    <h1>Create Your Account</h1>

    <?php if ($success): ?>
        <p class="success-message"><?= $success ?></p>
    <?php elseif ($error): ?>
        <p class="error"><?= htmlspecialchars($error) ?></p>
    <?php endif; ?>

    <form method="POST" action="register.php" class="register-form" autocomplete="off">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required>

        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required>

        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required>

        <label for="confirm_password">Confirm Password:</label>
        <input type="password" id="confirm_password" name="confirm_password" required>

        <button type="submit" class="register-button">Register</button>
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
