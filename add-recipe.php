<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Enable error reporting
ini_set('display_errors', 1);
error_reporting(E_ALL);

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $type = $_POST['type'] ?? '';
    $cookingTime = $_POST['cookingtime'] ?? null;
    $ingredients = $_POST['ingredients'] ?? '';
    $instructions = $_POST['instructions'] ?? '';
    $imageName = '';

    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageName = time() . '-' . basename($_FILES['image']['name']);
        $targetPath = 'images/' . $imageName;

        move_uploaded_file($imageTmp, $targetPath);
    }

    $stmt = $pdo->prepare("INSERT INTO recipes (uid, name, description, type, cookingtime, ingredients, instructions, image)
                           VALUES (?, ?, ?, ?, ?, ?, ?, ?)");
    $stmt->execute([
        $_SESSION['user_id'],
        $name,
        $description,
        $type,
        $cookingTime,
        $ingredients,
        $instructions,
        $imageName
    ]);

    header("Location: user-recipes.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Add Recipe | Maik-a-Meal</title>
    <link rel="stylesheet" href="design.css">
</head>
<body>

<header id="main-header" class="header">
    <div class="header-top">
        <div class="logo">
            <img src="Maik--7.png" alt="M-a-M Logo">
        </div>
        <div class="top-right-space">
            <a href="contact.php" class="book-button">Book a Lesson Today!</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <span style="color: pink;">🧑‍🍳 Logged in as: <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="logout.php" class="login-button">Logout</a>
                <a href="userhome.php" class="nav-button">🍽 My Recipes</a>
            <?php else: ?>
                <a href="login.php" class="login-button">Login</a>
                <a href="register.php" class="register-button">Register</a>
            <?php endif; ?>
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

<main class="add-recipe-page">
    <h1>Add a New Recipe</h1>
    <form action="" method="post" enctype="multipart/form-data" class="recipe-form">
        <label for="name">Recipe Name:</label>
        <input type="text" name="name" id="name" required>

        <label for="description">Short Description:</label>
        <textarea name="description" id="description" required></textarea>

        <label for="type">Recipe Type:</label>
        <select name="type" id="type" required>
            <option value="">--Select Type--</option>
            <option value="Starter">Starter</option>
            <option value="Main">Main</option>
            <option value="Dessert">Dessert</option>
            <option value="Snack">Snack</option>
        </select>

        <label for="cookingtime">Cooking Time (minutes):</label>
        <input type="number" name="cookingtime" id="cookingtime" min="1" required>

        <label for="ingredients">Ingredients:</label>
        <textarea name="ingredients" id="ingredients" required></textarea>

        <label for="instructions">Instructions:</label>
        <textarea name="instructions" id="instructions" required></textarea>

        <label for="image">Upload Image:</label>
        <input type="file" name="image" id="image" accept="image/*">

        <button type="submit" class="submit-button">📤 Submit Recipe</button>
    </form>
</main>

<footer>
    <p>&copy; 2025 Maik-a-Meal | <a href="mailto:240134699@aston.ac.uk">Contact Us</a></p>
    <p>Made by Malaika Ahmed 240134699</p>
</footer>

</body>
</html>
