-- phpMyAdmin SQL Dump
-- version 4.9.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 16, 2020 at 02:16 PM
-- Server version: 10.4.8-MariaDB
-- PHP Version: 7.3.11

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cmpdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `ad_id` int(255) NOT NULL,
  `ad_title` varchar(20) NOT NULL,
  `ad_type` varchar(20) NOT NULL,
  `ad_description` varchar(200) NOT NULL,
  `ad_price` varchar(15) NOT NULL,
  `ad_state` varchar(15) NOT NULL,
  `ad_town` varchar(20) NOT NULL,
  `ad_sellername` varchar(100) NOT NULL,
  `ad_contact` varchar(11) NOT NULL,
  `ad_email` varchar(20) NOT NULL,
  `ad_status` enum('0','1') NOT NULL DEFAULT '1',
  `ad_date` varchar(40) NOT NULL,
  `user_id` int(20) NOT NULL,
  `url` varchar(255) DEFAULT NULL,
  `ad_image` mediumblob DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`ad_id`, `ad_title`, `ad_type`, `ad_description`, `ad_price`, `ad_state`, `ad_town`, `ad_sellername`, `ad_contact`, `ad_email`, `ad_status`, `ad_date`, `user_id`, `url`, `ad_image`) VALUES
(6, 'Super mum portrait', 'Item for sale', ' Super mum portrait', '4000', 'Bauchi', 'Bauchi', 'Davo', '08076767768', 'wizedavis@yahoo.com', '1', 'Friday, 08-03-2019 09:35:32pm', 1, 'super-mum-portrait', 0x2f75706c6f6164732f312d48617070792d42697274686461792d53757065722d4d6f746865722e6a7067),
(7, 'Eunice Portrait', 'Item for sale', ' fvdvf', '20000', 'Kaduna', 'Zaria', 'Davo', '098993333', 'wizedavis@yahoo.com', '1', 'Friday, 08-03-2019 09:37:46pm', 1, 'eunice-portrait', 0x2f75706c6f6164732f65756e696365312e6a7067);

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

CREATE TABLE `comment` (
  `comment_id` int(255) NOT NULL,
  `name` varchar(20) NOT NULL,
  `comment_body` varchar(200) NOT NULL,
  `comment_date` varchar(20) NOT NULL,
  `comment_email` varchar(30) NOT NULL,
  `comment_status` enum('0','1') NOT NULL DEFAULT '0',
  `post_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `manager`
--

CREATE TABLE `manager` (
  `id` int(1) NOT NULL,
  `nickname` varchar(10) NOT NULL,
  `email` varchar(15) NOT NULL,
  `password` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `manager`
--

INSERT INTO `manager` (`id`, `nickname`, `email`, `password`) VALUES
(1, 'Dave', 'admin@yahoo.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `post`
--

CREATE TABLE `post` (
  `post_id` int(255) NOT NULL,
  `post_title` varchar(30) NOT NULL,
  `seo_title` varchar(50) NOT NULL,
  `post_body` varchar(1000) NOT NULL,
  `post_date` varchar(40) NOT NULL,
  `post_user` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `post`
--

INSERT INTO `post` (`post_id`, `post_title`, `seo_title`, `post_body`, `post_date`, `post_user`) VALUES
(1, 'This is a blogpost', 'this-is-a-blogpost', '', 'Monday, 02-04-2018 at 04:09:40pm', '');

-- --------------------------------------------------------

--
-- Table structure for table `product`
--

CREATE TABLE `product` (
  `id` int(255) NOT NULL,
  `category` varchar(30) NOT NULL,
  `type` varchar(15) NOT NULL,
  `title` varchar(50) NOT NULL,
  `description` varchar(255) NOT NULL,
  `price` varchar(15) NOT NULL,
  `state` varchar(15) NOT NULL,
  `town` varchar(20) NOT NULL,
  `name` varchar(100) NOT NULL,
  `contact` varchar(11) NOT NULL,
  `createdate` varchar(30) NOT NULL,
  `ipadd` varchar(80) DEFAULT NULL,
  `ua` varchar(180) DEFAULT NULL,
  `status` enum('0','1') NOT NULL DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(20) NOT NULL,
  `nickname` varchar(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `password` varchar(15) NOT NULL,
  `gender` enum('Male','Female') NOT NULL,
  `userlevel` enum('a','b') NOT NULL DEFAULT 'a',
  `ip` varchar(255) NOT NULL,
  `signupdate` varchar(30) NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `useroptions`
--

CREATE TABLE `useroptions` (
  `id` int(11) NOT NULL,
  `email` varchar(25) NOT NULL,
  `question` varchar(255) NOT NULL,
  `answer` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `user_id` int(20) NOT NULL,
  `user_nickname` varchar(15) NOT NULL,
  `user_email` varchar(30) NOT NULL,
  `user_password` varchar(15) NOT NULL,
  `user_ip` varchar(30) NOT NULL,
  `user_signupdate` varchar(40) NOT NULL,
  `activated` enum('0','1') NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`user_id`, `user_nickname`, `user_email`, `user_password`, `user_ip`, `user_signupdate`, `activated`) VALUES
(1, 'Dave', 'dave@yahoo.com', '123456', '::1', 'Wednesday, 21-03-2018 09:46:47pm', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`ad_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `comment`
--
ALTER TABLE `comment`
  ADD PRIMARY KEY (`comment_id`),
  ADD KEY `post_id` (`post_id`);

--
-- Indexes for table `manager`
--
ALTER TABLE `manager`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `post`
--
ALTER TABLE `post`
  ADD PRIMARY KEY (`post_id`);

--
-- Indexes for table `product`
--
ALTER TABLE `product`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `useroptions`
--
ALTER TABLE `useroptions`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`),
  ADD UNIQUE KEY `user_email` (`user_email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `ad_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `comment`
--
ALTER TABLE `comment`
  MODIFY `comment_id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `manager`
--
ALTER TABLE `manager`
  MODIFY `id` int(1) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `post`
--
ALTER TABLE `post`
  MODIFY `post_id` int(255) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `product`
--
ALTER TABLE `product`
  MODIFY `id` int(255) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(20) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(20) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `ads_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `comment_ibfk_1` FOREIGN KEY (`post_id`) REFERENCES `post` (`post_id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
