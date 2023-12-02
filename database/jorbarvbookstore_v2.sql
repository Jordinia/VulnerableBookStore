-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 02, 2023 at 09:49 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `jorbarvbookstore`
--

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `book_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(100) NOT NULL,
  `description` text DEFAULT NULL,
  `price` decimal(10,2) NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `publication_year` int(11) DEFAULT NULL,
  `isbn` varchar(13) DEFAULT NULL,
  `language` varchar(50) DEFAULT NULL,
  `stock_quantity` int(11) NOT NULL DEFAULT 0,
  `cover_image_url` varchar(255) DEFAULT NULL,
  `average_rating` decimal(3,2) DEFAULT NULL,
  `num_ratings` int(11) DEFAULT 0,
  `publisher` varchar(100) DEFAULT NULL,
  `date_added` timestamp NOT NULL DEFAULT current_timestamp(),
  `is_featured` tinyint(1) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`book_id`, `title`, `author`, `description`, `price`, `category_id`, `publication_year`, `isbn`, `language`, `stock_quantity`, `cover_image_url`, `average_rating`, `num_ratings`, `publisher`, `date_added`, `is_featured`) VALUES
(6, 'The Secret Garden', 'Frances Hodgson Burnett', 'A classic children\'s novel about a magical garden.', 19.99, 1, 1911, '9780143106451', 'English', 50, 'https://m.media-amazon.com/images/I/91qOXqI3aQL._AC_UF1000,1000_QL80_.jpg', 4.50, 120, 'Penguin Classics', '2023-12-01 03:02:11', 1),
(7, 'The Hitchhiker\'s Guide to the Galaxy', 'Douglas Adams', 'A comedic science fiction series about an unwitting human and his alien friend.', 24.99, 2, 1979, '9780345391803', 'English', 30, 'https://i.guim.co.uk/img/static/sys-images/Guardian/Pix/pictures/2015/6/25/1435245979235/047c9878-9845-473c-9635-5f32545746b0-1355x2040.jpeg?width=700&quality=85&auto=format&fit=max&s=606433bda33c8c27c5ebd7ba85900473', 4.80, 200, 'Del Rey Books', '2023-12-01 03:02:11', 1),
(8, 'To Kill a Mockingbird', 'Harper Lee', 'A powerful novel dealing with racial injustice and moral growth in the American South.', 29.99, 3, 1960, '9780061120084', 'English', 40, 'https://upload.wikimedia.org/wikipedia/commons/4/4f/To_Kill_a_Mockingbird_%28first_edition_cover%29.jpg', 4.70, 150, 'Harper Perennial Modern Classics', '2023-12-01 03:02:11', 0),
(9, 'The Great Gatsby', 'F. Scott Fitzgerald', 'A story of the Roaring Twenties, love, and the American Dream.', 22.99, 4, 1925, '9780743273565', 'English', 35, 'https://m.media-amazon.com/images/I/71FTb9X6wsL._AC_UF1000,1000_QL80_.jpg', 4.60, 180, 'Scribner', '2023-12-01 03:02:11', 0),
(10, '1984', 'George Orwell', 'A dystopian novel exploring the dangers of totalitarianism and surveillance.', 27.99, 5, 1949, '9780451524935', 'English', 25, 'https://m.media-amazon.com/images/I/61NAx5pd6XL._AC_UF1000,1000_QL80_.jpg', 4.90, 220, 'Signet Classics', '2023-12-01 03:02:11', 1);

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(11) NOT NULL,
  `category_name` varchar(50) NOT NULL,
  `description` text DEFAULT NULL,
  `parent_category_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `description`, `parent_category_id`) VALUES
