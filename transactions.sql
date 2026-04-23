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
-- Table structure for table `transactions`
--

CREATE TABLE `transactions` (
  `id` int NOT NULL,
  `user_id` int NOT NULL,
  `book_id` int NOT NULL,
  `issue_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `return_deadline` date NOT NULL,
  `return_date` date DEFAULT NULL,
  `status` enum('borrowed','returned','overdue') COLLATE utf8mb4_general_ci DEFAULT 'borrowed',
  `fine_amount` decimal(10,2) DEFAULT '0.00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `transactions`
--

INSERT INTO `transactions` (`id`, `user_id`, `book_id`, `issue_date`, `return_deadline`, `return_date`, `status`, `fine_amount`) VALUES
(1, 2, 1, '2026-04-18 04:28:53', '2026-04-25', '2026-04-21', 'returned', 0.00),
(2, 2, 1, '2026-04-21 09:04:02', '2026-05-21', '2026-04-21', 'returned', 0.00),
(3, 2, 1, '2026-04-21 11:56:38', '2026-05-21', '2026-04-21', 'returned', 0.00),
(4, 2, 1, '2026-04-21 12:45:08', '2026-05-21', '2026-04-21', 'returned', 0.00),
(5, 2, 1, '2026-04-21 12:57:33', '2026-05-21', '2026-04-22', 'returned', 0.00),
(6, 2, 1, '2026-04-22 08:43:38', '2026-05-22', '2026-04-22', 'returned', 0.00),
(7, 2, 1, '2026-04-22 08:43:54', '2026-05-22', '2026-04-22', 'returned', 0.00),
(8, 2, 1, '2026-04-22 08:45:03', '2026-05-22', NULL, 'borrowed', 0.00),
(9, 1, 5, '2026-04-23 14:47:17', '2026-05-07', NULL, 'borrowed', 0.00),
(10, 2, 3, '2026-04-23 14:47:17', '2026-04-20', '2026-04-19', 'returned', 0.00),
(11, 3, 12, '2026-04-23 14:47:17', '2026-04-10', NULL, 'overdue', 50.50),
(12, 1, 8, '2026-04-23 14:47:17', '2026-05-01', NULL, 'borrowed', 0.00);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `transactions`
--
ALTER TABLE `transactions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `book_id` (`book_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `transactions`
--
ALTER TABLE `transactions`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
