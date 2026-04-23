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
-- Table structure for table `books`
--

CREATE TABLE `books` (
  `id` int NOT NULL,
  `title` varchar(255) COLLATE utf8mb4_general_ci NOT NULL,
  `author` varchar(150) COLLATE utf8mb4_general_ci NOT NULL,
  `isbn` varchar(20) COLLATE utf8mb4_general_ci NOT NULL,
  `category` varchar(100) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `total_quantity` int NOT NULL DEFAULT '1',
  `available_quantity` int NOT NULL DEFAULT '1',
  `created_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`id`, `title`, `author`, `isbn`, `category`, `total_quantity`, `available_quantity`, `created_at`) VALUES
(1, ' Game of Thrones', 'George R. R. Martin,', '244dfdf344', 'Drama', 1, 0, '2026-04-18 04:28:30'),
(4, '1984', 'George Orwell', '97804515235', 'Dystopian', 3, 3, '2026-04-23 14:44:36'),
(45, 'To Kill a Mockingbird', 'Harper Lee', '978006112084', 'Fiction', 2, 2, '2026-04-23 14:44:36'),
(46, 'The Hobbit', 'J.R.R. Tolkien', '978054792227', 'Fantasy', 10, 10, '2026-04-23 14:44:36'),
(47, 'Bangla', 'sakib', '434', 'Fantasy', 100, 130, '2026-04-23 14:44:36'),
(48, 'Math', 'J.R.R', '97805928227', 'Education', 100, 30, '2026-04-23 14:44:36'),
(49, 'Hobbit', 'J.R.R. Tolkien', '9780547928227', 'Fantasy', 30, 10, '2026-04-23 14:44:36'),
(50, 'Clean Code', 'Robert C. Martin', '9780132350884', 'Programming', 5, 5, '2026-04-23 14:44:36'),
(51, 'The Pragmatic Programmer', 'Andrew Hunt', '9780135957059', 'Software Engineering', 3, 3, '2026-04-23 14:44:36'),
(52, 'Introduction to Algorithms', 'Thomas H. Cormen', '9780262033848', 'Data Structures', 2, 2, '2026-04-23 14:44:36'),
(53, 'JavaScript: The Good Parts', 'Douglas Crockford', '9780596517748', 'Web Development', 4, 4, '2026-04-23 14:44:36'),
(54, 'The Alchemist', 'Paulo Coelho', '9780062315007', 'Fiction', 10, 10, '2026-04-23 14:44:36'),
(55, 'Brave New World', 'Aldous Huxley', '9780060850524', 'Dystopian', 6, 6, '2026-04-23 14:44:36'),
(56, 'The Catcher in the Rye', 'J.D. Salinger', '9780316769174', 'Classic', 4, 4, '2026-04-23 14:44:36'),
(57, 'The Great Gatsby', 'F. Scott Fitzgerald', '9780743273565', 'Classic', 5, 5, '2026-04-23 14:44:36'),
(58, 'A Brief History of Time', 'Stephen Hawking', '9780553380163', 'Science', 3, 3, '2026-04-23 14:44:36'),
(59, 'Sapiens: A Brief History of Humankind', 'Yuval Noah Harari', '9780062316097', 'History', 7, 7, '2026-04-23 14:44:36'),
(60, 'Cosmos', 'Carl Sagan', '9780345331359', 'Science', 2, 2, '2026-04-23 14:44:36'),
(61, 'The Fellowship of the Ring', 'J.R.R. Tolkien', '9780547928210', 'Fantasy', 8, 8, '2026-04-23 14:44:36'),
(62, 'Harry Potter and the Sorcerer\'s Stone', 'J.K. Rowling', '9780590353427', 'Fantasy', 12, 12, '2026-04-23 14:44:36'),
(63, 'The Da Vinci Code', 'Dan Brown', '9780307474278', 'Mystery', 5, 5, '2026-04-23 14:44:36'),
(64, 'Murder on the Orient Express', 'Agatha Christie', '9780062693655', 'Mystery', 4, 4, '2026-04-23 14:44:36');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `books`
--
ALTER TABLE `books`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `isbn` (`isbn`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `books`
--
ALTER TABLE `books`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=65;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
