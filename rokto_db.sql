-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 29, 2021 at 05:48 AM
-- Server version: 10.4.6-MariaDB
-- PHP Version: 7.3.9

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `rokto_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(11) NOT NULL,
  `uname` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `uname`, `email`, `password`, `created_at`) VALUES
(1, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2021-08-28 18:08:55'),
(2, 'nahid', 'nahid@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2021-08-28 18:08:55');

-- --------------------------------------------------------

--
-- Table structure for table `blood_requests`
--

CREATE TABLE `blood_requests` (
  `id` int(11) NOT NULL,
  `Name` varchar(50) DEFAULT NULL,
  `email` varchar(50) DEFAULT NULL,
  `phone_primary` varchar(50) DEFAULT NULL,
  `extra_contact` varchar(50) DEFAULT NULL,
  `blood_group` varchar(3) NOT NULL,
  `num_bag` int(1) DEFAULT NULL,
  `district` varchar(50) DEFAULT NULL,
  `message` varchar(200) DEFAULT NULL,
  `when_needed` varchar(50) DEFAULT NULL,
  `reuested_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `blood_requests`
--

INSERT INTO `blood_requests` (`id`, `Name`, `email`, `phone_primary`, `extra_contact`, `blood_group`, `num_bag`, `district`, `message`, `when_needed`, `reuested_at`) VALUES
(1, 'Abidur Rahman', 'abid@gmail.com', '01934322894', '01775935284', 'B+', 4, NULL, 'emergency blood needed in dmc within 11pm', '2021-07-23', '2021-07-23 19:20:39');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `first_name` varchar(50) NOT NULL,
  `last_name` varchar(50) NOT NULL,
  `age` int(3) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `blood_group` varchar(3) NOT NULL,
  `district` varchar(50) NOT NULL,
  `next_donation_date` date NOT NULL,
  `eligible` int(1) DEFAULT NULL,
  `email` varchar(50) NOT NULL,
  `phone` varchar(50) NOT NULL,
  `password` varchar(50) NOT NULL,
  `nid_front` varchar(250) NOT NULL,
  `nid_back` varchar(250) NOT NULL,
  `verified` tinyint(1) NOT NULL DEFAULT 1,
  `created_at` datetime DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `first_name`, `last_name`, `age`, `gender`, `blood_group`, `district`, `next_donation_date`, `eligible`, `email`, `phone`, `password`, `nid_front`, `nid_back`, `verified`, `created_at`) VALUES
(1, 'John', 'Doe', 20, 'male', 'A+', 'Dhaka', '0000-00-00', 1, 'john@gmail.com', '01234567890', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 04:43:53'),
(2, 'Stephen', 'Moreno', 22, 'male', 'A+', 'Chittagong', '0000-00-00', 1, 'stephen@gmail.com', '66124391033', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 04:45:26'),
(3, 'Patrick', 'Hicks', 25, 'male', 'A+', 'Dhaka', '0000-00-00', 1, 'patrick@gmail.com', '01823234345', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 04:46:31'),
(4, 'Lila', 'Nunez', 21, 'female', 'B+', 'Dhaka', '0000-00-00', 1, 'lila@gmail.com', '1230983444', '827ccb0eea8a706c4c34a16891f84e7b', '', '', 1, '2021-07-02 04:47:23'),
(5, 'Johnnie', 'Lawrence', 18, 'male', 'B+', 'Dhaka', '0000-00-00', 1, 'johnnie@gmail.com', '0193422894', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 05:38:28'),
(6, 'Nina', 'Foster', 18, 'female', 'A-', 'Dhaka', '0000-00-00', 1, 'nina@gmail.com', '0193422394', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 05:38:28'),
(9, 'Kohnnie', 'Lawrence', 18, 'male', 'B+', 'Dhaka', '0000-00-00', 1, 'kohnnie@gmail.com', '01934222894', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 05:40:53'),
(10, 'Xohnnie', 'Lawrence', 18, 'male', 'B+', 'Dhaka', '0000-00-00', 1, 'xohnnie@gmail.com', '019321422894', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 05:40:53'),
(11, 'Abidur', 'Rahman', 38, 'male', 'AB-', 'Chittagong', '2021-07-26', 1, 'abid@gmail.com', '01934322894', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 06:00:43'),
(12, 'Rk', 'Octo', 25, 'male', 'B-', 'Dhaka', '0000-00-00', 1, 'rkokto@gmail.com', '01932112894', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 06:00:43'),
(13, 'Amir', 'Khan', 30, 'Male', 'O-', 'Barishal', '0000-00-00', 1, 'amir@gmail.com', '88013244234', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 12:00:01'),
(14, 'Rakib', 'Khan', 23, 'Male', 'O-', 'Shariatpur', '0000-00-00', 0, 'rakib@gmail.com', '88013243234', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 12:00:01'),
(15, 'Mehedi', 'Hasan', 29, 'Male', 'B+', 'Dhaka', '0000-00-00', 1, 'mehedi@gmail.com', '88014244234', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 12:00:01'),
(17, 'Mahbubur', 'Rahman', 30, 'Male', 'B+', 'Dhaka', '0000-00-00', 1, 'mahbub@gmail.com', '880132442341', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 12:03:42'),
(18, 'Md', 'Al-amin', 23, 'Male', 'O-', 'Shariatpur', '0000-00-00', 1, 'alamin@gmail.com', '8801324323411', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 12:03:42'),
(19, 'Masud', 'Hasan', 29, 'Male', 'B+', 'Dhaka', '0000-00-00', 1, 'masud@gmail.com', '8801424423412', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 12:03:42'),
(20, 'Niloy', 'Khan', 30, 'Male', 'B+', 'Dhaka', '0000-00-00', 1, 'niloy@gmail.com', '88013244235', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-02 12:03:42'),
(21, 'Abdullah', 'Rahman', 32, 'male', 'A+', 'Dhaka', '2021-07-26', 1, 'abcd@gmail.com', '123242342424', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-03 22:41:24'),
(24, 'Ninja', 'Hattori', 19, 'male', 'B-', 'Dhaka', '0000-00-00', 1, 'ninja@gmail.com', '01922232332', '81dc9bdb52d04dc20036dbd8313ed055', '', '', 1, '2021-07-19 23:28:28');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `blood_requests`
--
ALTER TABLE `blood_requests`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD UNIQUE KEY `phone` (`phone`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `blood_requests`
--
ALTER TABLE `blood_requests`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
