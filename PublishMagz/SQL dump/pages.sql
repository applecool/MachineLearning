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
-- Table structure for table `pages`
--

CREATE TABLE `pages` (
  `id` int(10) UNSIGNED NOT NULL,
  `categories_id` smallint(5) UNSIGNED NOT NULL,
  `title` varchar(100) NOT NULL,
  `description` tinytext NOT NULL,
  `content` longtext,
  `date_created` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Created_By` varchar(45) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`id`, `categories_id`, `title`, `description`, `content`, `date_created`, `Created_By`) VALUES
(4, 15, 'Test Page', 'This is technology', '<p>Hello technology</p>', '2016-04-06 23:13:46', 'user1'),
(5, 15, 'How to make a robot', 'Introduction to Robotics 101', '<p>Firstly, to learn robotics, the concepts of mechanics are very important. The Dynamics and Kinematics play a very important role in the creation of a robot. The robot consists of a mechanical motion over any part which does the work. Predominantly, converting electrical energy into mechanical energy. The robot can be programmed to do several tasks.</p>', '2016-04-07 06:55:23', 'user1'),
(6, 25, 'Purdue Northwest', 'The tale of the merge of two campuses.', '<p>The North Central and the Calumet campuses have been merged together to form Northwest. This is the pride of the North West Indiana. It is pretty cool.</p>', '2016-04-07 18:58:08', 'user1'),
(7, 21, 'Healthy Dog Food', 'Healthy food tips for dogs', '<p>Dogs are very friendly animals. They need to be given healthy food to keep them wonderful</p>', '2016-04-16 18:08:39', 'user1'),
(8, 30, 'Cat Food', 'Pro tips for Cat Diets', '<p>Cats are very playful. To keep them healthy, good food should be provided to them</p>', '2016-04-16 18:11:44', 'user1'),
(9, 8, 'Great Food Places in Chicago', 'Top food places in Chicago', '<p>Chicago is known for its amazing food and during summer there are so many food trucks around where you can get tease your taste buds for magnificent scrumptious food.&nbsp;</p>', '2016-04-17 20:32:01', 'user1'),
(10, 8, 'Top 10 food places in New York', 'Best food joints in the city of NYC', '<p>New York&nbsp;is known for its amazing food and during summer there are so many food trucks around where you can get tease your taste buds for magnificent scrumptious food.&nbsp;</p>', '2016-04-17 20:33:39', 'user1'),
(11, 8, 'Food in Nashville', 'Top food places in Nashville', '<p>Nashville&nbsp;is known for its fantastic country music&nbsp;and apart from that during summer there are so many food trucks around where you can get tease your taste buds for magnificent scrumptious food.&nbsp;</p>', '2016-04-17 20:41:46', 'user1'),
(12, 8, 'Food in Wisconsin', 'Top 10 places for food in Wisconsin', '<p>Wisconsin&nbsp;is known for its dairy&nbsp;food and during summer there are so many food trucks around where you can get tease your taste buds for magnificent scrumptious food.&nbsp;</p>', '2016-04-17 20:43:01', 'user1'),
(13, 8, 'Dog Food', 'Food for Dogs', '<p>Food food food food food food food dog dog dog</p>', '2016-04-18 00:59:31', 'user1'),
(14, 2, 'rose', 'HEY this is test article', '<p>test descriptions</p>', '2016-04-19 22:05:44', 'user1'),
(15, 8, 'sandwiches', 'test sandwich', '<p>php is not fun</p>', '2016-04-19 22:15:02', ''),
(16, 28, 'Friends', 'test', '<p>test fun</p>', '2016-04-19 22:19:15', 'user1'),
(17, 35, 'Know ThySelf', 'test content', '<p>dsjahdiusahjdzn</p>\r\n<p>skahDUSADSA</p>\r\n<p>D;LSAJISUAD</p>\r\n<p>Asakdisadas</p>\r\n<p>dsakhdua</p>', '2016-04-20 17:37:17', 'user1'),
(18, 28, 'How to play Monopoly', 'Rules of Monopoly', '<p>Monopoly rules are pretty straight forward. First each player gets money from the bank.&nbsp;Besides the Bank''s money, the MONOPOLY Bank holds the Title Deed cards and houses and hotels prior to purchase and use by the players. The Bank pays salaries and bonuses. It sells and auctions properties and hands out their proper Title Deed cards; it sells houses and hotels to the players and loans money when required on mortgages.</p>', '2016-04-20 17:59:54', 'harry'),
(19, 30, 'Cat 101', 'Details regarding the cats', '<p>Testing cats</p>', '2016-04-20 22:13:25', 'harry');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pages`
--
ALTER TABLE `pages`
  ADD PRIMARY KEY (`id`),
  ADD KEY `date_created` (`date_created`),
  ADD KEY `fk_pages_categories_idx` (`categories_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pages`
--
ALTER TABLE `pages`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `pages`
--
ALTER TABLE `pages`
  ADD CONSTRAINT `fk_pages_categories` FOREIGN KEY (`categories_id`) REFERENCES `categories` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
