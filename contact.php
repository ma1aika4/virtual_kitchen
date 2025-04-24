<?php
session_start();
?>

<?php
// Simple visual feedback (no actual email sending)
$sent = false;
if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $sent = true;
}
?>

<!DOCTYPE html> 
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Maik-a-Meal | Contact</title>
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
    <h1>Contact Us</h1>

    <?php if ($sent): ?>
        <p class="success-message">✅ Your form was submitted successfully!</p>
    <?php endif; ?>

    <div class="Chef">
        <img src="Hannah-2.png" alt="Chef-pic">
        <p>Fill out the form to get in touch!</p>
    </div>

    <form id="contact-form" action="contact.php" method="POST">
        <!-- Select email or phone -->
        <label for="contact-method">Preferred Contact Method:</label>
        <select id="contact-method" name="contact-method" required>
            <option value="" disabled selected>Please select phone or email</option>
            <option value="email">Email</option>
            <option value="phone">Phone</option>
        </select>

        <!-- Email -->
        <label for="email">Email (must be @aston.ac.uk):</label>
        <input type="email" id="email" name="email" required placeholder="yourname@aston.ac.uk">

        <!-- Confirm Email -->
        <label for="confirm-email">Confirm Email:</label>
        <input type="email" id="confirm-email" name="confirm-email" required placeholder="Re-enter email">

        <!-- Phone -->
        <label for="phone">Phone Number:</label>
        <input type="tel" id="phone" name="phone" placeholder="Enter phone number">

        <!-- Appointment Date -->
        <label for="appointment-date">Select Appointment Date:</label>
        <input type="date" id="appointment-date" name="appointment-date" required>

        <button type="submit">Submit</button>
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

<script src="script.js"></script>
</body>
</html>
