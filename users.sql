-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db:3306
-- Generation Time: Apr 23, 2026 at 02:49 PM
-- Server version: 8.0.45
-- PHP Version: 8.3.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `library_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) COLLATE utf8mb4_general_ci NOT NULL,
  `email` varchar(100) COLLATE utf8mb4_general_ci NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `role` enum('admin','student') COLLATE utf8mb4_general_ci NOT NULL DEFAULT 'student',
  `subscription_type` enum('general','premium') COLLATE utf8mb4_general_ci DEFAULT 'general',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `subscription_type`, `created_at`, `updated_at`) VALUES
(1, 'shafin', 'shafindxo28@gmail.com', '$2y$10$VUBIeDfNDyLeMtIN90fDnufU1ZePSRPkSg4EO0SEo4Cun45HiCtiq', 'admin', 'general', '2026-04-17 18:32:48', '2026-04-17 18:32:48'),
(2, 'fadf', 'sha@gmail.com', '$2y$10$QC0pv7O3ciL.ziRHN4SEEOsyx1O2eWG6bT1G8hFegku.cpz0RJunS', 'student', 'premium', '2026-04-18 04:16:36', '2026-04-21 08:56:22'),
(3, 'sakib', 'aSs@gmail.com', '$2y$10$2W9Q.eGZGpk0MbPcDc4yVe.1SwODgyXALFG14FqCC.WycwfLCket6', 'student', 'general', '2026-04-21 12:58:48', '2026-04-21 12:58:48'),
(16, 'ikram', 'i@gmail.com', '12345', 'admin', 'general', '2026-04-23 14:38:10', '2026-04-23 14:38:10'),
(17, 'bob', 'bob@build.it', 'construct456', 'student', 'premium', '2026-04-23 14:38:10', '2026-04-23 14:38:10'),
(18, 'charlie', 'charlie@peanuts.com', 'snoopy789', 'student', 'general', '2026-04-23 14:38:10', '2026-04-23 14:38:10'),
(19, 'shafi', 's@gmail.com', '1234', 'student', 'general', '2026-04-23 14:38:10', '2026-04-23 14:38:10'),
(20, 'siam', 'siam@mail.com', '7896', 'admin', 'general', '2026-04-23 14:38:10', '2026-04-23 14:38:10'),
(21, 'nayan', 'n@mail.com', '5555', 'student', 'premium', '2026-04-23 14:38:10', '2026-04-23 14:38:10');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
