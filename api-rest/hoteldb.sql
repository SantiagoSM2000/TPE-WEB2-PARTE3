-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 18, 2024 at 03:44 AM
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
-- Database: `hoteldb`
--

-- --------------------------------------------------------

--
-- Table structure for table `clients`
--

CREATE TABLE `clients` (
  `ID_Client` int(11) NOT NULL,
  `Firstname` varchar(50) NOT NULL,
  `Lastname` varchar(50) NOT NULL,
  `Email` varchar(100) NOT NULL,
  `Phone_number` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `clients`
--

INSERT INTO `clients` (`ID_Client`, `Firstname`, `Lastname`, `Email`, `Phone_number`) VALUES
(1, 'Juan', 'Perez', 'jp@gmail.com', '000'),
(5, 'Marcos', 'Juarez', 'mj@gmail.com', '111');

-- --------------------------------------------------------

--
-- Table structure for table `reservations`
--

CREATE TABLE `reservations` (
  `ID_Reservation` int(11) NOT NULL,
  `Date` date NOT NULL,
  `Room_number` int(11) NOT NULL,
  `Image` varchar(300) DEFAULT NULL,
  `ID_Client` int(11) NOT NULL,
  `Payed` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `reservations`
--

INSERT INTO `reservations` (`ID_Reservation`, `Date`, `Room_number`, `Image`, `ID_Client`, `Payed`) VALUES
(38, '2025-02-19', 130, ' ', 5, 1),
(39, '2024-10-20', 102, '1', 1, 0),
(41, '2024-10-20', 202, '1', 1, 1),
(42, '2024-03-04', 545, '1', 5, 0),
(43, '2024-10-20', 345, '1', 1, 0),
(44, '2024-11-12', 12, ' ', 5, 1),
(45, '2024-04-15', 325, '1', 1, 1),
(46, '2024-06-11', 223, '1', 1, 0),
(47, '2024-10-20', 23, '1', 5, 0),
(48, '2024-10-20', 78, '1', 1, 1),
(49, '2025-02-28', 15, '1', 5, 0),
(50, '2024-10-20', 202, '1', 1, 1),
(51, '2024-10-20', 202, '1', 5, 0),
(65, '2024-10-20', 202, NULL, 1, 0),
(66, '2024-10-20', 202, ' ', 1, 0),
(67, '2024-10-20', 202, 'http', 1, 0),
(68, '2024-10-20', 202, ' ', 1, 0),
(69, '2025-02-19', 125, '1', 1, 1),
(71, '2025-01-10', 132, ' ', 5, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `ID_User` int(11) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` char(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`ID_User`, `Username`, `Password`) VALUES
(1, 'webadmin', '$2y$10$KpFpJvyTfLlvk1AXMT1nauLCvCc7qCupkGKhzHXudqvYh50RuYCZS');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `clients`
--
ALTER TABLE `clients`
  ADD PRIMARY KEY (`ID_Client`),
  ADD UNIQUE KEY `Email` (`Email`);

--
-- Indexes for table `reservations`
--
ALTER TABLE `reservations`
  ADD PRIMARY KEY (`ID_Reservation`),
  ADD KEY `fk_cliente` (`ID_Client`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`ID_User`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `clients`
--
ALTER TABLE `clients`
  MODIFY `ID_Client` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `reservations`
--
ALTER TABLE `reservations`
  MODIFY `ID_Reservation` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=72;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `ID_User` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `reservations`
--
ALTER TABLE `reservations`
  ADD CONSTRAINT `fk_cliente` FOREIGN KEY (`ID_Client`) REFERENCES `clients` (`ID_Client`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
