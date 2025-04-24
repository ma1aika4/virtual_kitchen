<?php
session_start();
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Welcome | Maik-a-Meal</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>

<header id="main-header" class="header">
    <div class="header-top">
        <div class="logo">
            <img src="Maik--7.png" alt="Maik-a-Meal Logo">
        </div>
        <div class="top-right-space">
            <span style="color: pink;">🧑‍🍳 Logged in as: <?= htmlspecialchars($_SESSION['username']) ?></span>
            <a href="logout.php" class="login-button">Logout</a>
        </div>
    </div>
    <nav class="main-nav">
        <ul>
            <li><a href="index.php">Home</a></li> 
            <li><a href="contact.php">Contact</a></li> 
            <li><a href="recipes.php">Recipes</a></li> 
        </ul>
    </nav>
</header>

<main class="dashboard">
    <h1>Welcome back, <?= htmlspecialchars($_SESSION['username']) ?>!</h1>
    <div class="dashboard-buttons">
        <a href="add-recipe.php" class="dashboard-button">➕ Create New Recipe</a>
        <a href="user-recipes.php" class="dashboard-button">✏️ View and Edit My Recipes</a> <!-- Optional: list of your recipes with edit links -->
    </div>
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
