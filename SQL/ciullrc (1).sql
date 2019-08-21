-- phpMyAdmin SQL Dump
-- version 4.8.5
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 21, 2019 at 03:40 PM
-- Server version: 10.1.40-MariaDB
-- PHP Version: 7.3.5

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ciullrc`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` varchar(60) NOT NULL,
  `name` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `cell` int(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `picture` varchar(225) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `issuer_admin_id` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `name`, `password`, `status`, `cell`, `email`, `picture`, `create_date`, `issuer_admin_id`) VALUES
('aanonno', 'Shadman Saif', '$2y$10$4LxtsrWI9B/qlUOLzRt69.bBgxqYnkKudU5TI.qUUePDWqatDRzmW', 'active', 1818285563, 'anonno77@gmail.com', 'admin_image/aanonno.jpg', '2019-08-12 19:26:08', 'aanonno'),
('ashadman', 'Shadman Saif Anonno', '$2y$10$nBCCl6DBNxi3a9H5GMwgO.lJbbRuvSFC6MFTuzqU6vHvLnKV3GQBu', 'active', 1869554488, 'shadman@gmail.com', 'admin_image/ashadman.jpg', '2019-08-20 17:15:00', 'aanonno');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE `book` (
  `isbn` bigint(15) NOT NULL,
  `title` varchar(255) NOT NULL,
  `author` varchar(60) NOT NULL,
  `publisher` varchar(60) NOT NULL,
  `year_published` int(4) NOT NULL,
  `edition` int(5) NOT NULL,
  `category` varchar(60) NOT NULL,
  `popularity_last_year` bigint(20) NOT NULL,
  `popularity_last_month` bigint(20) NOT NULL,
  `popularity_total` bigint(20) NOT NULL,
  `inventory` int(20) NOT NULL,
  `leased` int(20) NOT NULL,
  `picture` varchar(255) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`isbn`, `title`, `author`, `publisher`, `year_published`, `edition`, `category`, `popularity_last_year`, `popularity_last_month`, `popularity_total`, `inventory`, `leased`, `picture`, `create_date`) VALUES
(9780134414239, 'Chemistry: The Central Science', 'Theodore E. Brown', 'Pearson', 2018, 14, 'Science', 0, 0, 0, 14, 1, 'book_image/9780134414239.jpg', '2019-08-16 22:21:52'),
(9780789757746, 'C++ in One Hour a Day, Sams Teach Yourself', 'Siddhartha Rao ', 'Sams Publishing', 2017, 8, 'Programming', 0, 0, 0, 10, 0, 'book_image/9780789757746.jpg', '2019-08-16 22:07:41'),
(9780981454221, 'Accounting Made Simple: Accounting Explained in 100 Pages or Less ', 'Mike Piper', 'Simple Subjects, LLC', 2013, 1, 'Accounting', 0, 0, 0, 15, 0, 'book_image/9780981454221.jpg', '2019-08-16 22:07:41'),
(9780997308457, 'Advertising Strategy: A 360 Degree Brand Approach', 'Larry D. Kelley, Kim Bartel Sheehan', 'Melvin & Leigh', 2017, 1, 'Marketing', 0, 0, 0, 5, 0, 'book_image/9780997308457.jpg', '2019-08-16 22:07:41'),
(9780999685907, 'Teach yourself Programming', 'John Doe', 'Fast Book Printing', 2016, 3, 'Programming', 0, 0, 0, 7, 1, 'book_image/9780999685907.jpg', '2019-08-16 22:07:41'),
(9780999685908, 'Learn Coding', 'Jane Doe', 'Fast Book Printing', 2018, 2, 'Programming', 0, 0, 0, 18, 0, 'book_image/9780999685908.jpg', '2019-08-16 22:07:41'),
(9781138673526, 'Electrical and Electronic Principles and Technology', 'John Bird', 'Routledge', 2017, 6, 'Electrical', 0, 0, 0, 25, 0, 'book_image/9781138673526.jpg', '2019-08-16 22:07:41'),
(9781478611790, 'Law, Courts, and Justice in America, Seventh Edition', 'Howard Abadinsky', 'Waveland Press, Inc', 2014, 7, 'Law', 0, 0, 0, 8, 0, 'book_image/9781478611790.jpg', '2019-08-16 22:07:41'),
(9781491912058, 'Python Data Science Handbook: Essential Tools for Working with Data', 'Jake VanderPlas', 'O\'Reilly Media', 2016, 1, 'IT', 0, 0, 0, 5, 0, 'book_image/9781491912058.jpg', '2019-08-16 22:07:41');