(1, 'Fiction', 'Books that tell imaginative stories and are not based on real events.', NULL),
(2, 'Science Fiction', 'Books that explore speculative or futuristic concepts, often involving technology or space.', NULL),
(3, 'Classic', 'Books that have stood the test of time and are considered exemplary in their genre.', NULL),
(4, 'Literary Fiction', 'Books with a focus on the quality and style of writing, often exploring deeper human experiences.', NULL),
(5, 'Dystopian', 'Books that depict a society characterized by oppression, suffering, and often a loss of individual freedoms.', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `order_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `order_date` timestamp NOT NULL DEFAULT current_timestamp(),
  `total_amount` decimal(10,2) NOT NULL,
  `status` enum('Pending','Processing','Shipped','Delivered') DEFAULT 'Pending',
  `shipping_address` varchar(255) DEFAULT NULL,
  `payment_method` varchar(50) DEFAULT NULL,
  `tracking_number` varchar(20) DEFAULT NULL,
  `notes` text DEFAULT NULL,
  `cancelled_date` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `order_details`
--

CREATE TABLE `order_details` (
  `order_detail_id` int(11) NOT NULL,
  `order_id` int(11) DEFAULT NULL,
  `book_id` int(11) DEFAULT NULL,
  `quantity` int(11) NOT NULL,
  `subtotal` decimal(10,2) NOT NULL,
  `discount` decimal(5,2) DEFAULT 0.00,
  `tax` decimal(5,2) DEFAULT 0.00,
  `promo_code` varchar(20) DEFAULT NULL,
  `shipping_cost` decimal(5,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  `date_of_birth` date NOT NULL,
  `payment_card_number` varchar(16) DEFAULT NULL,
  `card_expiry_date` varchar(10) DEFAULT NULL,
  `card_cvv` int(11) DEFAULT NULL,
  `role` enum('user','admin') NOT NULL DEFAULT 'user',
  `registration_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`, `date_of_birth`, `payment_card_number`, `card_expiry_date`, `card_cvv`, `role`, `registration_date`) VALUES
(6, 'Admin', 'rizki@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2003-07-25', '4172758581931', '1/2024', 766, 'admin', '2023-11-30 21:02:00'),
(7, 'Rizki', 'rizki@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2003-07-25', '4172758581931', '1/2024', 766, 'user', '2023-11-30 21:02:00'),
(8, 'Jordhie', 'jordhie@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2003-07-25', '4243100513300', '5/2022', 284, 'user', '2023-11-30 21:02:00'),
(9, 'Rayhan', 'rayhan@gmail.com', '1e01ba3e07ac48cbdab2d3284d1dd0fa', '1995-03-10', '4172777359087', '8/2025', 707, 'user', '2023-11-30 21:02:00'),
(10, 'Akbar', 'akbar@gmail.com', '1e01ba3e07ac48cbdab2d3284d1dd0fa', '1988-11-05', '4172756255223', '11/2021', 170, 'user', '2023-11-30 21:02:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`book_id`),
  ADD KEY `category_id` (`category_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`),
  ADD KEY `parent_category_id` (`parent_category_id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`order_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `order_details`
--
ALTER TABLE `order_details`
  ADD PRIMARY KEY (`order_detail_id`),
  ADD KEY `order_id` (`order_id`),
  ADD KEY `book_id` (`book_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `book_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `order_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `order_details`
--
ALTER TABLE `order_details`
  MODIFY `order_detail_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `books`
--
ALTER TABLE `books`
  ADD CONSTRAINT `books_ibfk_1` FOREIGN KEY (`category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `categories`
--
ALTER TABLE `categories`
  ADD CONSTRAINT `categories_ibfk_1` FOREIGN KEY (`parent_category_id`) REFERENCES `categories` (`category_id`);

--
-- Constraints for table `orders`
--
ALTER TABLE `orders`
  ADD CONSTRAINT `orders_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`);

--
-- Constraints for table `order_details`
--
ALTER TABLE `order_details`
  ADD CONSTRAINT `order_details_ibfk_1` FOREIGN KEY (`order_id`) REFERENCES `orders` (`order_id`),
  ADD CONSTRAINT `order_details_ibfk_2` FOREIGN KEY (`book_id`) REFERENCES `books` (`book_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
