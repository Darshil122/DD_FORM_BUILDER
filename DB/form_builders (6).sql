-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 22, 2024 at 07:36 PM
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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `field_text` varchar(255) DEFAULT NULL,
  `field_style` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formfield_master`
--

INSERT INTO `formfield_master` (`id`, `form_id`, `field_name`, `field_type`, `field_options`, `created_at`, `field_text`, `field_style`) VALUES
(1, 1, 'Email', 'email', NULL, '2024-09-19 16:07:48', NULL, NULL),
(2, 1, 'Password', 'password', NULL, '2024-09-19 16:07:48', NULL, NULL),
(3, 2, 'Name', 'text', NULL, '2024-09-19 16:11:12', NULL, NULL),
(4, 2, 'Phone no.', 'number', NULL, '2024-09-19 16:11:12', NULL, NULL),
(5, 2, 'email', 'email', NULL, '2024-09-19 16:11:12', NULL, NULL),
(6, 3, 'Button', 'button', NULL, '2024-09-22 16:22:53', NULL, NULL),
(7, 3, 'Button', 'submit', NULL, '2024-09-22 16:22:53', NULL, NULL),
(8, 3, 'Button', 'reset', NULL, '2024-09-22 16:22:53', NULL, NULL),
(9, 4, 'name', 'text', NULL, '2024-09-22 16:30:38', NULL, NULL),
(10, 5, 'Button', 'button', NULL, '2024-09-22 16:41:02', NULL, NULL),
(11, 7, 'Button', 'button', NULL, '2024-09-22 16:51:50', 'submit', 'btn-primary'),
(12, 8, 'Button', 'button', NULL, '2024-09-22 16:59:54', 'button', 'btn-secondary'),
(13, 8, 'Button', 'button', NULL, '2024-09-22 16:59:54', 'submit', 'btn-success'),
(14, 8, 'Button', 'button', NULL, '2024-09-22 16:59:54', 'reset', 'btn-danger'),
(15, 9, '', 'button', NULL, '2024-09-22 17:03:33', 'Publish', 'btn-warning'),
(16, 10, '', 'button', NULL, '2024-09-22 17:18:15', 'confirm', 'btn-success');

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
(1, 1, 'login form', '2024-09-19 16:07:48'),
(2, 1, 'Registration form', '2024-09-19 16:11:12'),
(3, 1, 'test', '2024-09-22 16:22:53'),
(4, 1, 'test', '2024-09-22 16:30:38'),
(5, 1, 'test test', '2024-09-22 16:41:02'),
(7, 1, 'test', '2024-09-22 16:51:50'),
(8, 1, 'btn test', '2024-09-22 16:59:54'),
(9, 1, 'test btn', '2024-09-22 17:03:33'),
(10, 1, 'test test button', '2024-09-22 17:18:15');

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `forms_master`
--
ALTER TABLE `forms_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

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
