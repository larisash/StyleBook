-- phpMyAdmin SQL Dump
-- version 4.7.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 25, 2017 at 01:28 PM
-- Server version: 10.1.22-MariaDB
-- PHP Version: 7.1.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `fakebook`
--

-- --------------------------------------------------------

--
-- Table structure for table `posts`
--

CREATE TABLE `posts` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `article` text NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `posts`
--

INSERT INTO `posts` (`id`, `user_id`, `title`, `article`, `date`) VALUES
(2, 2, 'Moshe post', 'Hi i am moshe levi and i love fakebooks', '2017-07-23 11:31:57'),
(3, 2, 'Moshe new post 2017', 'My new post will be first now!!!', '2017-07-23 11:45:13'),
(5, 2, 'hahahahaa', 'fsdfsdf', '2017-07-23 15:18:18'),
(6, 3, 'kjghj', 'ghjghj', '2017-07-25 12:00:27'),
(7, 3, 'dfgdfg', 'i am the &#34;best&#34;', '2017-07-25 12:03:19'),
(8, 1, 'Avi post demo 123', 'My post is the best man! 123', '2017-07-25 13:15:03');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `avatar` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `avatar`, `created_at`) VALUES
(1, 'Avi Cohen', 'avi@gmail.com', '$2y$10$wcKe57299re2BK3mhsNvQuH6drZaBSEMPxTvHfurgha8SERVyBnky', '2017.07.25.13.24.21-seopf.jpg', '2017-07-23 00:00:00'),
(2, 'Moshe Levi', 'moshe@gmail.com', '$2y$10$wcKe57299re2BK3mhsNvQuH6drZaBSEMPxTvHfurgha8SERVyBnky', '2017.07.25.13.23.36-sylvester-stallone-1.jpg', '2017-07-23 00:00:00'),
(3, 'Nancy Gerber', 'nanc@gmail.com', '$2y$10$Hr/gbS11PpPrgd8lgx.UZ.P.dk938TGIwTqGA3F07xVS1Qcyvn6pm', 'default.jpg', '2017-07-25 12:00:14'),
(4, 'Popeye', 'popeye@gmail.com', '$2y$10$dR9VdkTjqVvsnD4uIaYWq.0crJNuRc.Hbn9gfwjr7cVAVbubQekq6', 'default.jpg', '2017-07-25 13:42:58'),
(5, 'Oliv', 'oliv@gmail.com', '$2y$10$2N/PPtZNHzW2StN1KQe6oeZb3bmg6cHNoochAbcNgp65smSjAfpsW', 'default.jpg', '2017-07-25 13:51:23'),
(6, 'ivan', 'ivan@gmail.com', '$2y$10$TR4kfsNB..QuvHfxNS8t7O6/MJnZYCu9jmqt5xa3pbtLtKOpd1bhy', 'default.jpg', '2017-07-25 13:53:25');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `posts`
--
ALTER TABLE `posts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `posts`
--
ALTER TABLE `posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
