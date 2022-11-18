-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2022 at 02:16 AM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `popstop`
--

-- --------------------------------------------------------

--
-- Table structure for table `song`
--

CREATE TABLE `song` (
  `id` int(10) NOT NULL,
  `userid` int(10) NOT NULL,
  `title` varchar(255) NOT NULL,
  `artist` varchar(255) NOT NULL,
  `year` int(4) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `country` varchar(255) NOT NULL,
  `album` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `song`
--

INSERT INTO `song` (`id`, `userid`, `title`, `artist`, `year`, `genre`, `country`, `album`, `created_at`) VALUES
(1, 1, 'Lavender Haze', 'Taylor Swift', 2022, 'Pop', 'United States', 'Midnights', '2022-11-12 00:59:42'),
(2, 2, 'Lift Me Up', 'Rihanna', 2022, 'Pop', 'United States', 'Black Panther', '2022-11-12 00:59:42'),
(3, 3, 'COZY', 'Beyonce', 2022, 'Pop', 'United States', 'RENAISSANCE', '2022-11-12 00:59:42'),
(4, 1, 'As It Was', 'Harry Styles', 2022, 'Pop', 'United States', 'As It Was', '2022-11-12 00:59:42'),
(5, 2, 'Shirt', 'SZA', 2022, 'Pop', 'United States', 'Shirt', '2022-11-12 00:59:42'),
(6, 3, 'Made You Look', 'Meghan Trainor', 2022, 'Pop', 'United States', 'Takin\' It Back', '2022-11-12 00:59:42'),
(7, 1, 'My Mind & Me', 'Selena Gomez', 2022, 'Pop', 'United States', 'My Mind & Me', '2022-11-12 00:59:42'),
(8, 2, 'La Bachata', 'Manuel Turizo', 2022, 'Pop', 'Spain', 'La Bachata', '2022-11-12 00:59:42'),
(9, 3, 'Levitating', 'Dua Lipa', 2020, 'Pop', 'United States', 'Future Nostalgia', '2022-11-12 00:59:42'),
(10, 1, 'Physical', 'Dua Lipa', 2020, 'Pop', 'United States', 'Future Nostalgia', '2022-11-12 00:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `email` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `email`, `username`, `password`, `created_at`) VALUES
(1, 'vb20190013@student.fon.bg.ac.rs', 'viktorija', 'viktorija', '2022-11-12 00:36:28'),
(2, 'ivanp@gmail.com', 'ivan', 'ivan1234', '2022-11-12 00:36:28'),
(3, 'nikolina@gmail.com', 'nikolina', 'nikolica', '2022-11-12 00:44:42');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `song`
--
ALTER TABLE `song`
  ADD PRIMARY KEY (`id`),
  ADD KEY `userid` (`userid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `song`
--
ALTER TABLE `song`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `song`
--
ALTER TABLE `song`
  ADD CONSTRAINT `song_ibfk_1` FOREIGN KEY (`userid`) REFERENCES `user` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
