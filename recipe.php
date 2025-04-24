<?php
include 'connect.php';

if (!isset($_GET['id'])) {
    echo "Recipe ID not provided.";
    exit;
}

$id = $_GET['id'];

$stmt = $pdo->prepare("SELECT * FROM recipes WHERE rid = ?");
$stmt->execute([$id]);
$recipe = $stmt->fetch();

if (!$recipe) {
    echo "Recipe not found.";
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title><?php echo htmlspecialchars($recipe['name']); ?> | Maik-a-Meal</title>
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
        <span style="color: pink;">🧑‍🍳 <?= htmlspecialchars($_SESSION['username']) ?></span>
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

<main>
    <div class="recipe-box">
        <img src="<?= htmlspecialchars($recipe['image']) ?>" alt="Image of <?= htmlspecialchars($recipe['name']) ?>">
        <h1><?= htmlspecialchars($recipe['name']) ?></h1>
        <p><?= htmlspecialchars($recipe['description']) ?></p>

        <h3>Ingredients:</h3>
        <p><?= nl2br(htmlspecialchars($recipe['ingredients'])) ?></p>

        <h3>Instructions:</h3>
        <p><?= nl2br(htmlspecialchars($recipe['instructions'])) ?></p>

        <p><strong>Type:</strong> <?= htmlspecialchars($recipe['type']) ?></p>
        <p><strong>Cooking Time:</strong> <?= htmlspecialchars($recipe['cookingtime']) ?> minutes</p>

        <p><a href="recipes.php" class="back-link">← Back to all recipes</a></p>
    </div>
</main>

<section class="contact-info">
    <h2>Visit Us</h2>
    <p>📍 Maik-a-Meal Cooking Studio</p>
    <p>123 Malaika Road, Birmingham, UK</p>
    <p>☎️ Contact: <a href="tel:+441234567890">+44 123 456 7890</a></p>
    <p>📧 Email: <a href="mailto:240134699@aston.ac.uk">240134699@aston.ac.uk</a></p>
</section>

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
