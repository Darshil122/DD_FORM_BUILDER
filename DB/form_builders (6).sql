-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 15, 2024 at 07:14 AM
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
-- Database: `form_builders`
--

-- --------------------------------------------------------

--
-- Table structure for table `feedback_master`
--

CREATE TABLE `feedback_master` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `message` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `feedback_master`
--

INSERT INTO `feedback_master` (`id`, `name`, `email`, `message`) VALUES
(1, 'darshil', 'darshil@gmail.com', 'hello'),
(2, 'darshil', 'darshil@gmail.com', 'hello from darshil'),
(3, 'jk', 'jaydev@gmail.com', 'hello from jk'),
(4, 'ankur bhanderi', 'ankur@gmail.com', 'hello form ankur');

-- --------------------------------------------------------

--
-- Table structure for table `formfield_master`
--

CREATE TABLE `formfield_master` (
  `id` int(11) NOT NULL,
  `form_id` int(11) DEFAULT NULL,
  `field_name` varchar(255) DEFAULT NULL,
  `field_type` varchar(50) DEFAULT NULL,
  `field_options` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formfield_master`
--

INSERT INTO `formfield_master` (`id`, `form_id`, `field_name`, `field_type`, `field_options`, `created_at`) VALUES
(1, 1, 'Message Field', 'text', NULL, '2024-09-08 13:30:02'),
(2, 2, 'Radio Field', 'radio', NULL, '2024-09-08 13:35:21'),
(3, 3, 'Radio Field', 'text', NULL, '2024-09-08 17:44:48'),
(4, 4, 'Radio Field', 'text', NULL, '2024-09-08 17:45:46'),
(5, 5, 'Password Field', 'text', NULL, '2024-09-08 17:47:20'),
(6, 6, '', 'text', NULL, '2024-09-08 18:00:45'),
(7, 7, '', 'text', NULL, '2024-09-08 18:01:48'),
(8, 8, 'gender', 'text', NULL, '2024-09-08 18:10:49'),
(9, 9, 'Radio', 'text', NULL, '2024-09-08 18:14:42'),
(10, 10, 'Radio', 'text', NULL, '2024-09-08 18:19:36'),
(11, 11, 'Radio', 'text', NULL, '2024-09-08 18:28:39'),
(12, 12, 'Radio', 'text', NULL, '2024-09-08 18:32:38'),
(13, 13, 'Radio Field', 'radio', NULL, '2024-09-08 18:35:24'),
(14, 14, 'Radio Field', 'radio', NULL, '2024-09-15 04:38:14'),
(15, 15, '', 'text', NULL, '2024-09-15 04:56:49'),
(16, 16, '', 'text', NULL, '2024-09-15 04:58:55'),
(17, 17, '', 'text', NULL, '2024-09-15 04:59:21'),
(18, 18, 'Text', 'text', NULL, '2024-09-15 05:00:13'),
(19, 19, 'Email', 'text', NULL, '2024-09-15 05:02:30'),
(20, 19, 'Password', 'text', NULL, '2024-09-15 05:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `forms_master`
--

CREATE TABLE `forms_master` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `form_name` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `forms_master`
--

INSERT INTO `forms_master` (`id`, `user_id`, `form_name`, `created_at`) VALUES
(1, 1, 'test', '2024-09-08 13:30:02'),
(2, 1, 'test', '2024-09-08 13:35:21'),
(3, 1, 'test', '2024-09-08 17:44:48'),
(4, 1, 'test1', '2024-09-08 17:45:46'),
(5, 1, 'testing', '2024-09-08 17:47:20'),
(6, 1, 'test2', '2024-09-08 18:00:45'),
(7, 1, 'czxzcx', '2024-09-08 18:01:48'),
(8, 1, 'test3', '2024-09-08 18:10:49'),
(9, 1, 'hy', '2024-09-08 18:14:42'),
(10, 1, 'sx', '2024-09-08 18:19:36'),
(11, 1, 'dads', '2024-09-08 18:28:39'),
(12, 1, 'dfs', '2024-09-08 18:32:38'),
(13, 1, 'dsad', '2024-09-08 18:35:24'),
(14, 1, 'sample', '2024-09-15 04:38:14'),
(15, 1, 'test', '2024-09-15 04:56:49'),
(16, 1, 'sample', '2024-09-15 04:58:55'),
(17, 1, 'test1', '2024-09-15 04:59:21'),
(18, 1, 'test2', '2024-09-15 05:00:13'),
(19, 1, 'login test', '2024-09-15 05:02:30');

-- --------------------------------------------------------

--
-- Table structure for table `login_master`
--

CREATE TABLE `login_master` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `login_master`
--

INSERT INTO `login_master` (`id`, `email`, `Password`) VALUES
(1, 'admin@gmail.com', '2005');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` int(11) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `email`, `password`) VALUES
(1, 'darshil@gmail.com', '2000'),
(2, 'jaydev@gmail.com', '1000'),
(3, 'jay@gmail.com', '123');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `feedback_master`
--
ALTER TABLE `feedback_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `formfield_master`
--
ALTER TABLE `formfield_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `formfield_master_ibfk_1` (`form_id`);

--
-- Indexes for table `forms_master`
--
ALTER TABLE `forms_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`),
  ADD KEY `forms_master_fk1` (`user_id`);

--
-- Indexes for table `login_master`
--
ALTER TABLE `login_master`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `feedback_master`
--
ALTER TABLE `feedback_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `formfield_master`
--
ALTER TABLE `formfield_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `forms_master`
--
ALTER TABLE `forms_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `login_master`
--
ALTER TABLE `login_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `formfield_master`
--
ALTER TABLE `formfield_master`
  ADD CONSTRAINT `formfield_master_ibfk_1` FOREIGN KEY (`form_id`) REFERENCES `forms_master` (`id`);

--
-- Constraints for table `forms_master`
--
ALTER TABLE `forms_master`
  ADD CONSTRAINT `forms_master_fk1` FOREIGN KEY (`user_id`) REFERENCES `user_master` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
