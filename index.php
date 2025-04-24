<?php
session_start();
?>


<!DOCTYPE html> 
<html lang="en">
    
<head>
   
    <link rel="stylesheet" type="text/css" href="design.css"> <!--same folder-->
    <meta charset="UTF-8">
    <title> Maik-a-Meal </title>
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
   
    <div class="welcome-section">
        <img src="Hannah.png" alt="Cooking with Maik-a-Meal" class="welcome-img">
        <p> We tailor step-by-step recipes inspired by Italian cuisine.
            To help you get started on your cooking journey, we also offer one-to-one cooking 
            lessons to help you reach your culinary goals and prepare dishes with ease.
        </p>
    </div>
</main>


<section class="testimonial">
    <blockquote> 
        "Good food, good mood!"  
    </blockquote>
    <blockquote> 
        "The secret Ingredient is always love"
    </blockquote>
</section>



<section class="featured-recipes">
    <h2>Popular Recipes</h2>
    <div class="recipe-container">

        <div class="recipe-box">
            <img src="tagliatelle.jpeg" alt="Creamy Tagliatelle Pasta">
            <h3>Creamy Tagliatelle Pasta</h3>
            <p>A rich and creamy pasta dish perfect for comfort food lovers.</p>
            <a href="recipes.php" class="recipe-link">View Recipe</a>
        </div>

        <div class="recipe-box">
            <img src="nachos.jpeg" alt="Cheesy Nachos">
            <h3>Cheesy Nachos</h3>
            <p>Crispy nachos topped with melted cheese and flavorful toppings.</p>
            <a href="recipes.php" class="recipe-link">View Recipe</a>
        </div>

        <div class="recipe-box">
            <img src="tacos.jpeg" alt="Chicken Tacos">
            <h3>Chicken Tacos</h3>
            <p>Soft shell tacos with a deliciously spiced chicken filling.</p>
            <a href="recipes.php" class="recipe-link">View Recipe</a>
        </div>
    </div>
</section>


<section class="contact-info">
    <h2>Visit Us</h2>
    <p>📍 Maik-a-Meal Cooking Studio</p>
    <p>123 Malaika Road, Birmingham, UK</p>
    <p>☎️ Contact: <a href="tel:+441234567890">+44 123 456 7890</a></p>
    <p>📧 Email: <a href="mailto:240134699@aston.ac.uk">240134699@aston.ac.uk</a></p>
</section>


<footer> 
    <p>&copy; 2025 Maik-a-Meal | <a href="mailto:240134699@aston.ac.uk">Contact Us</a></p>
    <p> Made by Malaika Ahmed 240134699</p>
    <div class="social-links">
        <a href="https://facebook.com" target="_blank">Facebook</a> | 
        <a href="https://instagram.com" target="_blank">Instagram</a> | 
        <a href="https://twitter.com" target="_blank">Twitter</a>
    </div>
</footer>

</body>
</html>

 









