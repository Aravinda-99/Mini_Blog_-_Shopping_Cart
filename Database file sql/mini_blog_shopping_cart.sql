-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3307
-- Generation Time: May 07, 2025 at 10:15 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `mini_blog_shopping_cart`
--

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `product_id`, `quantity`) VALUES
(9, 11, 1, 1),
(10, 11, 2, 1),
(11, 11, 3, 1),
(12, 11, 4, 1),
(13, 11, 5, 1),
(14, 11, 6, 1),
(15, 14, 1, 1),
(16, 14, 2, 1),
(17, 14, 3, 1),
(18, 14, 4, 1),
(19, 14, 5, 1),
(20, 14, 6, 1),
(21, 15, 1, 1),
(22, 15, 2, 1),
(23, 15, 3, 1),
(24, 15, 4, 1),
(25, 15, 5, 1),
(26, 15, 6, 1);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `total_amount` decimal(10,2) NOT NULL,
  `status` varchar(20) NOT NULL DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `total_amount`, `status`, `created_at`) VALUES
(1, 11, 31445.00, 'pending', '2025-05-07 05:30:50');

-- --------------------------------------------------------

--
-- Table structure for table `order_items`
--

CREATE TABLE `order_items` (
  `id` int(11) NOT NULL,
  `order_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) NOT NULL,
  `price` decimal(10,2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `order_items`
--

INSERT INTO `order_items` (`id`, `order_id`, `product_id`, `quantity`, `price`) VALUES
(1, 1, 1, 7, 1800.00),
(2, 1, 2, 2, 1800.00),
(3, 1, 4, 3, 1900.00),
(4, 1, 5, 1, 1595.00),
(5, 1, 6, 1, 5500.00),
(6, 1, 3, 1, 2450.00);

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `content`, `created_at`) VALUES
(2, 11, 'Creating a Responsive Navigation Bar in React with Bootstrap', 'A step-by-step tutorial on building a fully responsive and mobile-friendly navbar using Bootstrap classes in React.', '2025-05-06 16:04:53'),
(5, 11, 'React vs. React-Bootstrap: Which One Should You Use?', 'We compare vanilla Bootstrap with the React-Bootstrap library to help you decide which fits your project best.', '2025-05-06 18:16:53'),
(6, 11, 'Getting Started with Bootstrap in React: A Beginner\'s Guide', 'Learn how to integrate Bootstrap into your React app and create clean, responsive layouts with minimal effort.', '2025-05-06 18:17:02'),
(7, 11, 'Customizing Bootstrap Themes in React: A Quick Guide', 'Learn how to override Bootstrap styles in React using custom CSS, Sass, or CSS variables.', '2025-05-06 22:18:44'),
(8, 11, 'Building a Landing Page in React with Bootstrap 5.', 'Follow along as we design and build a modern, responsive landing page using only React and Bootstrap.', '2025-05-06 22:19:15'),
(9, 14, 'How to Combine Bootstrap and React Hooks for Interactive UI', 'Discover how to pair Bootstrap components with React hooks like useState and useEffect for dynamic and reactive interfaces.', '2025-05-07 13:14:24');

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL COMMENT 'Unique product ID',
  `name` varchar(150) NOT NULL COMMENT 'Name of the product',
  `price` float(10,2) NOT NULL COMMENT 'Price ',
  `image` varchar(255) NOT NULL COMMENT 'product img'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(1, 'Gold Zipper On Black Fashion Backpack', 1800.00, 'images/prod_681a51bd1aa916.51126980.jpg'),
(2, 'A blank blue t-shirt', 1800.00, 'images/prod_681a56cbe35fd1.60808010.jpg'),
(3, 'Wood Leather Watches', 2450.00, 'images/prod_681a57f1960128.51425726.jpg'),
(4, 'Wireless Headphones', 1900.00, 'images/prod_681a5825df8d53.07977064.jpg'),
(5, 'Stacked Bracelets Set', 1595.00, 'images/prod_681a5888240fb5.93641162.jpg'),
(6, 'black sneakers with white sole', 5500.00, 'images/prod_681a58e94353f5.53621197.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(50) NOT NULL COMMENT 'Unique user ID',
  `name` varchar(100) NOT NULL COMMENT 'User’s name',
  `email` varchar(150) NOT NULL COMMENT 'User’s email',
  `password` varchar(255) NOT NULL COMMENT 'Hashed password\r\nHashed password\r\nHashed password\r\n'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`) VALUES
(11, 'Viraj', 'viraj@gmail.com', '$2y$10$ipzRnC.jVoiEYcRFwvH2E./zd8i4SmxxoG9DKwjqL7sNcZA7e1U6G'),
(14, 'chathula', 'chathula@gmail.com', '$2y$10$s07smDNxvylc5lLtjU8p..oTzQiuxwavZhc7jFWtTXQhoKUNJeoai'),
(15, 'anjana', 'anjana@gmail.com', '$2y$10$ucETgyvNXBs3MDEstb02bumu.Tl6Q3jE/R47kbFVJbeP44sJY5.oy');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `user_id_2` (`user_id`,`product_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_items`
--
ALTER TABLE `order_items`
  ADD PRIMARY KEY (`id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `product_id` (`product_id`);

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `idx_email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `order_items`
--
ALTER TABLE `order_items`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Unique product ID', AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT COMMENT 'Unique user ID', AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `cart_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `cart_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `order_items`
--
ALTER TABLE `order_items`
  ADD CONSTRAINT `order_items_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`id`),
  ADD CONSTRAINT `order_items_ibfk_2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`);

--
-- Constraints for table `posts`
--
ALTER TABLE `posts`
  ADD CONSTRAINT `posts_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
