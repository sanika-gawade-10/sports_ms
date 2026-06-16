-- phpMyAdmin SQL Dump
-- version 5.2.3
-- https://www.phpmyadmin.net/
--
-- Host: db
-- Generation Time: Apr 27, 2026 at 03:47 PM
-- Server version: 8.0.45
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sports_ms`
--

-- --------------------------------------------------------

--
-- Table structure for table `achievements`
--

CREATE TABLE `achievements` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `stream` varchar(50) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `roll` varchar(20) DEFAULT NULL,
  `sport` varchar(100) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `event_date` date DEFAULT NULL,
  `description` text,
  `image` varchar(255) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `is_sent` int DEFAULT '0',
  `images` text,
  `status` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `achievements`
--

INSERT INTO `achievements` (`id`, `name`, `stream`, `year`, `roll`, `sport`, `level`, `event_date`, `description`, `image`, `username`, `is_sent`, `images`, `status`) VALUES
(1, 'Sanika Gawade', 'IT', 'TY', '12', 'Badminton', 'State', '2026-05-07', 'I won a gold medal in badminton ehfkjfugfujkfgeywiejowkeyeff', 'coffee.jpg', 'sanika', 0, NULL, 'Unapproved'),
(2, 'Prachi Kolte', 'BAF', 'SY', '22', 'Badminton', 'State', '2026-06-12', 'hello', NULL, 'sanika', 0, '1776697180_coffee.jpg', 'Unapproved'),
(3, 'Prachi Kolte', 'BAF', 'SY', '11', 'chess', 'State', '2026-06-12', 'carrom', NULL, 'sanika', 0, '1776697794_coffee.jpg', 'Approved'),
(4, 'parth', 'BSc', 'FY', '12', 'carrom', 'College', '2026-04-30', 'hyegybdeb', NULL, 'sanika', 0, '1776746975_coffee.jpg', 'Unapproved'),
(5, 'parth', 'BCom', 'SY', '11', 'Badminton', 'State', '2026-04-30', 'hello parth here', NULL, 'sanika', 0, '1776749420_୧_‧₊˚___miles_morales_and_Gwen_Stacy.jpg', 'Approved'),
(6, 'hello', 'BSc', 'FY', '34', 'swimming', 'College', '2026-04-23', 'I have participated in Swimming. Won gold medal.', NULL, 'sanika', 0, '1776750909_img1.webp,1776750927_laptop.jpeg', 'Unapproved'),
(7, 'parth', 'BSc', 'FY', '34', 'swimming', 'College', '2026-04-30', 'hello i won gold medal.', NULL, 'sanika', 0, '1776752249_image_map.jpg,1776752262_coffee.jpg,1776752278_pic_2.webp', 'Approved'),
(8, 'hello', 'BSc', 'FY', '22', 'swimming', 'College', '2026-04-30', 'hello here I ammm', NULL, 'sanika', 0, '1776871888_pic1.jpg,1776871906_laptop.jpeg,1776871919_coffee.jpg', 'Approved'),
(9, 'hello', 'BSc', 'FY', '22', 'swimming', 'College', '2026-04-29', 'hellooo swimming', NULL, 'sanika', 0, '1776873718_img1.webp', 'Unapproved');

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int NOT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin', 'admin@104');

-- --------------------------------------------------------

--
-- Table structure for table `participation`
--

CREATE TABLE `participation` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `roll` varchar(20) DEFAULT NULL,
  `sport` varchar(100) DEFAULT NULL,
  `level` varchar(50) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'Pending',
  `username` varchar(50) DEFAULT NULL,
  `is_sent` int DEFAULT '0',
  `stream` varchar(50) DEFAULT NULL,
  `year` varchar(10) DEFAULT NULL,
  `event_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `participation`
--

INSERT INTO `participation` (`id`, `name`, `class`, `roll`, `sport`, `level`, `status`, `username`, `is_sent`, `stream`, `year`, `event_date`) VALUES
(22, 'Sanika Gawade', NULL, '12', 'carrom', 'State', 'Approved', 'sanika', 1, 'IT', 'TY', NULL),
(23, 'Sanika Gawade', NULL, '12', 'Badminton', 'College', 'Approved', 'sanika', 1, 'BSc', 'TY', NULL),
(24, 'Sanika Gawade', NULL, '11', 'chess', 'State', 'Approved', 'sanika', 1, 'IT', 'FY', '2026-05-05'),
(25, 'parth', NULL, '34', 'swimming', 'State', 'Approved', 'sanika', 1, 'BMS', 'SY', '2026-04-22'),
(26, 'Prachi Kolte', NULL, '11', 'carrom', 'College', 'Approved', 'sanika', 1, 'BAF', 'SY', '2026-04-10'),
(27, 'parth', NULL, '11', 'carrom', 'College', 'Approved', 'sanika', 1, 'BA', 'SY', '2026-04-22'),
(28, 'Prachi Kolte', NULL, '60', 'Badminton', 'College', 'Unapproved', 'sanika', 1, 'BCom', 'FY', '2026-04-22');

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `class` varchar(50) DEFAULT NULL,
  `roll` varchar(20) DEFAULT NULL,
  `username` varchar(50) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `class`, `roll`, `username`, `password`) VALUES
(4, 'Sanika Gawade', 'TYBSCIT', '12', 'sanika', '$2y$10$.0tyrSqiul1pNTcIz7uSXOnRT8l1PcSqVGn2f3GGgqH3UtGJztWSm');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `achievements`
--
ALTER TABLE `achievements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- Indexes for table `participation`
--
ALTER TABLE `participation`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `username` (`username`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `achievements`
--
ALTER TABLE `achievements`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `participation`
--
ALTER TABLE `participation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
