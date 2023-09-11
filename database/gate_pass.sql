-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 18, 2023 at 10:17 PM
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
-- Database: `gate_pass`
--

-- --------------------------------------------------------

--
-- Table structure for table `account_details`
--

CREATE TABLE `account_details` (
  `id` int(11) NOT NULL,
  `name` longtext DEFAULT NULL,
  `email` longtext DEFAULT NULL,
  `phone_number` longtext DEFAULT NULL,
  `matric_no` varchar(10) DEFAULT NULL,
  `home_address` longtext DEFAULT NULL,
  `user_password` varchar(10) DEFAULT NULL,
  `role` varchar(250) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `account_details`
--

INSERT INTO `account_details` (`id`, `name`, `email`, `phone_number`, `matric_no`, `home_address`, `user_password`, `role`) VALUES
(10, 'xasore', 'xasore7634@wiroute.com', '09025911134', '20/2022', 'no4 okeola street', '000000', 'Student'),
(11, 'nna benjamin', 'nnabenjamin1@gmail.com', '888888888888', '00/0000', 'no4 okeola street', '000000', 'Student'),
(12, 'Nna Benjamin', 'nnabenjamin@gmail.com', '99999999999', NULL, NULL, '0000000', 'Admin'),
(13, 'Jack Samson', 'nnabenjamin10@gmail.com', '999999999999', NULL, NULL, '0000000', 'Admin'),
(14, 'Adeniran Wale', 'iriry6uyvh@klovenode.com', '333333333333', '11/1111', 'no1 onajo street', '0000000', 'Student'),
(15, 'Njoku Udio', 'genej60987@wiroute.com', '999999999999', '30/3030', 'no4 okeola street', '000000', 'Student'),
(16, 'Nna Amarachi', 'nnaamarachi@gmail.com', '999999999', '17/1717', 'mafoluku', '000000', 'Student'),
(17, 'nabifow925', 'nabifow925@proexbol.com', '09099999999', '99/9090', 'victoria island', '000000', 'Student'),
(18, 'tipovi', 'tipovi@ema-sofia.eu', '90909090909', '91/9191', 'victoria island jab', '000000', 'Student'),
(19, 'sajon65633', 'sajon65633@luxeic.com', '00000000000', '06/5633', 'mafoluku lagos', '000000', 'Student'),
(20, 'nofige1109', 'nofige1109@terkoer.com', '99999999999', '12/1109', 'Fct Abuja', '000000', 'Student'),
(21, 'vobede5430', 'vobede5430@proexbol.com', '000000000000', '23/5430', 'no4 okeola street', '000000', 'Student'),
(22, 'TONY HAM', 'nnabenjaminz@gmail.com', '00000000000', NULL, NULL, '000000', 'Hod'),
(23, 'virtugirke', 'jatenor839@oniecan.com', '00000000000', '92/5555', 'victoria island jab', '000000', 'Student'),
(24, 'mr afilaka', 'nnaz@gmail.com', '00000000000', NULL, NULL, '000000', 'lecturers');

-- --------------------------------------------------------

--
-- Table structure for table `gate_pass_request`
--

CREATE TABLE `gate_pass_request` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `approved` varchar(6) DEFAULT NULL,
  `approved_by` int(11) DEFAULT NULL,
  `Hod` varchar(250) NOT NULL,
  `lecturers` varchar(250) NOT NULL,
  `destination_state` longtext DEFAULT NULL,
  `destination_city` longtext DEFAULT NULL,
  `date_of_exit` varchar(15) DEFAULT NULL,
  `date_of_return` varchar(15) DEFAULT NULL,
  `time_of_exit` varchar(10) DEFAULT NULL,
  `guardian_name` longtext DEFAULT NULL,
  `guardian_phone_number` longtext DEFAULT NULL,
  `time_of_return` varchar(15) DEFAULT NULL,
  `reason_l` varchar(1100) NOT NULL,
  `date_created` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `gate_pass_request`
--

INSERT INTO `gate_pass_request` (`id`, `user_id`, `approved`, `approved_by`, `Hod`, `lecturers`, `destination_state`, `destination_city`, `date_of_exit`, `date_of_return`, `time_of_exit`, `guardian_name`, `guardian_phone_number`, `time_of_return`, `reason_l`, `date_created`) VALUES
(4, 11, 'false', 11, 'true', 'true', 'Lagos', 'Lagos', '06-03-2023', '06-03-2023', '00:17:37 a', 'tony stack', '9999999999', '00:17:37 am', 'going on a vacation', '2023-03-06'),
(8, 14, 'false', 14, 'true', 'true', 'Abia', 'Ohafia', '09-03-2023', '05-03-2024', '01:36:15 a', 'Faith Zach', '999999999999', '00:17:37 am', 'going to the village', '2023-03-09'),
(10, 15, 'true', 15, 'true', 'true', 'Lagos', 'Lagos', '09-03-2023', '05-03-2024', '01:47:17 a', 'tony stack', '000000000000', '15:41:47 pm', 'going on a vacation', '2023-03-09'),
(11, 16, 'true', 16, 'true', 'true', 'Ogun State', 'ikenne', '09-03-2023', '05-03-2024', '08:09:08 a', 'tony stack', '00000000000', '00:17:37 am', 'Visitation', '2023-03-09'),
(12, 17, 'true', 17, 'true', 'true', 'Abuja', 'FCT', '09-03-2023', '05-03-2024', '20:40:56 p', 'Mr Nna', '99999999999', '00:13:56 am', 'Traveling ourside country', '2023-03-09'),
(13, 18, 'true', 18, 'true', 'true', 'Abuja', 'Lagos', '09-03-2023', '05-03-2024', '21:10:51 p', 'Mr ZACH', '00000000000', '15:20:33 pm', 'going on a trip', '2023-03-09'),
(14, 19, 'true', 19, 'true', 'true', 'Kano', 'akwa', '09-03-2023', '05-03-2024', '21:19:44 p', 'Mr Sam', '00000000000', '15:41:47 pm', 'Traveling ourside Nigeria', '2023-03-09'),
(15, 20, 'true', 20, 'true', 'true', 'Benue', 'Ifo', '09-03-2023', '05-03-2024', '21:26:39 p', 'Jonah', '00000000000', '00:17:37 am', 'To see a friend', '2023-03-09'),
(16, 21, 'false', 21, 'true', 'true', 'Lagos', 'ikenne', '09-03-2023', '06-03-2024', '22:56:22 p', 'Mr Jane', '999999999999', '15:41:47 pm', 'Visitation of someone', '2023-03-09'),
(17, 10, 'true', 10, 'true', 'true', 'Lagos', 'Lagos', '10-03-2023', '05-03-2024', '22:58:48 p', 'tony stack', '000000000000', '15:20:33 pm', 'Traveling ourside country', '2023-03-10'),
(18, 23, 'true', 23, 'false', '', 'Ogun State', 'akwa', '11-03-2023', '05-03-2024', '23:10:33 p', 'Mr Nna', '00000000000', '15:20:33 pm', 'Visitation', '2023-03-11');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account_details`
--
ALTER TABLE `account_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `gate_pass_request`
--
ALTER TABLE `gate_pass_request`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `account_details`
--
ALTER TABLE `account_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `gate_pass_request`
--
ALTER TABLE `gate_pass_request`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
