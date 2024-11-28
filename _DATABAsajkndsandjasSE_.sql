-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 28, 2024 at 02:36 PM
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
-- Database: `pabau`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Makes Work Fun'),
(2, 'Team Player'),
(3, 'Culture Champion'),
(4, 'Difference Maker');

-- --------------------------------------------------------

--
-- Table structure for table `employees`
--

CREATE TABLE `employees` (
  `id` int(11) NOT NULL,
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employees`
--

INSERT INTO `employees` (`id`, `first_name`, `last_name`, `email`, `password`) VALUES
(1, 'Ilija', 'Ristov', 'ilija@example.com', '$2y$10$4BT5qEzSyZwEWjjCxibbzu7AVwO5F7ACusbHyVw0m9lYCu7ZoXeve'),
(2, 'Simona', 'Koteska', 'simona@example.com', '$2y$10$jovJFCFg8S9rvUQYqME8W.td1GoFzwEaoYUBubcb24QIvZHjeft4m'),
(4, 'Dsadsa', 'Ristov', 'dsadas@das.com', '$2y$10$zq9OT7BZ3s7JiZDA5mA/g.ukjwe0jomfoVdsHmMkOOqglMe/C.7YW'),
(5, '321', '231', 'asdsa@com.com', '$2y$10$LA9S9jVBk1QzBeuA78exI.NMlziIJxySqtqT/4zEHubFHLYfUXad.'),
(6, 'Dsa1', 'Dsa1', 'stojko@example.com', '$2y$10$nmPzxAhK6cJQp0YT1UK4HO5Wy3DDx96m2/8nxgE.vDXHxRrOz9gke'),
(7, '2321321', '321321321', '3213@dsadsa', '$2y$10$q55joqh5TiFcDt7L4NVinuBDrFEyLr5DQUhd48dz9GcOXJuY3GJpm'),
(8, 'Vanco', 'Jordanovski', 'vanco@example.com', '$2y$10$WpUqqsDKrWwiXfOa81SiIe7J5mUpIWPGKRGPCpkfXXqEJi9ToViqW');

-- --------------------------------------------------------

--
-- Table structure for table `votes`
--

CREATE TABLE `votes` (
  `id` int(11) NOT NULL,
  `voter_id` int(11) NOT NULL,
  `nominee_id` int(11) NOT NULL,
  `category_id` int(11) NOT NULL,
  `comment` text NOT NULL,
  `timestamp` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `votes`
--

INSERT INTO `votes` (`id`, `voter_id`, `nominee_id`, `category_id`, `comment`, `timestamp`) VALUES
(5, 1, 2, 1, ' ', '2024-11-28 11:37:03'),
(6, 1, 2, 2, ' ', '2024-11-28 11:37:53'),
(7, 1, 2, 1, ' ', '2024-11-28 11:38:37'),
(8, 1, 4, 1, ' ', '2024-11-28 11:38:44'),
(9, 1, 4, 1, ' ', '2024-11-28 11:39:29'),
(10, 1, 2, 2, ' ', '2024-11-28 11:41:13'),
(11, 1, 2, 1, ' 1', '2024-11-28 11:43:00'),
(12, 2, 1, 2, ' aa', '2024-11-28 12:03:10'),
(13, 8, 5, 1, ' dsasadsda', '2024-11-28 12:10:10'),
(14, 8, 4, 1, ' 2321', '2024-11-28 12:10:22'),
(15, 8, 1, 1, ' sda', '2024-11-28 13:12:46'),
(16, 8, 6, 1, ' 231', '2024-11-28 13:16:14'),
(17, 1, 8, 3, ' dsadsa', '2024-11-28 13:20:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employees`
--
ALTER TABLE `employees`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `votes`
--
ALTER TABLE `votes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `voter_id` (`voter_id`),
  ADD KEY `nominee_id` (`nominee_id`),
  ADD KEY `category_id` (`category_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `employees`
--
ALTER TABLE `employees`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `votes`
--
ALTER TABLE `votes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `votes`
--
ALTER TABLE `votes`
  ADD CONSTRAINT `votes_ibfk_1` FOREIGN KEY (`voter_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_2` FOREIGN KEY (`nominee_id`) REFERENCES `employees` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `votes_ibfk_3` FOREIGN KEY (`category_id`) REFERENCES `categories` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
