-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: May 15, 2025 at 06:00 PM
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
-- Database: `100589839_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `cars`
--

CREATE TABLE `cars` (
  `car_ID` int(11) NOT NULL,
  `make` varchar(25) NOT NULL,
  `model` varchar(40) NOT NULL,
  `price` float NOT NULL,
  `yom` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `cars`
--

INSERT INTO `cars` (`car_ID`, `make`, `model`, `price`, `yom`) VALUES
(1, 'BMW', 'X3', 35000, 2010),
(2, 'Holden', 'Astra', 14000, 2009),
(3, 'Ford', 'Falcon', 39000, 2013),
(4, 'Toyota', 'Corolla', 20000, 2012),
(5, 'Holden', 'Commodore', 13500, 2005),
(6, 'Holden', 'Astra', 8000, 2004),
(7, 'Holden', 'Commodore', 28000, 2009),
(8, 'Ford', 'Falcon', 14000, 2011),
(9, 'Ford', 'Falcon', 7000, 2003),
(10, 'Ford', 'Laser', 10000, 2010),
(11, 'ford', 'falconnew', 10000, 30303),
(12, 'Honda', 'SampleCar', 123424, 101010);

-- --------------------------------------------------------

--
-- Table structure for table `eoi`
--

CREATE TABLE `eoi` (
  `eoi_id` int(11) NOT NULL,
  `job_ref` varchar(10) NOT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New',
  `first_name` varchar(100) NOT NULL,
  `last_name` varchar(100) NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone_number` varchar(50) NOT NULL,
  `street_address` varchar(255) NOT NULL,
  `suburb_address` varchar(100) NOT NULL,
  `state_address` varchar(3) NOT NULL,
  `postcode` smallint(6) NOT NULL,
  `skill_1` varchar(100) DEFAULT NULL,
  `skill_2` varchar(100) DEFAULT NULL,
  `skill_3` varchar(100) DEFAULT NULL,
  `skill_4` varchar(100) DEFAULT NULL,
  `skill_5` varchar(100) DEFAULT NULL,
  `miscinfo` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `job_descriptions`
--

CREATE TABLE `job_descriptions` (
  `eoi_id` int(11) NOT NULL,
  `job_ref` varchar(10) NOT NULL,
  `job_title` varchar(80) NOT NULL,
  `status` enum('New','Current','Final') NOT NULL DEFAULT 'New',
  `skill_1` varchar(100) DEFAULT NULL,
  `skill_2` varchar(100) DEFAULT NULL,
  `skill_3` varchar(100) DEFAULT NULL,
  `skill_4` varchar(100) DEFAULT NULL,
  `skill_5` varchar(100) DEFAULT NULL,
  `miscinfo` mediumtext DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `userdata`
--

CREATE TABLE `userdata` (
  `id` int(11) NOT NULL,
  `user_type` enum('ADMIN','USER','GUEST') NOT NULL DEFAULT 'GUEST',
  `username` varchar(45) NOT NULL,
  `email_address` varchar(45) NOT NULL,
  `password` varchar(200) NOT NULL,
  `created_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_general_ci;

--
-- Dumping data for table `userdata`
--

INSERT INTO `userdata` (`id`, `user_type`, `username`, `email_address`, `password`, `created_at`) VALUES
(1, 'GUEST', 'admin', 'example@user.com', '$2y$10$oFKMmcks2Kt84e96kyT8U.LsGT.Ls9lk6zpB6Saoc0YUupr8fOW86', '2025-05-15 23:49:04'),
(8, 'GUEST', '', '', '$2y$10$2wc6TaIvjtWkcKSwmspgKOuW3mVB56F4vyfrTqPTpaPprCGlqZgUO', '2025-05-16 01:53:35'),
(9, 'GUEST', 'TestUser', 'test@user.com', '$2y$10$xe3/Udk/ebtK.QqbNkQJ/eFkj1gBAbKgjtUI8lfqJ68Od5.LMP5e6', '2025-05-16 01:53:46');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cars`
--
ALTER TABLE `cars`
  ADD PRIMARY KEY (`car_ID`);

--
-- Indexes for table `eoi`
--
ALTER TABLE `eoi`
  ADD PRIMARY KEY (`eoi_id`),
  ADD KEY `fk_jobref` (`job_ref`);

--
-- Indexes for table `job_descriptions`
--
ALTER TABLE `job_descriptions`
  ADD PRIMARY KEY (`eoi_id`),
  ADD UNIQUE KEY `unq_jobref` (`job_ref`);

--
-- Indexes for table `userdata`
--
ALTER TABLE `userdata`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `id_unique` (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cars`
--
ALTER TABLE `cars`
  MODIFY `car_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `eoi`
--
ALTER TABLE `eoi`
  MODIFY `eoi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `job_descriptions`
--
ALTER TABLE `job_descriptions`
  MODIFY `eoi_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `userdata`
--
ALTER TABLE `userdata`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `eoi`
--
ALTER TABLE `eoi`
  ADD CONSTRAINT `fk_jobref` FOREIGN KEY (`job_ref`) REFERENCES `job_descriptions` (`job_ref`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
