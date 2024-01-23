-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 23, 2024 at 06:03 PM
-- Server version: 8.0.31
-- PHP Version: 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `todo_list`
--

-- --------------------------------------------------------

--
-- Table structure for table `task`
--

DROP TABLE IF EXISTS `task`;
CREATE TABLE IF NOT EXISTS `task` (
  `task_id` int NOT NULL AUTO_INCREMENT,
  `task_name` varchar(255) NOT NULL,
  `task_status` varchar(25) NOT NULL,
  `task_due_date` datetime NOT NULL,
  `task_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`task_id`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `task`
--

INSERT INTO `task` (`task_id`, `task_name`, `task_status`, `task_due_date`, `task_date`) VALUES
(6, 'Bootstrap is a popular front-end web development ', '1', '2024-01-18 09:06:00', '2024-01-18 16:04:21'),
(7, 'Modals are built with HTML, CSS, and JavaScript', '1', '2024-01-19 11:29:00', '2024-01-18 17:11:07'),
(8, 'Clicking on the modal “backdrop” will automatically close the modal', '1', '2024-01-18 20:11:00', '2024-01-18 17:11:40'),
(9, 'Using color to add meaning only provides a visual', '1', '2024-01-19 13:00:00', '2024-01-18 17:12:22'),
(10, 'Test Task 4', '1', '2024-01-19 13:00:00', '2024-01-19 12:56:12'),
(11, 'Centro comercial Moctezuma', '1', '2024-01-19 17:10:00', '2024-01-19 17:09:32'),
(12, 'The look of an HTML table can be greatly improved', '1', '2024-01-19 17:22:00', '2024-01-19 17:20:29'),
(13, 'Test Task 2', '0', '2024-01-19 17:27:00', '2024-01-19 17:25:27'),
(14, 'Modals are built with HTML, CSS, and JavaScript', '0', '2024-01-27 17:33:00', '2024-01-19 17:31:41');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
