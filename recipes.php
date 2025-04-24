<?php
session_start();
?>

<?php include 'connect.php'; ?>
<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maik-a-Meal | Recipes</title>
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

<main id="recipes-page">
    <div class="Recipe-pic">
        <img src="Recipespic.png" alt="Recipe Illustration">
    </div>

    <form method="GET" action="recipes.php" class="search-form">
    <input type="text" name="search" placeholder="Search recipes..." value="<?php echo htmlspecialchars($_GET['search'] ?? ''); ?>">
    <button type="submit">Search</button>
</form>


    <div class="recipe-container">

        <?php
   
   $search = $_GET['search'] ?? '';

   if ($search) {
    $stmt = $pdo->prepare("SELECT recipes.*, users.username 
    FROM recipes 
    JOIN users ON recipes.uid = users.id 
    WHERE recipes.name LIKE ? 
       OR recipes.type LIKE ?
       OR recipes.ingredients LIKE ?");
$stmt->execute(["%$search%", "%$search%", "%$search%"]);

   } else {
       $stmt = $pdo->query("SELECT recipes.*, users.username 
                            FROM recipes 
                            JOIN users ON recipes.uid = users.id");
   }
   
   


        if ($stmt->rowCount() > 0) {
            while ($row = $stmt->fetch()) {

                echo '<div class="recipe-box">';
                echo '<img src="' . htmlspecialchars($row["image"]) . '" alt="Image of ' . htmlspecialchars($row["name"]) . '" onerror="this.src=\'default.jpg\'">';
                echo '<h2 class="title">' . htmlspecialchars($row["name"]) . '</h2>';
                echo '<p class="description">' . htmlspecialchars($row["description"]) . '</p>';
                echo '<p class="owner-name"><strong>By:</strong> ' . htmlspecialchars($row["username"]) . '</p>';
                echo '<a href="recipe.php?id=' . $row["rid"] . '">View Full Recipe</a>';
                
                // ✅ Show edit button only if logged in and it's their recipe
                if (isset($_SESSION['user_id']) && $_SESSION['user_id'] == $row['uid']) {
                    echo '<a href="edit-recipe.php?id=' . $row["rid"] . '" class="edit-button">✏️ Edit</a>';
                }
                
                echo '</div>';
                


            }
        } else {
            echo '<p>No recipes available right now. Please check back later!</p>';
        }
        ?>
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

<script src="script.js"></script>
</body>
</html>

