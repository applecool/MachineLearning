-- phpMyAdmin SQL Dump
-- version 4.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Apr 27, 2016 at 02:18 AM
-- Server version: 10.1.9-MariaDB
-- PHP Version: 5.5.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommerce1`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` smallint(5) UNSIGNED NOT NULL,
  `category` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category`) VALUES
(1, 'Music'),
(2, 'Fashion'),
(3, 'Car'),
(4, 'Real Estate'),
(5, 'Beauty'),
(6, 'Travel'),
(7, 'Design'),
(8, 'Food'),
(9, 'Wedding'),
(10, 'Movie'),
(11, 'Photography'),
(12, 'Law'),
(13, 'Health'),
(14, 'Green'),
(15, 'Technology'),
(16, 'SEO'),
(17, 'History'),
(18, 'Marketing'),
(19, 'Lifestyle'),
(20, 'University'),
(21, 'Dog'),
(22, 'Money'),
(23, 'Business'),
(24, 'Fitness'),
(25, 'Education'),
(26, 'Science'),
(27, 'Shopping'),
(28, 'Entertainment'),
(29, 'Sports'),
(30, 'Cat'),
(31, 'Social Media'),
(32, 'Medical'),
(33, 'Wine'),
(34, 'Celebrity Gossip'),
(35, 'DIY'),
(36, 'Nature'),
(37, 'Gaming'),
(38, 'Pet'),
(39, 'Finance'),
(40, 'Political'),
(41, 'Career'),
(42, 'Parenting'),
(43, 'Economics');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `category_UNIQUE` (`category`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` smallint(5) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
