-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 22, 2023 at 03:37 PM
-- Server version: 10.5.20-MariaDB
-- PHP Version: 7.3.33

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `id21674725_php_test`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin_users`
--

DROP TABLE IF EXISTS `admin_users`;
CREATE TABLE `admin_users` (
  `id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `role` varchar(50) DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `admin_users`
--

INSERT INTO `admin_users` (`id`, `username`, `password`, `email`, `role`) VALUES
(1, 'administrator123', '$2y$10$GeniJS7lsj/GtjY4WsrfbeV7Di68F1UmpjrSC733KkRVkPMGwhDhm', 'rstheme.sagar@gmail.com', 'administrator'),
(2, 'test-admin123', '$2y$10$R.V8XLRpCHvQeX5Y0mY09.RL8DEolLWodjC5w8TJabxgGzuhLTXuK', 'test@gmail.com', 'admin'),
(3, 'user123', '$2y$10$a9lugGXdBUYdgWfc3jDCqeWOP8ZGkPhleHXVKvz8E/pFHwox.LSce', 'user@gmail.com', 'user'),
(6, 'Rajib Mollah ', '$2y$10$yPc5JeAgMsid31V/f.t.TOnIxQzsA3KQE8pg63Sfe8HOxLFmqDULG', 'rajibrishat99@gmail.com', 'admin');

-- --------------------------------------------------------

--
-- Table structure for table `blog_posts`
--

DROP TABLE IF EXISTS `blog_posts`;
CREATE TABLE `blog_posts` (
  `id` int(11) NOT NULL,
  `title` varchar(255) NOT NULL,
  `content` text NOT NULL,
  `image_path` varchar(255) DEFAULT NULL,
  `author` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blog_posts`
--

INSERT INTO `blog_posts` (`id`, `title`, `content`, `image_path`, `author`, `created_at`) VALUES
(1, 'Hi, I’m Sagar - Web Developer.', 'Hi I am a Front-End developer & I can build your website as you want. I can customize plugin & wordpress theme. And I have five years of experience in figma. Now I am able to design your portfolio.\r\n\r\nI have 4.5+ years of experience with HTML, CSS, JavaScript, React, WordPress, Joomla. And I can Design Your web application. To visit my personal portfolio rect site visit:\r\n<a href=\"https://portfolio-sagar.vercel.app\" target=\"_blank\">https://portfolio-sagar.vercel.app</a>', 'uploads/blog/avatar.sagar.png', 'administrator123', '2023-12-15 21:45:15'),
(2, 'Blog post info', 'The blog post feature is perfectly working, but if you want to post a blog you will need to be a (admin) user.', '', 'administrator123', '2023-12-15 21:47:32'),
(3, 'Want to test this site?', 'As (Administrator)\r\nUser: administrator123\r\nPass: administrator123\r\n<br>\r\n<br>\r\nAs (admin)\r\nUser: test-admin123\r\nPass: test-admin123\r\n<br>\r\n<br>\r\nAs (visitor or user)\r\nUser: user123\r\nPass: user123', '', 'administrator123', '2023-12-15 21:55:57'),
(7, 'Hi', 'Pic', 'uploads/blog/Screenshot_2023-12-21-17-53-04-846_com.zhiliaoapp.musically.jpg', 'Rajib Mollah ', '2023-12-21 15:16:31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin_users`
--
ALTER TABLE `admin_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `blog_posts`
--
ALTER TABLE `blog_posts`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin_users`
--
ALTER TABLE `admin_users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `blog_posts`
--
ALTER TABLE `blog_posts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
