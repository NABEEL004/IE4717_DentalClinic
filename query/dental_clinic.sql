-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Nov 08, 2023 at 07:35 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dental_clinic`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `app_id` int(11) NOT NULL,
  `app_date` date NOT NULL,
  `app_time` time NOT NULL,
  `doctor_name` varchar(50) NOT NULL,
  `patientID` int(11) NOT NULL,
  `patient_name` varchar(50) NOT NULL,
  `note` varchar(255) DEFAULT NULL,
  `registered_datetime` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`app_id`, `app_date`, `app_time`, `doctor_name`, `patientID`, `patient_name`, `note`, `registered_datetime`) VALUES
(25, '2023-11-22', '09:00:00', 'Shanice', 21, 'Zihao Hu', 'i want to whiten my teeth.', '2023-11-09 02:08:35'),
(26, '2023-11-10', '09:00:00', 'Shanice', 22, 'messi', NULL, '2023-11-09 02:13:27'),
(27, '2023-11-01', '14:00:00', 'Shawn', 28, 'Monesy', NULL, '2023-11-09 02:24:54'),
(28, '2023-10-30', '12:00:00', 'Shanice', 29, 'simple', NULL, '2023-11-09 02:27:06'),
(29, '2023-11-02', '15:00:00', 'Shawn', 30, 'bit', 'i am bit', '2023-11-09 02:29:54');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `doctor_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(127) NOT NULL,
  `phone_number` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`doctor_id`, `username`, `password`, `email`, `phone_number`) VALUES
(10, 'Shanice', '$2y$10$rD6ENXxUSuQ2P9/fh5/pD.5ZX0JbpZMUxSYt5Rkhy0xjM3iFF/P/O', 'shanice@tan.sons.com', '82718712'),
(28, 'Lee', '$2y$10$.3TBZG93FTV0O3bttRcW.uJzdzdSaJO7zXCKXWo5.kcJ/c6tqBh0a', 'lee@tan.sons.com', '80271831'),
(29, 'Shawn', '$2y$10$nRWW1KAvd0xT4s1mTTCIU.4PqWqSmbM0hCUKuZQm95qtx3CzWC8Jy', 'shawn@tan.sons.com', '90889000');

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `patient_id` int(11) NOT NULL,
  `username` varchar(50) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(127) NOT NULL,
  `phone_number` varchar(8) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`patient_id`, `username`, `password`, `email`, `phone_number`) VALUES
(17, 'trivial', '$2y$10$8f6l/gLjsBGPY62imZwg1eWXkYQuFgoaqMjarzZ9TQWKGyceeBYcC', '123@tan.com', '97128371'),
(21, 'Zihao Hu', '$2y$10$ozf3wzlyOXplzBtNFNMG7uIdmVfiMS2guVqugL.TnKbEE5vY67R2W', 'e200230@e.ntu.edu.sg', '81283712'),
(22, 'messi', '$2y$10$QmBrUp4SFl/WIqTdtiSFS.wLyuH2r5qm4foBB9t9pUEKCt.kewhQa', 'messi@ag.com', '97127318'),
(23, 'C Ronaldo', '$2y$10$lnkXXvccNCzWt3oNY3iQ..m0dSSPZ69w3vsZtLa3XDLIZYoHo3On6', 'b0195783b@e.ntu.edu.sg', '91271283'),
(24, 'neymar--PSG', '$2y$10$V17PJ2wU9wbViyrHSzuv5OW1n/s7IWm8l4Vh3YrKdco4cQ5ojZ7nu', 'ney@qq.com', '97128781'),
(28, 'Monesy', '$2y$10$FpSVBDZkyR/V3GJrrImcaO9nHTLkoln3WT6t4dvqR51iKMhzWjvui', 'monesy@cs.com', '86988440'),
(29, 'simple', '$2y$10$AfniMwT/eixvXehN00sJVO4uJ7Ul6W3jw5BlG5GoVQHjdM.hpmFXu', 'simple@cs.com', '81263127'),
(30, 'bit', '$2y$10$1z0yvwLXdhFPgUb8ehzV4ePM0W4clwIGhotyVwicgrnGEoSYcIO6q', 'bit@cs.com', '97120011');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`app_id`),
  ADD KEY `patientID` (`patientID`),
  ADD KEY `appointments_ibfk_2` (`doctor_name`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`doctor_id`),
  ADD UNIQUE KEY `uc_username` (`username`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`patient_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `app_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patientID`) REFERENCES `patients` (`patient_id`),
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_name`) REFERENCES `doctors` (`username`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