-- --------------------------------------------------------

--
-- Table structure for table `leasing`
--

CREATE TABLE `leasing` (
  `id` int(11) NOT NULL,
  `isbn` bigint(13) NOT NULL,
  `student_id` int(11) NOT NULL,
  `admin_id` varchar(60) NOT NULL,
  `issue_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `due_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `leasing`
--

INSERT INTO `leasing` (`id`, `isbn`, `student_id`, `admin_id`, `issue_date`, `due_date`) VALUES
(1, 9780134414239, 16202000, 'aanonno', '2019-08-21 15:52:50', '2019-08-27');

-- --------------------------------------------------------

--
-- Table structure for table `request`
--

CREATE TABLE `request` (
  `id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `isbn` bigint(20) NOT NULL,
  `create_date` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `request`
--

INSERT INTO `request` (`id`, `student_id`, `isbn`, `create_date`, `status`) VALUES
(4, 16202007, 9780999685907, '2019-08-21 11:33:57', 'ready');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `id` int(11) NOT NULL,
  `name` varchar(60) NOT NULL,
  `password` varchar(255) NOT NULL,
  `status` varchar(20) NOT NULL,
  `cell` int(20) NOT NULL,
  `email` varchar(60) NOT NULL,
  `department` varchar(10) NOT NULL,
  `school` varchar(10) NOT NULL,
  `credit_system` varchar(10) NOT NULL,
  `picture` varchar(225) NOT NULL,
  `create_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `renew_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valid_till` date DEFAULT NULL,
  `last_issuer_id` varchar(60) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`id`, `name`, `password`, `status`, `cell`, `email`, `department`, `school`, `credit_system`, `picture`, `create_date`, `renew_date`, `valid_till`, `last_issuer_id`) VALUES
(16202000, 'Student One', '$2y$10$z0nG1Tnd6S2Ft6H148ZjDe/jshW1IfvZXkKQQV0aPqJOv33arZ5PG', 'active', 1710000000, 'student_one@gmail.com', 'CSE', 'SSE', 'open', 'student_image/16202000.jpg', '2019-08-15 00:00:27', '2019-08-15 20:33:33', '2020-01-01', 'aanonno'),
(16202002, 'Student Two', '$2y$10$dVpGLHcc3yex.3PDeBB.c.Fn/Z4QCKM6pKIeMijfkwxCfzNtOhFKG', 'pending', 1710000002, 'student_two@gmail.com', 'LLB', 'SOL', 'closed', 'student_image/16202002.jpg', '2019-08-15 00:01:57', '2019-08-20 20:51:38', '2019-08-16', 'aanonno'),
(16202004, 'Student Four', '$2y$10$C.D./Y6LhMr23bmqMF18f.VmbO8QFL7Jj9..h6LmfGCdEpv6Ewc5.', 'pending', 1710000004, 'student_four@gmail.com', 'Accounting', 'CIUBS', 'closed', 'student_image/16202004.jpg', '2019-08-15 00:05:47', '2019-08-15 00:05:47', NULL, 'none'),
(16202007, 'Shadman Saif Anonno', '$2y$10$yyEuvinT9rCFw5RRFkfhFObNVTjtRgwjzhh9sek4pi30lGB4HFxOO', 'active', 1818285563, 'email@gmail.com', 'CS', 'SSE', 'open', 'student_image/16202007.jpg', '2019-08-10 23:39:02', '2019-08-21 17:45:17', '2019-08-31', 'aanonno'),
(16202010, 'Student Ten', '$2y$10$.L.4ojneKTH4v9DISi408u8V2n6Uv1N5GPwNEu3g4miRoXHMkN40m', 'pending', 1710000010, 'student_ten@gmail.com', 'ETE', 'SSE', 'closed', 'student_image/16202010.jpg', '2019-08-15 15:46:17', '2019-08-15 15:46:17', NULL, 'none'),
(16202011, 'Student Eleven', '$2y$10$nZYqPFbF.3b9QYCfeUuVSO4V7JjVUkLy8/BLH9877FyJSHTrTUxW6', 'pending', 1710000011, 'student_eleven@gmail.com', 'CE', 'SSE', 'open', 'student_image/16202011.jpg', '2019-08-15 15:47:07', '2019-08-15 15:47:07', NULL, 'none'),
(16202012, 'Student Twelve', '$2y$10$0QTuVmrbrzGBFg27qXdQi.ymnbL.HtcFjGHa.h7o.0ZKLPrqEr7XG', 'pending', 1710000012, 'student_twelve@gmail.com', 'CSE', 'SSE', 'open', 'student_image/16202012.jpg', '2019-08-15 15:48:17', '2019-08-15 15:48:17', NULL, 'none'),
(16202013, 'Student Thirteen', '$2y$10$/cSSQ2vTgjWCihzv.7xBQ.fyqHyDjEiH3waHX9mSYumOHKTR7rtDS', 'pending', 1710000013, 'student_thirteen@gmail.com', 'CSE', 'SSE', 'open', 'student_image/16202013.jpg', '2019-08-15 19:45:36', '2019-08-15 19:45:36', NULL, 'none'),
(16202014, 'Student 14', '$2y$10$WoiYbtIUIsN98xYO1xiUquA9eUoAtkRpbOd6vSuqFJ9.9nXSB2NfC', 'pending', 1710000014, '14@gmail.com', 'CSE', 'SSE', 'open', 'student_image/16202014.jpg', '2019-08-15 19:46:33', '2019-08-15 19:46:33', NULL, 'none'),
(16202016, 'Student 16', '$2y$10$VEdcp708HU8ijTVi18dE8O/up.btvJlVtPQjbxpAc9uJGrhJEdnOC', 'pending', 1710000016, '16@gmail.com', 'CSE', 'SSE', 'open', 'student_image/16202016.jpg', '2019-08-15 19:47:26', '2019-08-15 19:47:26', NULL, 'none'),
(16202017, 'Student 17 Updates', '$2y$10$vzYfVt6rvoRp.sM.ueMKoOqHA5wByUwcv1jV8peREHkDyXk7QD556', 'pending', 1710000017, '17@gmail.com', 'CSE', 'SSE', 'open', 'student_image/16202017.jpg', '2019-08-15 19:48:09', '2019-08-20 14:54:40', '2019-08-22', 'aanonno'),
(16202020, 'Student 20 Updated', '$2y$10$8dHn0DBDXvTgUqEvtRnnCOJfuCT8jB5GTBWbkaEyedFyQZn7Xsd1m', 'pending', 1710000020, '20@gmail.com', 'CSE', 'SSE', 'open', 'student_image/16202020.jpg', '2019-08-15 19:49:02', '2019-08-15 22:56:43', '2020-01-01', 'aanonno'),
(16502053, 'Three Updated', '$2y$10$XDGBFLD4MLvdJs0yOzwDd.qlbJ8CKLw35CiTpgUIToXNnz0LGm4kG', 'pending', 1710000003, 'student_three@gmail.com', 'EEE', 'SSE', 'open', 'student_image/16502053.jpg', '2019-08-15 00:04:16', '2019-08-20 20:46:44', '2019-08-01', 'aanonno');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `cell_no` varchar(12) NOT NULL,
  `email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `book`
--
ALTER TABLE `book`
  ADD PRIMARY KEY (`isbn`);
ALTER TABLE `book` ADD FULLTEXT KEY `title` (`title`);
ALTER TABLE `book` ADD FULLTEXT KEY `author` (`author`,`publisher`);
ALTER TABLE `book` ADD FULLTEXT KEY `title_2` (`title`);
ALTER TABLE `book` ADD FULLTEXT KEY `author_2` (`author`);
ALTER TABLE `book` ADD FULLTEXT KEY `publisher` (`publisher`);

--
-- Indexes for table `leasing`
--
ALTER TABLE `leasing`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`),
  ADD KEY `admin_id` (`admin_id`);

--
-- Indexes for table `request`
--
ALTER TABLE `request`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `leasing`
--
ALTER TABLE `leasing`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `request`
--
ALTER TABLE `request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `leasing`
--
ALTER TABLE `leasing`
  ADD CONSTRAINT `leasing_ibfk_1` FOREIGN KEY (`student_id`) REFERENCES `student` (`id`),
  ADD CONSTRAINT `leasing_ibfk_2` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
