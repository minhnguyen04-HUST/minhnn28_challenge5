-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Oct 01, 2024 at 04:54 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `login`
--

-- --------------------------------------------------------

--
-- Table structure for table `files`
--

CREATE TABLE `files` (
  `id` int(11) NOT NULL,
  `filename` varchar(200) NOT NULL,
  `filesize` int(11) NOT NULL,
  `filetype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `files`
--

INSERT INTO `files` (`id`, `filename`, `filesize`, `filetype`) VALUES
(1, 'md5-1.jpg', 123910, 'image/jpeg'),
(2, 'md5-2.pdf', 968, 'application/pdf'),
(3, 'md5-2.pdf', 968, 'application/pdf');

-- --------------------------------------------------------

--
-- Table structure for table `leaveMessage`
--

CREATE TABLE `leaveMessage` (
  `id` int(11) NOT NULL,
  `fromUser` varchar(100) NOT NULL,
  `toUser` varchar(100) NOT NULL,
  `content` varchar(1000) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaveMessage`
--

INSERT INTO `leaveMessage` (`id`, `fromUser`, `toUser`, `content`) VALUES
(1, 'thanh123', 'thanh123', 'Hi thanh'),
(2, 'teacher1', 'student2', 'Hello Kiet, chuc mot ngay moi tot lanh!');

-- --------------------------------------------------------

--
-- Table structure for table `quiz`
--

CREATE TABLE `quiz` (
  `id` int(11) NOT NULL,
  `hint` varchar(1000) NOT NULL,
  `filename` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `quiz`
--

INSERT INTO `quiz` (`id`, `hint`, `filename`) VALUES
(7, 'Day la mot bai tho cua Huy Can duoc hoc trong truong cap 2. Bai tho noi ve canh sinh hoat cua nguoi dan tren bien', 'quiz/doan thuyen danh ca.txt');

-- --------------------------------------------------------

--
-- Table structure for table `studentSubmit`
--

CREATE TABLE `studentSubmit` (
  `id` int(11) NOT NULL,
  `username` varchar(100) NOT NULL,
  `filename` varchar(100) NOT NULL,
  `filesize` int(11) NOT NULL,
  `filetype` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `studentSubmit`
--

INSERT INTO `studentSubmit` (`id`, `username`, `filename`, `filesize`, `filetype`) VALUES
(2, 'thanh123', 'md5-2.pdf', 968, 'application/pdf'),
(1, 'thanh123', 'md5-2-1.pdf', 968, 'application/pdf'),
(1, 'vu123', 'md5-2.pdf', 968, 'application/pdf'),
(2, 'vu123', 'md5-2-1-1.pdf', 968, 'application/pdf'),
(3, 'student1', 'md5-2-1.pdf', 968, 'application/pdf');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `firstName` varchar(50) NOT NULL,
  `lastName` varchar(50) NOT NULL,
  `username` varchar(100) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `phone` varchar(10) NOT NULL,
  `image` varchar(100) DEFAULT NULL,
  `isTeacher` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `firstName`, `lastName`, `username`, `email`, `password`, `phone`, `image`, `isTeacher`) VALUES
(4, 'Minh', 'Nguyen', 'minhnguyen123', 'minh@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', '0915090104', '', 1),
(5, 'Truong ', 'An', 'minh1', 'an@gmail.com', 'e2fc714c4727ee9395f324cd2e7f331f', '0987654321', '', 1),
(6, 'Ngoc Nguyen', 'Kiet', 'kiet123', 'kiet@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '5678901234', '', 0),
(7, 'Tuan', 'Thanh', 'thanh123', 'thanh@gmail.com', '202cb962ac59075b964b07152d234b70', '8901234567', 'image/avatar_66f234e455603.png', 0),
(8, 'Tuan', 'Kiet', 'kiet123ngu', 'kiet123@gmail.com', 'e80b5017098950fc58aad83c8c14978e', '0987635421', '', 0),
(9, 'An Minh', 'Ngu', 'minh1234', 'minhkongu@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '1234567890', '', 0),
(10, 'Le Duc Anh', 'Vu', 'vu123', 'vu123@gmail.com', '81dc9bdb52d04dc20036dbd8313ed055', '0912345678', 'image/dog.jpeg', 0),
(11, 'Minh', 'Nguyen', 'minh123', 'minhlequydon8@gmail.com', '202cb962ac59075b964b07152d234b70', '0915090104', NULL, 1),
(12, 'Nguyen', 'Minh', 'teacher1', 'minh1234@gmail.com', 'f83e69e4170a786e44e3d32a2479cce9', '0912345678', NULL, 1),
(14, 'Vu', 'An', 'student1', 'an1234@gmail.com', 'f83e69e4170a786e44e3d32a2479cce9', '0967854321', 'image/md5-1.jpg', 0),
(15, 'Nguyen Ngoc Truong', 'Kiet', 'student2', 'kiet1234@gmail.com', 'f83e69e4170a786e44e3d32a2479cce9', '0399953051', NULL, 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `files`
--
ALTER TABLE `files`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaveMessage`
--
ALTER TABLE `leaveMessage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `quiz`
--
ALTER TABLE `quiz`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `files`
--
ALTER TABLE `files`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `leaveMessage`
--
ALTER TABLE `leaveMessage`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `quiz`
--
ALTER TABLE `quiz`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
