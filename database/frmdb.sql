-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 23, 2022 at 09:54 AM
-- Server version: 10.4.20-MariaDB
-- PHP Version: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `frmdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `crop_table`
--

CREATE TABLE `crop_table` (
  `crop_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `crop_name` varchar(255) NOT NULL,
  `crop_date` date NOT NULL,
  `status` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `crop_table`
--

INSERT INTO `crop_table` (`crop_id`, `user_id`, `crop_name`, `crop_date`, `status`) VALUES
(31, 6, '1st Crop', '2022-08-13', 'close'),
(37, 6, '2nd Crop', '2022-08-22', 'open');

-- --------------------------------------------------------

--
-- Table structure for table `expenses_record`
--

CREATE TABLE `expenses_record` (
  `expense_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `expense_name` varchar(255) NOT NULL,
  `amount` int(11) NOT NULL,
  `expense_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `expenses_record`
--

INSERT INTO `expenses_record` (`expense_id`, `crop_id`, `expense_name`, `amount`, `expense_date`) VALUES
(95, 31, 'Diesel', 1000, '2022-08-13'),
(98, 37, 'Diesel', 1000, '2022-08-23');

-- --------------------------------------------------------

--
-- Table structure for table `profit`
--

CREATE TABLE `profit` (
  `profit_id` int(11) NOT NULL,
  `total_exp_id` int(11) NOT NULL,
  `total_sls_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sales_record`
--

CREATE TABLE `sales_record` (
  `sales_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `sale_name` varchar(255) NOT NULL,
  `quantity` int(11) NOT NULL,
  `weight` float NOT NULL,
  `amount` float NOT NULL,
  `sales` float NOT NULL,
  `sales_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sales_record`
--

INSERT INTO `sales_record` (`sales_id`, `crop_id`, `sale_name`, `quantity`, `weight`, `amount`, `sales`, `sales_date`) VALUES
(25, 31, 'Mais', 60, 60.6, 13.25, 48177, '2022-08-13'),
(27, 37, 'Mais', 20, 50, 13, 13000, '2022-08-22');

-- --------------------------------------------------------

--
-- Table structure for table `total_expense`
--

CREATE TABLE `total_expense` (
  `total_exp_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `total_exp` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `total_expense`
--

INSERT INTO `total_expense` (`total_exp_id`, `crop_id`, `total_exp`) VALUES
(13, 31, 1000),
(19, 37, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `total_sales`
--

CREATE TABLE `total_sales` (
  `total_sls_id` int(11) NOT NULL,
  `crop_id` int(11) NOT NULL,
  `total_sls` float NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `total_sales`
--

INSERT INTO `total_sales` (`total_sls_id`, `crop_id`, `total_sls`) VALUES
(15, 31, 48177),
(21, 37, 13000);

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `username` varchar(50) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `recovery_key` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_cs NOT NULL,
  `user_type` varchar(6) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `username`, `password`, `recovery_key`, `user_type`) VALUES
(6, 'Allen0293', '$2y$10$XzKmJ5aqndCYGWHZwZ5cE.nDJ0PYZc2hI3kg9hI./2/IV/dzWydZK', '$2y$10$NSwtITVQHmDb9OVRnJMwU.2uOyMKPdZtortC9/z/8.aR8yB5HsU4S', 'client'),
(15, 'Allen_03', '$2y$10$uwsFJVrAvuTynbhXihcIbuUJ6E3/sG0DVHEtMp8JrDOuaqfjacptq', '$2y$10$117MWjruWBPPAlGvLjiPleZspQWtzl1v/Wg2h/g6e2GDrtuOyE7Jm', 'client');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `crop_table`
--
ALTER TABLE `crop_table`
  ADD PRIMARY KEY (`crop_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `expenses_record`
--
ALTER TABLE `expenses_record`
  ADD PRIMARY KEY (`expense_id`),
  ADD KEY `crop_id` (`crop_id`);

--
-- Indexes for table `profit`
--
ALTER TABLE `profit`
  ADD PRIMARY KEY (`profit_id`),
  ADD KEY `total_exp_id` (`total_exp_id`),
  ADD KEY `total_sls_id` (`total_sls_id`);

--
-- Indexes for table `sales_record`
--
ALTER TABLE `sales_record`
  ADD PRIMARY KEY (`sales_id`),
  ADD KEY `crop_id` (`crop_id`);

--
-- Indexes for table `total_expense`
--
ALTER TABLE `total_expense`
  ADD PRIMARY KEY (`total_exp_id`),
  ADD KEY `crop_id` (`crop_id`);

--
-- Indexes for table `total_sales`
--
ALTER TABLE `total_sales`
  ADD PRIMARY KEY (`total_sls_id`),
  ADD KEY `crop_id` (`crop_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `crop_table`
--
ALTER TABLE `crop_table`
  MODIFY `crop_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=38;

--
-- AUTO_INCREMENT for table `expenses_record`
--
ALTER TABLE `expenses_record`
  MODIFY `expense_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=99;

--
-- AUTO_INCREMENT for table `profit`
--
ALTER TABLE `profit`
  MODIFY `profit_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sales_record`
--
ALTER TABLE `sales_record`
  MODIFY `sales_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `total_expense`
--
ALTER TABLE `total_expense`
  MODIFY `total_exp_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `total_sales`
--
ALTER TABLE `total_sales`
  MODIFY `total_sls_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `crop_table`
--
ALTER TABLE `crop_table`
  ADD CONSTRAINT `crop_table_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `user` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `expenses_record`
--
ALTER TABLE `expenses_record`
  ADD CONSTRAINT `expenses_record_ibfk_2` FOREIGN KEY (`crop_id`) REFERENCES `crop_table` (`crop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `profit`
--
ALTER TABLE `profit`
  ADD CONSTRAINT `profit_ibfk_1` FOREIGN KEY (`total_exp_id`) REFERENCES `total_expense` (`total_exp_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `profit_ibfk_2` FOREIGN KEY (`total_sls_id`) REFERENCES `total_sales` (`total_sls_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `sales_record`
--
ALTER TABLE `sales_record`
  ADD CONSTRAINT `sales_record_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `crop_table` (`crop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `total_expense`
--
ALTER TABLE `total_expense`
  ADD CONSTRAINT `total_expense_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `crop_table` (`crop_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `total_sales`
--
ALTER TABLE `total_sales`
  ADD CONSTRAINT `total_sales_ibfk_1` FOREIGN KEY (`crop_id`) REFERENCES `crop_table` (`crop_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
