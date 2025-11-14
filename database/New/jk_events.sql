-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2025 at 11:23 PM
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
-- Database: `jk_events`
--

-- --------------------------------------------------------

--
-- Table structure for table `bookings`
--

CREATE TABLE `bookings` (
  `id` int(11) NOT NULL,
  `user_id` int(10) NOT NULL,
  `event_id` int(11) NOT NULL,
  `booked_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `bookings`
--

INSERT INTO `bookings` (`id`, `user_id`, `event_id`, `booked_at`) VALUES
(1, 3, 4, '2025-11-12 22:11:12'),
(2, 4, 3, '2025-11-12 22:20:59'),
(3, 4, 1, '2025-11-12 22:22:15');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `id` int(11) NOT NULL,
  `name` varchar(255) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `date` varchar(50) DEFAULT NULL,
  `time` varchar(50) DEFAULT NULL,
  `venue` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`id`, `name`, `address`, `date`, `time`, `venue`, `description`) VALUES
(1, 'Rooftop Party', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3843.637235006917!2d73.75138417517113!3d15.557565985050156!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfea1b61600e59%3A0x6b929808fc6a3d63!2sTitos%20Lane%202%2C%20Calangute%2C%20Baga%2C%20Goa%20403516!5e0!3m2!1sen!2sin!4v1759675056231!5m2!1sen!2sin', 'Oct 10, 2025', '8:00 PM - 11:00 PM', 'Tito\'s Lane, Baga', 'Enjoy music and cocktails under the stars.'),
(2, 'Live Jazz Night', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3848.0523242706245!2d73.89883360000002!3d15.31939134761993!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfb72368ad2b01%3A0x14c1d4be3eda2839!2sJamming%20Goat!5e0!3m2!1sen!2sin!4v1759672758566!5m2!1sen!2sin', 'Oct 15, 2025', '9:00 PM - 12:00 AM', 'Jamming Goat, Uttorda', 'A night of live jazz performances.'),
(3, 'Dance Marathon', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61486.892632927134!2d73.67235305454062!3d15.595346251509667!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfe97ed6a83d0f%3A0xd1a1cfca5155695!2sHill%20Top%20Goa!5e0!3m2!1sen!2sin!4v1759672899256!5m2!1sen!2sin', 'Oct 20, 2025', '10:00 PM - 4:00 AM', 'Hill Top, Calangute', 'Dance the night away with top DJs.'),
(4, 'Gourmet Food Truck Festival', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d61563.81671612563!2d73.82459484863283!3d15.336437499999999!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfb75a2b8cb455%3A0x6bc5208b914e66cb!2sSnack%20O\'%20Mania%20Food%20Truck!5e0!3m2!1sen!2sin!4v1759674082027!5m2!1sen!2sin', 'Oct 25, 2025', '6:00 PM - 11:00 PM', 'Snack O\' Mania Food Truck, Arossim', 'Explore late-night gourmet food options.'),
(5, 'Midnight Movie Screening', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3846.619637317851!2d73.81035717512191!3d15.397072485189232!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3bbfc7bc0ccea897%3A0xe99fc990322ef9ae!2s1930%20Vasco!5e0!3m2!1sen!2sin!4v1759674550773!5m2!1sen!2sin', 'Oct 31, 2025', '12:00 AM onwards', '1930 Vasco Mall, Vasco da Gama', 'Midnight screening of classic hits.');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) NOT NULL,
  `FirstName` varchar(50) NOT NULL,
  `LastName` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `FirstName`, `LastName`, `Email`, `Password`) VALUES
(2, 'Koushik', 'Sharma', '1974kamalsharma@gmail.com', '202cb962ac59075b964b07152d234b70'),
(3, 'first', 'last', 'first@last.com', '834ed7f08cb3fb15cf4d112b824a19ec'),
(4, 'user2', 'secons', 'user2@eg.com', '7e58d63b60197ceb55a1c487989a3720');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bookings`
--
ALTER TABLE `bookings`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `event_id` (`event_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
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
-- AUTO_INCREMENT for table `bookings`
--
ALTER TABLE `bookings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bookings`
--
ALTER TABLE `bookings`
  ADD CONSTRAINT `bookings_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `bookings_ibfk_2` FOREIGN KEY (`event_id`) REFERENCES `events` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
