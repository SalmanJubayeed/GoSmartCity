-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
-- Server version: 11.4.9-MariaDB
-- PHP Version: 7.2.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `gosmartcity`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `rental_id` int(11) NOT NULL,
  `owner_id` int(11) NOT NULL,
  `user_name` varchar(255) NOT NULL,
  `user_phone` varchar(20) NOT NULL,
  `user_email` varchar(255) DEFAULT NULL,
  `status` enum('Pending','Approved','Rejected') NOT NULL DEFAULT 'Pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `rental_id`, `owner_id`, `user_name`, `user_phone`, `user_email`, `status`, `created_at`) VALUES
(1, 1, 5, 'Rocky', '01631634508', NULL, 'Approved', '2025-03-17 16:31:57'),
(4, 2, 8, 'Thiery', '015237267936', 'henry@gmail.com', 'Approved', '2025-03-19 17:09:28'),
(6, 3, 5, 'abc', '01235498123', 'abc@gmail.com', 'Pending', '2025-03-20 13:55:13'),
(7, 3, 5, 's', '01345276931', 'sj@gmail.com', 'Pending', '2025-04-28 19:11:25'),
(8, 3, 5, 'Tanbir', '0631634508', 'tanbir@gmail.com', 'Pending', '2025-04-30 15:55:25'),
(9, 4, 11, 'Musfek', '01314157708', 'musfek@gmail.com', 'Pending', '2025-05-05 11:49:00');

-- --------------------------------------------------------

--
-- Table structure for table `rentals`
--

CREATE TABLE `rentals` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `rental_type` enum('Family','Bachelor') NOT NULL,
  `location` enum('Chawk Bazar','Bakalia','Jamal Khan') NOT NULL,
  `floor` enum('Ground Floor','1st Floor','2nd Floor') NOT NULL,
  `bedrooms` int(11) NOT NULL,
  `bathrooms` int(11) NOT NULL,
  `gas_type` enum('Gas Meter','Gas Cylinder') NOT NULL,
  `monthly_rent` decimal(10,2) NOT NULL,
  `features` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `rentals`
--

INSERT INTO `rentals` (`id`, `user_id`, `rental_type`, `location`, `floor`, `bedrooms`, `bathrooms`, `gas_type`, `monthly_rent`, `features`, `created_at`) VALUES
(1, 5, 'Bachelor', 'Chawk Bazar', 'Ground Floor', 2, 2, 'Gas Cylinder', '22000.00', '', '2025-03-17 15:01:46'),
(2, 8, 'Family', 'Jamal Khan', '1st Floor', 4, 3, 'Gas Cylinder', '25000.00', '', '2025-03-19 17:06:35'),
(3, 5, 'Family', 'Chawk Bazar', '1st Floor', 3, 2, 'Gas Cylinder', '20000.00', '', '2025-03-20 13:24:13'),
(4, 11, 'Family', 'Jamal Khan', '1st Floor', 3, 3, 'Gas Meter', '22000.00', '', '2025-04-30 15:56:04');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `user_type` enum('user','admin') NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `password` varchar(255) NOT NULL,
  `employee_id` varchar(50) DEFAULT NULL,
  `department` varchar(100) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `user_type`, `first_name`, `last_name`, `email`, `phone`, `password`, `employee_id`, `department`, `created_at`) VALUES
(1, 'user', 'Tony', 'Adams', 'tony@gmail.com', '01453783930', '$2y$10$RtPccZZ7dy4k9p9iXPq45euKq0LKnzS1KfNLHtYFGVFf0kPzxO6q6', '', '', '2025-02-26 12:13:24'),
(2, 'admin', 'Salman', 'Jubayeed', 'salman@gmail.com', '01634856089', '$2y$10$bMIDpCfl.XIAqwjBtYPJHO0NfS/T2IKyhMzSXWkgN13t9QO6VC8wK', '80', 'Management', '2025-03-01 08:20:22'),
(3, 'user', 'Tanbir', 'Rocky', 'tanbirurrahmanrocky@gmail.com', '01631634508', '$2y$10$8oqAylH5UEwJpzAFmnecF.dMLZmxsvpVJMopWCnsPBNyWjGi3WvQm', '', '', '2025-03-04 00:27:27'),
(4, 'admin', 'Faraz ', 'Fardin', 'faraz@gmail.com', '01536727910', '$2y$10$Q6e2RqCHJnpXQaj71.DUbuDYI7xR62a0lDjtsGybgvkO5U0yuXOzm', '097', 'IT', '2025-03-04 00:54:33'),
(5, 'user', 'A T', 'C', 'atc@gmail.com', '01318788436', '$2y$10$n6wPkwaaqydLILXdaIpR5eWLqjkwyiF3r9atlJnVlgX4lPorOBV4a', '', '', '2025-03-17 10:00:41'),
(6, 'user', 'abc', 'xyz', 'abc@gmail.com', '01235498123', '$2y$10$i/Dhu4tBM7DylcmnaCgQ8.bLcTcDoG.NBJsvPx/y6eg3g139onqvS', '', '', '2025-03-17 10:30:37'),
(7, 'user', 'Chris', 'Hemsworth', 'chris@gmail.com', '01362947026', '$2y$10$lAFB.5fNM34zyddxs0Dlaurp.CVmbQwQ77KF42DzMjZnJ8y9OjTJm', '', '', '2025-03-19 10:49:16'),
(8, 'user', 'John', 'Evans', 'john@gmail.com', '016237820438', '$2y$10$NLY4jZkr2vgYOTjWAnILDeSs7eUtuoLRTXyJry7T4vaJcADz0kzdO', '', '', '2025-03-19 12:05:58'),
(9, 'user', 'Thiery', 'Henry', 'henry@gmail.com', '015237267936', '$2y$10$dZPSIbKTByjowENEJhY/menJDiu6la/rN3vwTfu/RZwcfIVC2OT9u', '', '', '2025-03-19 12:09:15'),
(10, 'user', 's', 'j', 'sj@gmail.com', '01345276931', '$2y$10$GWKub5k5SC2oaj3p1wUjIOG5ZPs7U5bepwIFCIRAtlv90Dvm5nRrq', '', '', '2025-04-28 15:10:27'),
(11, 'user', 'Tanbir', 'Rocky', 'tanbir@gmail.com', '0631634508', '$2y$10$yMmg6o..vIg2Ut8toWBLPOg58I9/p2MY4hDVJz2Wi3Evf3GSecbFK', '', '', '2025-04-30 18:55:04'),
(12, 'user', 'Musfek', 'Uddin', 'musfek@gmail.com', '01314157708', '$2y$10$RW6SjCxdNRK.W9leNqeCXekaa7QjfAPl68r1WZFjBwpQXD6r2eo.K', '', '', '2025-05-05 14:48:30'),
(13, 'user', 'Gm', 'Akash', 'rjakash426545@gmail.com', '01630880787', '$2y$10$Wis/0xClF0gFCMdUg0XYiOWlB.1gEZUJMRo/FqO8/L144EJCo/6xW', '', '', '2025-10-06 16:30:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `rental_id` (`rental_id`),
  ADD KEY `owner_id` (`owner_id`);

--
-- Indexes for table `rentals`
--
ALTER TABLE `rentals`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `rentals`
--
ALTER TABLE `rentals`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`rental_id`) REFERENCES `rentals` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`owner_id`) REFERENCES `users` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `rentals`
--
ALTER TABLE `rentals`
  ADD CONSTRAINT `rentals_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
