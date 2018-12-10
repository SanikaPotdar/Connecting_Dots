-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 10, 2018 at 01:17 PM
-- Server version: 10.1.37-MariaDB
-- PHP Version: 7.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `connecting_dots`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) UNSIGNED NOT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `phone_num` int(10) DEFAULT NULL,
  `email_id` varchar(100) NOT NULL,
  `address` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `first_name`, `last_name`, `phone_num`, `email_id`, `address`) VALUES
(1, 'Sanika', 'Potdar', 1111111111, 'example1@example.com', 'Mumbai'),
(2, 'Ketaki', 'Velhal', 1222222222, 'example2@example.com', 'Pune'),
(3, 'Aayushi', 'Sikligar', 1122222222, 'example3@example.com', 'Nashik');

-- --------------------------------------------------------

--
-- Table structure for table `professional_request_records`
--

CREATE TABLE `professional_request_records` (
  `professional_id` int(11) UNSIGNED NOT NULL,
  `Req_id` int(11) UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `req_id` int(11) UNSIGNED NOT NULL,
  `job` varchar(50) NOT NULL DEFAULT '',
  `description` text NOT NULL,
  `status` enum('NEW','ONGOING','REJECTED','HIRED','COMPLETED') NOT NULL DEFAULT 'NEW',
  `budget` float NOT NULL DEFAULT '5',
  `dates` date NOT NULL,
  `client_id` int(11) UNSIGNED DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`req_id`, `job`, `description`, `status`, `budget`, `dates`, `client_id`) VALUES
(501, 'Photography', 'Want a wedding photographer crew for my marriage.', 'NEW', 5000, '2018-12-25', 1),
(502, 'Computer Repair', 'Want to repair the shitty computer of my fiance from which he made the previous request.', 'NEW', 10000, '2018-12-13', 3),
(503, 'Home tutor', 'Need a home tutor for the subjeccts math and sanskrit.', 'NEW', 20000, '2019-01-01', 1),
(504, 'Interior designing', 'Need an interior designer to create a contemporary look of the house.', 'NEW', 50000, '2018-12-31', 2);

-- --------------------------------------------------------

--
-- Table structure for table `service_professional`
--

CREATE TABLE `service_professional` (
  `professional_id` int(11) UNSIGNED NOT NULL,
  `name` varchar(50) NOT NULL,
  `address` varchar(200) DEFAULT NULL,
  `contact_num` int(10) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `service_professional`
--

INSERT INTO `service_professional` (`professional_id`, `name`, `address`, `contact_num`, `email`, `password`) VALUES
(101, 'John Doe', 'Santacruz,Mumbai, India', 1777777777, 'photo_example@example.com', '1234'),
(102, 'Judy Ohara', 'Grant Road, Mumbai, India', 1888888888, 'repairs_example@example.com', '5678'),
(103, 'Bula Sweet', 'Shaniwar Wada, Pune, India', 199999999, 'tutor_example@example.com', 'abcd'),
(104, 'Liliana Kirklin', 'Hanovar Drive, Spring Hill, US', 166666666, 'designer_example@example.com', 'efgh'),
(105, 'Bella Kraus', 'Vasi, new mumbai, India', 123456789, 'agent_example@example.com', '1a2b3c'),
(106, 'John Doe', 'Ghatkopar Mumbai', 1000000000, 'john_doe@example.com', 'babudu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `professional_request_records`
--
ALTER TABLE `professional_request_records`
  ADD PRIMARY KEY (`professional_id`,`Req_id`),
  ADD KEY `fk_req_3` (`Req_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`req_id`),
  ADD KEY `fk_client_1` (`client_id`);

--
-- Indexes for table `service_professional`
--
ALTER TABLE `service_professional`
  ADD PRIMARY KEY (`professional_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `req_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=505;

--
-- AUTO_INCREMENT for table `service_professional`
--
ALTER TABLE `service_professional`
  MODIFY `professional_id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=107;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `professional_request_records`
--
ALTER TABLE `professional_request_records`
  ADD CONSTRAINT `fk_professional_3` FOREIGN KEY (`professional_id`) REFERENCES `service_professional` (`professional_id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_req_3` FOREIGN KEY (`Req_id`) REFERENCES `request` (`req_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `request`
--
ALTER TABLE `request`
  ADD CONSTRAINT `fk_client_1` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
