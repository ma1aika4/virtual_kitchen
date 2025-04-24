-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Apr 24, 2025 at 01:34 PM
-- Server version: 8.0.41-0ubuntu0.20.04.1
-- PHP Version: 8.3.20

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `u_240134699_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `recipes`
--

CREATE TABLE `recipes` (
  `rid` int NOT NULL,
  `uid` int NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `description` text COLLATE utf8mb4_unicode_520_ci,
  `type` varchar(50) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `cookingtime` int DEFAULT NULL,
  `ingredients` text COLLATE utf8mb4_unicode_520_ci,
  `instructions` text COLLATE utf8mb4_unicode_520_ci,
  `image` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `recipes`
--

INSERT INTO `recipes` (`rid`, `uid`, `name`, `description`, `type`, `cookingtime`, `ingredients`, `instructions`, `image`) VALUES
(7, 1, 'Creamy Tagliatelle Pasta!', 'A comforting rich and creamy pasta dish, perfect for comfort food lovers.', 'Main', 30, '250g Tagliatelle pasta, 200ml Double cream, 100g Cheddar, 100g Mozzarella, Salt, Black Pepper, Paprika, Chilli Flakes, Oregano, Mixed Spices, Parsley', 'Boil pasta. Warm cream in pan. Add cheese. Mix with pasta. Garnish with parsley.', 'tagliatelle.jpeg'),
(8, 2, 'Chicken Tacos', 'A refreshing take on traditional tacos with soft shell.', 'Snack', 30, '300g Chicken breast, Olive oil, Taco seasoning, Chilli Powder, Tortillas, Lettuce, Salsa, Cheddar cheese', 'Cook chicken with seasoning. Warm tortillas. Fill with toppings.', 'tacos.jpeg'),
(9, 1, 'Nachos', 'Crispy nachos topped with melted cheese and flavorful toppings.', 'Snack', 20, 'Tortilla chips, Cheddar, Mozzarella, Salsa, Chilli Flakes, Paprika, Cumin, Sour Cream, Guacamole', 'Layer chips on tray. Add cheese. Bake. Add toppings and serve.', 'nachos.jpeg'),
(16, 2, 'rr', 'rr', 'Main', 12, 'ff', 'fe', '');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(100) COLLATE utf8mb4_unicode_520_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_520_ci DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_520_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_520_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`) VALUES
(1, 'malaika', 'malaika@maikameal.com', '$2b$12$e13bjuu/uUqnkwcscwq0YOq/6X7LIfF9lct305SThIyjj6uRdCVcm'),
(2, 'user1', 'user1@maikameal.com', '$2y$10$xswBpvRBveTKOfHrRsLgIeb2KXKw5kw1NotASCLvfW/r4hBKcQbWi'),
(3, 'user2', 'user2@maikameal.com', '$2y$10$Eg1uAjVYq6q10vrf88oDa.Quctl1RNpPAM6XlLyWaF9G8DqxWOofe'),
(8, '1', '1@maikameal.com', '$2y$10$teh1Md5U0DP1iFQioz3Ebud/rEjLkaeowZ1/FPtYMdaoIiICivLNK');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `recipes`
--
ALTER TABLE `recipes`
  ADD PRIMARY KEY (`rid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `recipes`
--
ALTER TABLE `recipes`
  MODIFY `rid` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `recipes`
--
ALTER TABLE `recipes`
  ADD CONSTRAINT `recipes_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `users` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
