<?php
session_start();
include 'connect.php';

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

$recipeId = $_GET['id'] ?? null;

// Fetch the recipe that belongs to the logged-in user
$stmt = $pdo->prepare("SELECT * FROM recipes WHERE rid = ? AND uid = ?");
$stmt->execute([$recipeId, $_SESSION['user_id']]);
$recipe = $stmt->fetch();

if (!$recipe) {
    echo "Recipe not found or access denied.";
    exit;
}

// If form submitted, update the recipe
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $description = $_POST['description'];
    $type = $_POST['type'];
    $cookingTime = $_POST['cookingtime'];
    $ingredients = $_POST['ingredients'];
    $instructions = $_POST['instructions'];
    $imageName = $recipe['image']; // Keep existing image if no new one uploaded

    // Handle new image upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageName = time() . '-' . basename($_FILES['image']['name']);
        move_uploaded_file($imageTmp, 'images/' . $imageName);
    }

    $update = $pdo->prepare("UPDATE recipes SET name=?, description=?, type=?, cookingtime=?, ingredients=?, instructions=?, image=? WHERE rid=? AND uid=?");
    $update->execute([$name, $description, $type, $cookingTime, $ingredients, $instructions, $imageName, $recipeId, $_SESSION['user_id']]);

    header("Location: myrecipes.php");
    exit;
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Edit Recipe</title>
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


<main class="edit-recipe-page">
    <h1>Edit Your Recipe</h1>
    <form method="POST" enctype="multipart/form-data" class="recipe-form">
        <label for="name">Recipe Name:</label>
        <input type="text" name="name" value="<?= htmlspecialchars($recipe['name']) ?>" required>

        <label for="description">Description:</label>
        <textarea name="description" required><?= htmlspecialchars($recipe['description']) ?></textarea>

        <label for="type">Type:</label>
        <select name="type" required>
            <option value="Starter" <?= $recipe['type'] === 'Starter' ? 'selected' : '' ?>>Starter</option>
            <option value="Main" <?= $recipe['type'] === 'Main' ? 'selected' : '' ?>>Main</option>
            <option value="Dessert" <?= $recipe['type'] === 'Dessert' ? 'selected' : '' ?>>Dessert</option>
            <option value="Snack" <?= $recipe['type'] === 'Snack' ? 'selected' : '' ?>>Snack</option>
        </select>

        <label for="cookingtime">Cooking Time:</label>
        <input type="number" name="cookingtime" value="<?= $recipe['cookingtime'] ?>" required>

        <label for="ingredients">Ingredients:</label>
        <textarea name="ingredients" required><?= htmlspecialchars($recipe['ingredients']) ?></textarea>

        <label for="instructions">Instructions:</label>
        <textarea name="instructions" required><?= htmlspecialchars($recipe['instructions']) ?></textarea>

        <label>Current Image:</label><br>
        <img src="images/<?= htmlspecialchars($recipe['image']) ?>" width="200" alt="Current Recipe Image"><br><br>

        <label for="image">Change Image (optional):</label>
        <input type="file" name="image" accept="image/*">

        <button type="submit" class="submit-button">✏️ Update Recipe</button>
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
