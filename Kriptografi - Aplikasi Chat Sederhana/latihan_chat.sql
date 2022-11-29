-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 29, 2022 at 06:23 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 8.0.10

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `latihan_chat`
--

-- --------------------------------------------------------

--
-- Table structure for table `chat_message`
--

CREATE TABLE `chat_message` (
  `chat_message_id` int(11) NOT NULL,
  `to_user_id` int(11) NOT NULL,
  `from_user_id` int(11) NOT NULL,
  `chat_message` text DEFAULT NULL,
  `status_message` tinyint(4) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `chat_message`
--

INSERT INTO `chat_message` (`chat_message_id`, `to_user_id`, `from_user_id`, `chat_message`, `status_message`, `created_at`) VALUES
(33, 3, 4, 'jdea', 0, '2022-11-25 18:23:11'),
(34, 3, 4, 'halo', 0, '2022-11-25 18:23:11'),
(35, 3, 4, 'cvmo', 0, '2022-11-25 18:23:11'),
(36, 3, 4, 'iw`~`tD^W\'$', 0, '2022-11-25 18:23:11'),
(37, 3, 5, 'jdea4hBUW/*', 0, '2022-11-25 18:20:32'),
(38, 4, 3, 'Y3Ztb2d/', 0, '2022-11-25 20:18:33'),
(39, 4, 3, 'wqrn', 0, '2022-11-25 20:18:33'),
(40, 4, 3, 'pizbtCU', 0, '2022-11-25 20:18:33'),
(41, 4, 3, 'piz', 0, '2022-11-25 20:18:33'),
(50, 4, 3, 'lddo4hBUWa,>	??', 0, '2022-11-25 20:18:33'),
(51, 4, 3, 'lddo4hBUWa,>	??', 0, '2022-11-25 20:18:33'),
(52, 4, 3, 'ldhc4hBUWa,>	??', 0, '2022-11-25 20:18:33'),
(53, 4, 3, 'cvz}ghP_E2>)??????', 0, '2022-11-25 20:18:33'),
(54, 4, 3, 'cvmjpGHR%)>??????wO :???kT6??oW8??n\\???I', 0, '2022-11-25 20:18:33'),
(55, 0, 3, 'asdadsad', 1, '2022-11-25 20:17:04'),
(57, 4, 3, '31h}pzPHP ><	?????', 0, '2022-11-25 20:18:33'),
(58, 3, 4, 'cvmogPMR );??????', 0, '2022-11-29 15:51:32'),
(59, 3, 4, '`dnepHG]*&1??????rX ?', 0, '2022-11-29 15:51:32'),
(60, 3, 5, 'HALOOOOOOOOOOOOOO', 1, '2022-11-25 20:24:38'),
(61, 0, 5, 'asddddddddddddddddddddddasdasdas', 1, '2022-11-25 20:25:09'),
(62, 3, 5, 'asdasdasdas', 1, '2022-11-25 20:25:26'),
(63, 3, 5, 'asdasdasdasdasdasdas', 1, '2022-11-25 20:26:29'),
(64, 3, 5, 'asdasdasdasdasdasdas', 1, '2022-11-25 20:26:29'),
(65, 3, 6, 'halo nama saya muhammad farhan harvito', 0, '2022-11-29 15:48:46'),
(66, 3, 4, 'terima kasih', 0, '2022-11-29 15:51:32'),
(67, 6, 4, 'nama saya muhammad farhan harvito', 1, '2022-11-29 15:48:28'),
(68, 6, 3, 'halo nama saya', 1, '2022-11-29 15:48:54'),
(69, 4, 3, 'v`{kf~Q', 0, '2022-11-29 16:29:53'),
(70, 6, 3, 'jdea4uBAWa>;??????rOd8???/X3??d', 1, '2022-11-29 15:51:55'),
(71, 6, 3, NULL, 1, '2022-11-29 15:53:40'),
(72, 6, 3, NULL, 1, '2022-11-29 15:53:50'),
(73, 6, 3, 'YXNkYXNk', 1, '2022-11-29 16:00:14'),
(74, 6, 3, 'aGFsbyBuYW1hIHNheWEgYWRhbGFo', 1, '2022-11-29 16:00:23'),
(75, 6, 3, 'cGVya2VuYWxrYW4gbmFtYSBzYXlhIG11aGFtbWFkIGZhcmhhbiBoYXJ2aXRvIG5pbSAxMjMyMDAwMjk=', 1, '2022-11-29 16:00:37'),
(76, 6, 3, 'pTIln2IhLJkeLJ4=', 1, '2022-11-29 16:02:39'),
(77, 6, 3, 'pTIln2IhLJkeLJ4tozSgLFOmLKyuVTSxLJkunPOgqJuuoJ1uMPOzLKWbLJ4tnTSlqzy0oj==', 1, '2022-11-29 16:02:47'),
(78, 3, 4, 'nTSfolOhLJ1uVUAurJRtLJEuoTSbVT11nTSgoJSxVTMupzuuovObLKW2nKEi', 1, '2022-11-29 16:30:05');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `user_id` int(11) NOT NULL,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`user_id`, `username`, `password`) VALUES
(3, 'bebek', '$2y$10$DuXxneUDOY/6ZlLsJl5Zt.NTb7rSXZiQj2IVZg9/Qw225rppyRu3u'),
(4, 'admin', '$2y$10$wrhDdc9u3Irj8Ktr0e/Eyep8ZdXpiIFosnlP8tWtzfIGG48BGptvi'),
(6, 'halodek', '$2y$10$RxU2xgDavoJZI7psZiBxjus19DBempawJK402SLX.FP5lH4ceVYWO'),
(9, 'harvito', 'c85c9f7ff8ebeb3dfef2218802ee6ad7'),
(10, 'testing', 'ae2b1fca515949e5d54fb22b8ed95575');

-- --------------------------------------------------------

--
-- Table structure for table `login_details`
--

CREATE TABLE `login_details` (
  `is_type` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `last_activity` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `login_details`
--

INSERT INTO `login_details` (`is_type`, `user_id`, `last_activity`) VALUES
(21, 3, '2022-11-22 01:01:25'),
(32, 5, NULL),
(33, 4, NULL),
(34, 4, NULL),
(35, 6, NULL),
(36, 4, NULL),
(37, 3, NULL),
(38, 4, NULL),
(39, 4, NULL),
(40, 10, NULL),
(41, 9, NULL),
(42, 4, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `chat_message`
--
ALTER TABLE `chat_message`
  ADD PRIMARY KEY (`chat_message_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`user_id`);

--
-- Indexes for table `login_details`
--
ALTER TABLE `login_details`
  ADD PRIMARY KEY (`is_type`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `chat_message`
--
ALTER TABLE `chat_message`
  MODIFY `chat_message_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=79;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `login_details`
--
ALTER TABLE `login_details`
  MODIFY `is_type` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
