-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 16, 2024 at 08:08 PM
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
-- Table structure for table `admin_master`
--

CREATE TABLE `admin_master` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin_master`
--

INSERT INTO `admin_master` (`id`, `email`, `Password`) VALUES
(1, 'admin@gmail.com', 'Admin@123');

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
  `field_text` varchar(255) DEFAULT NULL,
  `field_style` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `formfield_master`
--

INSERT INTO `formfield_master` (`id`, `form_id`, `field_name`, `field_type`, `field_options`, `field_text`, `field_style`, `created_at`) VALUES
(1, 1, 'Email', 'email', NULL, NULL, NULL, '2024-09-29 13:12:44'),
(2, 1, 'Password', 'password', NULL, NULL, NULL, '2024-09-29 13:12:44'),
(3, 1, '', 'button', NULL, 'Login', 'btn-info', '2024-09-29 13:12:44'),
(6, 4, 'Name', 'text', NULL, NULL, NULL, '2024-10-06 09:11:50'),
(7, 4, 'Mobile No.', 'number', NULL, NULL, NULL, '2024-10-06 09:11:50'),
(8, 4, 'Email', 'email', NULL, NULL, NULL, '2024-10-06 09:11:50'),
(9, 4, 'Password', 'password', NULL, NULL, NULL, '2024-10-06 09:11:50'),
(10, 5, 'Email Field', 'email', NULL, NULL, NULL, '2024-10-06 09:33:47');

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
(1, 1, 'Login', '2024-09-29 13:12:44'),
(4, 1, 'Register Form', '2024-10-06 09:11:50'),
(5, 1, 'test', '2024-10-06 09:33:47');

-- --------------------------------------------------------

--
-- Table structure for table `user_master`
--

CREATE TABLE `user_master` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `number` bigint(255) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_master`
--

INSERT INTO `user_master` (`id`, `name`, `number`, `email`, `password`) VALUES
(1, 'Darshil Dabhi', 9499835771, 'darshil@gmail.com', '2000');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_master`
--
ALTER TABLE `admin_master`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `user_master`
--
ALTER TABLE `user_master`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_master`
--
ALTER TABLE `admin_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `feedback_master`
--
ALTER TABLE `feedback_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `formfield_master`
--
ALTER TABLE `formfield_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `forms_master`
--
ALTER TABLE `forms_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `user_master`
--
ALTER TABLE `user_master`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

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