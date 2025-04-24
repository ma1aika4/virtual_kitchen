<?php
session_start();

include 'connect.php';

// Force login check
if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit;
}

// Enable error reporting (for debugging)
ini_set('display_errors', 1);
error_reporting(E_ALL);

// Handle form submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'] ?? '';
    $description = $_POST['description'] ?? '';
    $type = $_POST['type'] ?? '';
    $cookingTime = $_POST['cookingtime'] ?? null;
    $ingredients = $_POST['ingredients'] ?? '';
    $instructions = $_POST['instructions'] ?? '';
    $imageName = '';

    // Handle file upload
    if (isset($_FILES['image']) && $_FILES['image']['error'] === UPLOAD_ERR_OK) {
        $imageTmp = $_FILES['image']['tmp_name'];
        $imageName = time() . '-' . basename($_FILES['image']['name']); // make it unique
        $targetPath = 'images/' . $imageName;

        if (!move_uploaded_file($imageTmp, $targetPath)) {
            echo "Failed to upload image.";
            exit;
        }
    }

    try {
        // Insert recipe
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

        // Redirect to recipes page
        header("Location: recipes.php");
        exit;

    } catch (PDOException $e) {
        echo "Error adding recipe: " . $e->getMessage();
        exit;
    }
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