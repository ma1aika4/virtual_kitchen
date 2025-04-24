<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$userId = $_SESSION['user_id'];
$search = $_GET['search'] ?? '';

// Get recipes belonging only to the logged-in user
if ($search) {
    $stmt = $pdo->prepare("
        SELECT recipes.*, users.username 
        FROM recipes 
        JOIN users ON recipes.uid = users.id 
        WHERE recipes.uid = ? 
          AND (
            recipes.name LIKE ? OR 
            recipes.type LIKE ? OR 
            recipes.ingredients LIKE ?
          )
    ");
    $stmt->execute([$userId, "%$search%", "%$search%", "%$search%"]);
} else {
    $stmt = $pdo->prepare("
        SELECT recipes.*, users.username 
        FROM recipes 
        JOIN users ON recipes.uid = users.id 
        WHERE recipes.uid = ?
    ");
    $stmt->execute([$userId]);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>My Recipes | Maik-a-Meal</title>
    <!-- absolute path ensures it always finds the stylesheet -->
    <link rel="stylesheet" href="/design.css">
</head>
<body>

<header id="main-header" class="header"> 
    <div class="header-top">
        <div class="logo">
            <!-- leading slash so logo always loads -->
            <img src="/Maik--7.png" alt="M-a-M Logo">
        </div>
        <div class="top-right-space">
            <a href="/contact.php" class="book-button">Book a Lesson Today!</a>
            <?php if (isset($_SESSION['user_id'])): ?>
                <span style="color: pink;">🧑‍🍳 Logged in as: <?= htmlspecialchars($_SESSION['username']) ?></span>
                <a href="/logout.php" class="login-button">Logout</a>
                <a href="/user-recipes.php" class="nav-button">🍽 My Recipes</a>
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
            <li><a href="/recipes.php">All Recipes</a></li> 
        </ul>
    </nav>
</header>

<main id="recipes-page">
    <h1 style="text-align: center;">My Recipes</h1>

    <form method="GET" action="/user-recipes.php" class="search-form" style="text-align: center;">
        <input 
            type="text" 
            name="search" 
            placeholder="Search your recipes..." 
            value="<?= htmlspecialchars($search) ?>"
        >
        <button type="submit">Search</button>
    </form>

    <div class="recipe-container">
        <?php if ($stmt->rowCount() > 0): ?>
            <?php while ($row = $stmt->fetch()): ?>
                <div class="recipe-box">
                    <img 
                      src="/images/<?= htmlspecialchars($row['image']) ?>" 
                      alt="Image of <?= htmlspecialchars($row['name']) ?>" 
                      onerror="this.src='/images/default.jpg';"
                    >
                    <h2 class="title"><?= htmlspecialchars($row['name']) ?></h2>
                    <p class="description"><?= htmlspecialchars($row['description']) ?></p>
                    <p class="owner-name">
                      <strong>By:</strong> <?= htmlspecialchars($row['username']) ?>
                    </p>

                    <a href="/recipe.php?id=<?= $row['rid'] ?>" class="view-button">👀 View Recipe</a>
                    <a href="/edit-recipe.php?id=<?= $row['rid'] ?>" class="edit-button">✏️ Edit</a>
                    <a 
                      href="/delete-recipe.php?id=<?= $row['rid'] ?>" 
                      class="delete-button" 
                      onclick="return confirm('Are you sure you want to delete this recipe?');"
                    >🗑 Delete</a>
                </div>
            <?php endwhile; ?>
        <?php else: ?>
            <p style="text-align:center;">
              You haven’t added any recipes yet. 
              <a href="/add_recipe.php">Add one now!</a>
            </p>
        <?php endif; ?>
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
