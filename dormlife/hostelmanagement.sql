-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 18, 2025 at 08:57 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.0.30

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hostelmanagement`
--

-- --------------------------------------------------------

--
-- Table structure for table `admins_g`
--

CREATE TABLE `admins_g` (
  `AdminID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins_g`
--

INSERT INTO `admins_g` (`AdminID`, `Name`, `Username`, `Password`) VALUES
(1, 'G-ADMIN', 'GADMIN', '$2b$12$ocQFY/EN7nnpNxLvAywGx.nJRjm6CA1KTQJVBpxB9WaTS7mq2bCZG');

-- --------------------------------------------------------

--
-- Table structure for table `admins_n`
--

CREATE TABLE `admins_n` (
  `AdminID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins_n`
--

INSERT INTO `admins_n` (`AdminID`, `Name`, `Username`, `Password`) VALUES
(4, 'N-ADMIN', 'NADMIN', '$2y$10$pnCCZYjdivd7vHpyIZIGgeOwo8O6FuXoow8rL6sP3rpprGzPqob.q');

-- --------------------------------------------------------

--
-- Table structure for table `admins_v`
--

CREATE TABLE `admins_v` (
  `AdminID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admins_v`
--

INSERT INTO `admins_v` (`AdminID`, `Name`, `Username`, `Password`) VALUES
(2, 'V-ADMIN', 'VBLOCKADMIN', '$2y$10$axoIf2MqCesOh65Lcv4Ltuo./E7ZjGAHCcmUd45MUeqzg5ToIJfxu'),
(3, 'abhi', 'raj', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `gblock_beds`
--

CREATE TABLE `gblock_beds` (
  `bed_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `bed_number` int(11) NOT NULL,
  `is_booked` tinyint(1) DEFAULT 0,
  `student_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gblock_beds`
--

INSERT INTO `gblock_beds` (`bed_id`, `room_id`, `bed_number`, `is_booked`, `student_name`) VALUES
(125, 1, 1, 1, 'sita'),
(126, 1, 2, 0, NULL),
(127, 1, 3, 0, NULL),
(128, 2, 1, 0, NULL),
(129, 2, 2, 0, NULL),
(130, 2, 3, 0, NULL),
(131, 3, 1, 0, NULL),
(132, 3, 2, 0, NULL),
(133, 3, 3, 0, NULL),
(134, 4, 1, 0, NULL),
(135, 4, 2, 0, NULL),
(136, 4, 3, 0, NULL),
(137, 5, 1, 0, NULL),
(138, 5, 2, 0, NULL),
(139, 5, 3, 0, NULL),
(140, 6, 1, 0, NULL),
(141, 6, 2, 0, NULL),
(142, 6, 3, 0, NULL),
(143, 7, 1, 0, NULL),
(144, 7, 2, 0, NULL),
(145, 7, 3, 0, NULL),
(146, 8, 1, 0, NULL),
(147, 8, 2, 0, NULL),
(148, 8, 3, 0, NULL),
(149, 9, 1, 0, NULL),
(150, 9, 2, 0, NULL),
(151, 9, 3, 0, NULL),
(152, 10, 1, 0, NULL),
(153, 10, 2, 0, NULL),
(154, 10, 3, 0, NULL),
(155, 11, 1, 0, NULL),
(156, 11, 2, 0, NULL),
(157, 11, 3, 0, NULL),
(158, 12, 1, 0, NULL),
(159, 12, 2, 0, NULL),
(160, 12, 3, 0, NULL),
(161, 13, 1, 0, NULL),
(162, 13, 2, 0, NULL),
(163, 13, 3, 0, NULL),
(164, 14, 1, 0, NULL),
(165, 14, 2, 0, NULL),
(166, 14, 3, 0, NULL),
(167, 15, 1, 0, NULL),
(168, 15, 2, 0, NULL),
(169, 15, 3, 0, NULL),
(170, 16, 1, 0, NULL),
(171, 16, 2, 0, NULL),
(172, 16, 3, 0, NULL),
(173, 17, 1, 0, NULL),
(174, 17, 2, 0, NULL),
(175, 17, 3, 0, NULL),
(176, 18, 1, 0, NULL),
(177, 18, 2, 0, NULL),
(178, 18, 3, 0, NULL),
(179, 19, 1, 0, NULL),
(180, 19, 2, 0, NULL),
(181, 19, 3, 0, NULL),
(182, 20, 1, 0, NULL),
(183, 20, 2, 0, NULL),
(184, 20, 3, 0, NULL),
(185, 21, 1, 0, NULL),
(186, 21, 2, 0, NULL),
(187, 21, 3, 0, NULL),
(188, 22, 1, 0, NULL),
(189, 22, 2, 0, NULL),
(190, 22, 3, 0, NULL),
(191, 23, 1, 0, NULL),
(192, 23, 2, 0, NULL),
(193, 23, 3, 0, NULL),
(194, 24, 1, 0, NULL),
(195, 24, 2, 0, NULL),
(196, 24, 3, 0, NULL),
(197, 25, 1, 0, NULL),
(198, 25, 2, 0, NULL),
(199, 25, 3, 0, NULL),
(200, 26, 1, 0, NULL),
(201, 26, 2, 0, NULL),
(202, 26, 3, 0, NULL),
(203, 27, 1, 0, NULL),
(204, 27, 2, 0, NULL),
(205, 27, 3, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `gblock_complaints`
--

CREATE TABLE `gblock_complaints` (
  `complaint_id` int(11) NOT NULL,
  `student_username` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `complaint_text` text NOT NULL,
  `complaint_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gblock_complaints`
--

INSERT INTO `gblock_complaints` (`complaint_id`, `student_username`, `student_name`, `branch`, `complaint_text`, `complaint_date`) VALUES
(1, 'sita', 'sita', 'ISE', 'hlo admin', '2025-01-16 13:44:05');

-- --------------------------------------------------------

--
-- Table structure for table `gblock_departments`
--

CREATE TABLE `gblock_departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gblock_departments`
--

INSERT INTO `gblock_departments` (`department_id`, `department_name`) VALUES
(1, 'ISE'),
(2, 'CSE'),
(3, 'AIML'),
(4, 'EEE'),
(5, 'ECE'),
(6, 'IP'),
(7, 'BT'),
(8, 'ME'),
(9, 'CV');

-- --------------------------------------------------------

--
-- Table structure for table `gblock_rooms`
--

CREATE TABLE `gblock_rooms` (
  `room_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `room_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `gblock_rooms`
--

INSERT INTO `gblock_rooms` (`room_id`, `department_id`, `room_number`) VALUES
(1, 1, 'ISE-101'),
(2, 1, 'ISE-102'),
(3, 1, 'ISE-103'),
(4, 2, 'CSE-104'),
(5, 2, 'CSE-105'),
(6, 2, 'CSE-106'),
(7, 3, 'AIML-107'),
(8, 3, 'AIML-108'),
(9, 3, 'AIML-109'),
(10, 4, 'EEE-110'),
(11, 4, 'EEE-111'),
(12, 4, 'EEE-112'),
(13, 5, 'ECE-113'),
(14, 5, 'ECE-114'),
(15, 5, 'ECE-115'),
(16, 6, 'IP-116'),
(17, 6, 'IP-117'),
(18, 6, 'IP-118'),
(19, 7, 'BT-119'),
(20, 7, 'BT-120'),
(21, 7, 'BT-121'),
(22, 8, 'ME-122'),
(23, 8, 'ME-123'),
(24, 8, 'ME-124'),
(25, 9, 'CV-125'),
(26, 9, 'CV-126'),
(27, 9, 'CV-127');

-- --------------------------------------------------------

--
-- Table structure for table `g_announcements`
--

CREATE TABLE `g_announcements` (
  `id` int(11) NOT NULL,
  `announcement` text NOT NULL,
  `recipient` varchar(255) NOT NULL DEFAULT 'all',
  `posted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `g_announcements`
--

INSERT INTO `g_announcements` (`id`, `announcement`, `recipient`, `posted_at`) VALUES
(1, 'hlo sita', 'all', '2025-01-16 12:59:19'),
(2, 'HLO SITA', '2BA22EC123', '2025-01-16 12:59:42');

-- --------------------------------------------------------

--
-- Table structure for table `nblock_beds`
--

CREATE TABLE `nblock_beds` (
  `bed_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `bed_number` int(11) NOT NULL,
  `is_booked` tinyint(1) DEFAULT 0,
  `student_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nblock_beds`
--

INSERT INTO `nblock_beds` (`bed_id`, `room_id`, `bed_number`, `is_booked`, `student_name`) VALUES
(125, 1, 1, 0, NULL),
(126, 1, 2, 0, NULL),
(127, 1, 3, 0, NULL),
(128, 2, 1, 1, 'abhi'),
(129, 2, 2, 0, NULL),
(130, 2, 3, 0, NULL),
(131, 3, 1, 0, NULL),
(132, 3, 2, 0, NULL),
(133, 3, 3, 0, NULL),
(134, 4, 1, 0, NULL),
(135, 4, 2, 0, NULL),
(136, 4, 3, 0, NULL),
(137, 5, 1, 0, NULL),
(138, 5, 2, 0, NULL),
(139, 5, 3, 0, NULL),
(140, 6, 1, 0, NULL),
(141, 6, 2, 0, NULL),
(142, 6, 3, 0, NULL),
(143, 7, 1, 0, NULL),
(144, 7, 2, 0, NULL),
(145, 7, 3, 0, NULL),
(146, 8, 1, 0, NULL),
(147, 8, 2, 0, NULL),
(148, 8, 3, 0, NULL),
(149, 9, 1, 0, NULL),
(150, 9, 2, 0, NULL),
(151, 9, 3, 0, NULL),
(152, 10, 1, 0, NULL),
(153, 10, 2, 0, NULL),
(154, 10, 3, 0, NULL),
(155, 11, 1, 0, NULL),
(156, 11, 2, 0, NULL),
(157, 11, 3, 0, NULL),
(158, 12, 1, 0, NULL),
(159, 12, 2, 0, NULL),
(160, 12, 3, 0, NULL),
(161, 13, 1, 0, NULL),
(162, 13, 2, 0, NULL),
(163, 13, 3, 0, NULL),
(164, 14, 1, 0, NULL),
(165, 14, 2, 0, NULL),
(166, 14, 3, 0, NULL),
(167, 15, 1, 0, NULL),
(168, 15, 2, 0, NULL),
(169, 15, 3, 0, NULL),
(170, 16, 1, 0, NULL),
(171, 16, 2, 0, NULL),
(172, 16, 3, 0, NULL),
(173, 17, 1, 0, NULL),
(174, 17, 2, 0, NULL),
(175, 17, 3, 0, NULL),
(176, 18, 1, 0, NULL),
(177, 18, 2, 0, NULL),
(178, 18, 3, 0, NULL),
(179, 19, 1, 0, NULL),
(180, 19, 2, 0, NULL),
(181, 19, 3, 0, NULL),
(182, 20, 1, 0, NULL),
(183, 20, 2, 0, NULL),
(184, 20, 3, 0, NULL),
(185, 21, 1, 0, NULL),
(186, 21, 2, 0, NULL),
(187, 21, 3, 0, NULL),
(188, 22, 1, 0, NULL),
(189, 22, 2, 0, NULL),
(190, 22, 3, 0, NULL),
(191, 23, 1, 0, NULL),
(192, 23, 2, 0, NULL),
(193, 23, 3, 0, NULL),
(194, 24, 1, 0, NULL),
(195, 24, 2, 0, NULL),
(196, 24, 3, 0, NULL),
(197, 25, 1, 0, NULL),
(198, 25, 2, 0, NULL),
(199, 25, 3, 0, NULL),
(200, 26, 1, 0, NULL),
(201, 26, 2, 0, NULL),
(202, 26, 3, 0, NULL),
(203, 27, 1, 0, NULL),
(204, 27, 2, 0, NULL),
(205, 27, 3, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `nblock_complaints`
--

CREATE TABLE `nblock_complaints` (
  `complaint_id` int(11) NOT NULL,
  `student_username` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `complaint_text` text NOT NULL,
  `complaint_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nblock_complaints`
--

INSERT INTO `nblock_complaints` (`complaint_id`, `student_username`, `student_name`, `branch`, `complaint_text`, `complaint_date`) VALUES
(1, 'Darshan', 'Darshan Janiwarad', 'ISE', 'hlo admin', '2025-01-14 09:17:56'),
(2, 'abhi', 'abhi', 'AIML', 'hot water', '2025-01-14 13:40:02');

-- --------------------------------------------------------

--
-- Table structure for table `nblock_departments`
--

CREATE TABLE `nblock_departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nblock_departments`
--

INSERT INTO `nblock_departments` (`department_id`, `department_name`) VALUES
(1, 'ISE'),
(2, 'CSE'),
(3, 'AIML'),
(4, 'EEE'),
(5, 'ECE'),
(6, 'IP'),
(7, 'BT'),
(8, 'ME'),
(9, 'CV');

-- --------------------------------------------------------

--
-- Table structure for table `nblock_rooms`
--

CREATE TABLE `nblock_rooms` (
  `room_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `room_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `nblock_rooms`
--

INSERT INTO `nblock_rooms` (`room_id`, `department_id`, `room_number`) VALUES
(1, 1, 'ISE-101'),
(2, 1, 'ISE-102'),
(3, 1, 'ISE-103'),
(4, 2, 'CSE-104'),
(5, 2, 'CSE-105'),
(6, 2, 'CSE-106'),
(7, 3, 'AIML-107'),
(8, 3, 'AIML-108'),
(9, 3, 'AIML-109'),
(10, 4, 'EEE-110'),
(11, 4, 'EEE-111'),
(12, 4, 'EEE-112'),
(13, 5, 'ECE-113'),
(14, 5, 'ECE-114'),
(15, 5, 'ECE-115'),
(16, 6, 'IP-116'),
(17, 6, 'IP-117'),
(18, 6, 'IP-118'),
(19, 7, 'BT-119'),
(20, 7, 'BT-120'),
(21, 7, 'BT-121'),
(22, 8, 'ME-122'),
(23, 8, 'ME-123'),
(24, 8, 'ME-124'),
(25, 9, 'CV-125'),
(26, 9, 'CV-126'),
(27, 9, 'CV-127');

-- --------------------------------------------------------

--
-- Table structure for table `n_announcements`
--

CREATE TABLE `n_announcements` (
  `id` int(11) NOT NULL,
  `announcement` text NOT NULL,
  `recipient` varchar(255) NOT NULL DEFAULT 'all',
  `posted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `n_announcements`
--

INSERT INTO `n_announcements` (`id`, `announcement`, `recipient`, `posted_at`) VALUES
(1, 'hlo', 'all', '2025-01-13 21:14:08'),
(2, 'hlo darshan', '2BA22IS024', '2025-01-14 13:23:17'),
(3, 'hlo new comer', 'all', '2025-01-14 13:38:39'),
(4, 'hlo abhi', '2BA22IS004', '2025-01-14 13:38:56'),
(5, 'sxs', 'all', '2025-01-18 19:16:31');

-- --------------------------------------------------------

--
-- Table structure for table `rooms_g`
--

CREATE TABLE `rooms_g` (
  `RoomID` int(11) NOT NULL,
  `RoomNumber` varchar(10) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `Occupied` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms_n`
--

CREATE TABLE `rooms_n` (
  `RoomID` int(11) NOT NULL,
  `RoomNumber` varchar(10) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `Occupied` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rooms_v`
--

CREATE TABLE `rooms_v` (
  `RoomID` int(11) NOT NULL,
  `RoomNumber` varchar(10) NOT NULL,
  `Capacity` int(11) NOT NULL,
  `Occupied` int(11) DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms_v`
--

INSERT INTO `rooms_v` (`RoomID`, `RoomNumber`, `Capacity`, `Occupied`) VALUES
(1, 'ISE-01', 3, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students_g`
--

CREATE TABLE `students_g` (
  `StudentID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Phone_no` int(11) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `Year` int(11) NOT NULL,
  `Address` text NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RegisteredBy` varchar(50) DEFAULT NULL,
  `csn_usn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_g`
--

INSERT INTO `students_g` (`StudentID`, `Name`, `Phone_no`, `Department`, `Year`, `Address`, `Username`, `Password`, `RegisteredBy`, `csn_usn`) VALUES
(4, 'sita', 2147483647, 'ISE', 2, '18th cross vidyagiri bagalkot 587102\r\nkarnataka', 'sita', '$2y$10$LLF./ctAzhhvzZtIfEHjc.kLbmCH3QXS178Wg/3VEAaL2W0SvJ1Cu', 'GADMIN', '2BA22IS024');

-- --------------------------------------------------------

--
-- Table structure for table `students_n`
--

CREATE TABLE `students_n` (
  `StudentID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Phone_no` int(11) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `Year` int(11) NOT NULL,
  `Address` text NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RegisteredBy` varchar(50) DEFAULT NULL,
  `csn_usn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_n`
--

INSERT INTO `students_n` (`StudentID`, `Name`, `Phone_no`, `Department`, `Year`, `Address`, `Username`, `Password`, `RegisteredBy`, `csn_usn`) VALUES
(5, 'abhi', 2147483647, 'AIML', 2, '18th cross vidyagiri bagalkot 587102\r\nkarnataka', 'abhi', '$2y$10$an/Pmt99mSMpDvGnODBr3uKKOfKaUB6TVDymHeSwYVOfuu76ZIi0W', 'NADMIN', '2BA22IS024');

-- --------------------------------------------------------

--
-- Table structure for table `students_v`
--

CREATE TABLE `students_v` (
  `StudentID` int(11) NOT NULL,
  `Name` varchar(100) NOT NULL,
  `Phone_no` int(11) NOT NULL,
  `Department` varchar(100) NOT NULL,
  `Year` int(11) NOT NULL,
  `Address` text NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(255) NOT NULL,
  `RegisteredBy` varchar(50) DEFAULT NULL,
  `csn_usn` varchar(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `students_v`
--

INSERT INTO `students_v` (`StudentID`, `Name`, `Phone_no`, `Department`, `Year`, `Address`, `Username`, `Password`, `RegisteredBy`, `csn_usn`) VALUES
(9, 'ram', 2147483647, 'ISE', 2, '18th cross vidyagiri bagalkot 587102\r\nkarnataka', 'ram', '$2y$10$qAQayNb8kcDbiB5Yj2l.r.KAoFgK0wMTyZL6X90xvdOp1GCDAoIjS', 'VBLOCKADMIN', '2BA22CS025');

-- --------------------------------------------------------

--
-- Table structure for table `vblock_beds`
--

CREATE TABLE `vblock_beds` (
  `bed_id` int(11) NOT NULL,
  `room_id` int(11) NOT NULL,
  `bed_number` int(11) NOT NULL,
  `is_booked` tinyint(1) DEFAULT 0,
  `student_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vblock_beds`
--

INSERT INTO `vblock_beds` (`bed_id`, `room_id`, `bed_number`, `is_booked`, `student_name`) VALUES
(125, 1, 1, 1, 'ram'),
(126, 1, 2, 0, NULL),
(127, 1, 3, 0, NULL),
(128, 2, 1, 0, NULL),
(129, 2, 2, 0, NULL),
(130, 2, 3, 0, NULL),
(131, 3, 1, 0, NULL),
(132, 3, 2, 0, NULL),
(133, 3, 3, 0, NULL),
(134, 4, 1, 0, NULL),
(135, 4, 2, 0, NULL),
(136, 4, 3, 0, NULL),
(137, 5, 1, 0, NULL),
(138, 5, 2, 0, NULL),
(139, 5, 3, 0, NULL),
(140, 6, 1, 0, NULL),
(141, 6, 2, 0, NULL),
(142, 6, 3, 0, NULL),
(143, 7, 1, 0, NULL),
(144, 7, 2, 0, NULL),
(145, 7, 3, 0, NULL),
(146, 8, 1, 0, NULL),
(147, 8, 2, 0, NULL),
(148, 8, 3, 0, NULL),
(149, 9, 1, 0, NULL),
(150, 9, 2, 0, NULL),
(151, 9, 3, 0, NULL),
(152, 10, 1, 0, NULL),
(153, 10, 2, 0, NULL),
(154, 10, 3, 0, NULL),
(155, 11, 1, 0, NULL),
(156, 11, 2, 0, NULL),
(157, 11, 3, 0, NULL),
(158, 12, 1, 0, NULL),
(159, 12, 2, 0, NULL),
(160, 12, 3, 0, NULL),
(161, 13, 1, 0, NULL),
(162, 13, 2, 0, NULL),
(163, 13, 3, 0, NULL),
(164, 14, 1, 0, NULL),
(165, 14, 2, 0, NULL),
(166, 14, 3, 0, NULL),
(167, 15, 1, 0, NULL),
(168, 15, 2, 0, NULL),
(169, 15, 3, 0, NULL),
(170, 16, 1, 0, NULL),
(171, 16, 2, 0, NULL),
(172, 16, 3, 0, NULL),
(173, 17, 1, 0, NULL),
(174, 17, 2, 0, NULL),
(175, 17, 3, 0, NULL),
(176, 18, 1, 0, NULL),
(177, 18, 2, 0, NULL),
(178, 18, 3, 0, NULL),
(179, 19, 1, 0, NULL),
(180, 19, 2, 0, NULL),
(181, 19, 3, 0, NULL),
(182, 20, 1, 0, NULL),
(183, 20, 2, 0, NULL),
(184, 20, 3, 0, NULL),
(185, 21, 1, 0, NULL),
(186, 21, 2, 0, NULL),
(187, 21, 3, 0, NULL),
(188, 22, 1, 0, NULL),
(189, 22, 2, 0, NULL),
(190, 22, 3, 0, NULL),
(191, 23, 1, 0, NULL),
(192, 23, 2, 0, NULL),
(193, 23, 3, 0, NULL),
(194, 24, 1, 0, NULL),
(195, 24, 2, 0, NULL),
(196, 24, 3, 0, NULL),
(197, 25, 1, 0, NULL),
(198, 25, 2, 0, NULL),
(199, 25, 3, 0, NULL),
(200, 26, 1, 0, NULL),
(201, 26, 2, 0, NULL),
(202, 26, 3, 0, NULL),
(203, 27, 1, 0, NULL),
(204, 27, 2, 0, NULL),
(205, 27, 3, 0, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vblock_complaints`
--

CREATE TABLE `vblock_complaints` (
  `complaint_id` int(11) NOT NULL,
  `student_username` varchar(255) NOT NULL,
  `student_name` varchar(255) NOT NULL,
  `branch` varchar(255) NOT NULL,
  `complaint_text` text NOT NULL,
  `complaint_date` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vblock_complaints`
--

INSERT INTO `vblock_complaints` (`complaint_id`, `student_username`, `student_name`, `branch`, `complaint_text`, `complaint_date`) VALUES
(17, 'abhi', 'dcx', 'CV', 'dfv', '2025-01-10 16:15:48');

-- --------------------------------------------------------

--
-- Table structure for table `vblock_departments`
--

CREATE TABLE `vblock_departments` (
  `department_id` int(11) NOT NULL,
  `department_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vblock_departments`
--

INSERT INTO `vblock_departments` (`department_id`, `department_name`) VALUES
(1, 'ISE'),
(2, 'CSE'),
(3, 'AIML'),
(4, 'EEE'),
(5, 'ECE'),
(6, 'IP'),
(7, 'BT'),
(8, 'ME'),
(9, 'CV');

-- --------------------------------------------------------

--
-- Table structure for table `vblock_rooms`
--

CREATE TABLE `vblock_rooms` (
  `room_id` int(11) NOT NULL,
  `department_id` int(11) NOT NULL,
  `room_number` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `vblock_rooms`
--

INSERT INTO `vblock_rooms` (`room_id`, `department_id`, `room_number`) VALUES
(1, 1, 'ISE-101'),
(2, 1, 'ISE-102'),
(3, 1, 'ISE-103'),
(4, 2, 'CSE-104'),
(5, 2, 'CSE-105'),
(6, 2, 'CSE-106'),
(7, 3, 'AIML-107'),
(8, 3, 'AIML-108'),
(9, 3, 'AIML-109'),
(10, 4, 'EEE-110'),
(11, 4, 'EEE-111'),
(12, 4, 'EEE-112'),
(13, 5, 'ECE-113'),
(14, 5, 'ECE-114'),
(15, 5, 'ECE-115'),
(16, 6, 'IP-116'),
(17, 6, 'IP-117'),
(18, 6, 'IP-118'),
(19, 7, 'BT-119'),
(20, 7, 'BT-120'),
(21, 7, 'BT-121'),
(22, 8, 'ME-122'),
(23, 8, 'ME-123'),
(24, 8, 'ME-124'),
(25, 9, 'CV-125'),
(26, 9, 'CV-126'),
(27, 9, 'CV-127');

-- --------------------------------------------------------

--
-- Table structure for table `v_announcements`
--

CREATE TABLE `v_announcements` (
  `id` int(11) NOT NULL,
  `announcement` text NOT NULL,
  `recipient` varchar(255) NOT NULL DEFAULT 'all',
  `posted_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `v_announcements`
--

INSERT INTO `v_announcements` (`id`, `announcement`, `recipient`, `posted_at`) VALUES
(1, 'hi bro', 'all', '2025-01-10 18:37:38'),
(2, 'dnihyhxj', '41', '2025-01-10 18:41:23'),
(4, 'cvbn ', 'all', '2025-01-11 06:46:53'),
(6, 'dfghjnhbvcdfghnjhgfdfghjk,lkjhgfd', '2BA22IS003', '2025-01-11 06:49:49'),
(7, 'hlo\r\n', 'all', '2025-01-13 20:02:27'),
(8, 'hlo ram', '2ba22is025', '2025-01-13 20:02:43');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admins_g`
--
ALTER TABLE `admins_g`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `admins_n`
--
ALTER TABLE `admins_n`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `admins_v`
--
ALTER TABLE `admins_v`
  ADD PRIMARY KEY (`AdminID`),
  ADD UNIQUE KEY `Username` (`Username`);

--
-- Indexes for table `gblock_beds`
--
ALTER TABLE `gblock_beds`
  ADD PRIMARY KEY (`bed_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `gblock_complaints`
--
ALTER TABLE `gblock_complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `gblock_departments`
--
ALTER TABLE `gblock_departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `gblock_rooms`
--
ALTER TABLE `gblock_rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `g_announcements`
--
ALTER TABLE `g_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `nblock_beds`
--
ALTER TABLE `nblock_beds`
  ADD PRIMARY KEY (`bed_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `nblock_complaints`
--
ALTER TABLE `nblock_complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `nblock_departments`
--
ALTER TABLE `nblock_departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `nblock_rooms`
--
ALTER TABLE `nblock_rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `n_announcements`
--
ALTER TABLE `n_announcements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `rooms_g`
--
ALTER TABLE `rooms_g`
  ADD PRIMARY KEY (`RoomID`);

--
-- Indexes for table `rooms_n`
--
ALTER TABLE `rooms_n`
  ADD PRIMARY KEY (`RoomID`);

--
-- Indexes for table `rooms_v`
--
ALTER TABLE `rooms_v`
  ADD PRIMARY KEY (`RoomID`);

--
-- Indexes for table `students_g`
--
ALTER TABLE `students_g`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `csn_usn` (`csn_usn`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `RegisteredBy` (`RegisteredBy`);

--
-- Indexes for table `students_n`
--
ALTER TABLE `students_n`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `csn_usn` (`csn_usn`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `RegisteredBy` (`RegisteredBy`);

--
-- Indexes for table `students_v`
--
ALTER TABLE `students_v`
  ADD PRIMARY KEY (`StudentID`),
  ADD UNIQUE KEY `csn_usn` (`csn_usn`),
  ADD UNIQUE KEY `Username` (`Username`),
  ADD KEY `RegisteredBy` (`RegisteredBy`);

--
-- Indexes for table `vblock_beds`
--
ALTER TABLE `vblock_beds`
  ADD PRIMARY KEY (`bed_id`),
  ADD KEY `room_id` (`room_id`);

--
-- Indexes for table `vblock_complaints`
--
ALTER TABLE `vblock_complaints`
  ADD PRIMARY KEY (`complaint_id`);

--
-- Indexes for table `vblock_departments`
--
ALTER TABLE `vblock_departments`
  ADD PRIMARY KEY (`department_id`);

--
-- Indexes for table `vblock_rooms`
--
ALTER TABLE `vblock_rooms`
  ADD PRIMARY KEY (`room_id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `v_announcements`
--
ALTER TABLE `v_announcements`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admins_g`
--
ALTER TABLE `admins_g`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `admins_n`
--
ALTER TABLE `admins_n`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `admins_v`
--
ALTER TABLE `admins_v`
  MODIFY `AdminID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `gblock_beds`
--
ALTER TABLE `gblock_beds`
  MODIFY `bed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `gblock_complaints`
--
ALTER TABLE `gblock_complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `gblock_departments`
--
ALTER TABLE `gblock_departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `gblock_rooms`
--
ALTER TABLE `gblock_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `g_announcements`
--
ALTER TABLE `g_announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nblock_beds`
--
ALTER TABLE `nblock_beds`
  MODIFY `bed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `nblock_complaints`
--
ALTER TABLE `nblock_complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `nblock_departments`
--
ALTER TABLE `nblock_departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `nblock_rooms`
--
ALTER TABLE `nblock_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `n_announcements`
--
ALTER TABLE `n_announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `rooms_g`
--
ALTER TABLE `rooms_g`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms_n`
--
ALTER TABLE `rooms_n`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rooms_v`
--
ALTER TABLE `rooms_v`
  MODIFY `RoomID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `students_g`
--
ALTER TABLE `students_g`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `students_n`
--
ALTER TABLE `students_n`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `students_v`
--
ALTER TABLE `students_v`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vblock_beds`
--
ALTER TABLE `vblock_beds`
  MODIFY `bed_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=206;

--
-- AUTO_INCREMENT for table `vblock_complaints`
--
ALTER TABLE `vblock_complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `vblock_departments`
--
ALTER TABLE `vblock_departments`
  MODIFY `department_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `vblock_rooms`
--
ALTER TABLE `vblock_rooms`
  MODIFY `room_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `v_announcements`
--
ALTER TABLE `v_announcements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `gblock_beds`
--
ALTER TABLE `gblock_beds`
  ADD CONSTRAINT `gblock_beds_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `gblock_rooms` (`room_id`);

--
-- Constraints for table `gblock_rooms`
--
ALTER TABLE `gblock_rooms`
  ADD CONSTRAINT `gblock_rooms_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `gblock_departments` (`department_id`);

--
-- Constraints for table `nblock_beds`
--
ALTER TABLE `nblock_beds`
  ADD CONSTRAINT `nblock_beds_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `nblock_rooms` (`room_id`);

--
-- Constraints for table `nblock_rooms`
--
ALTER TABLE `nblock_rooms`
  ADD CONSTRAINT `nblock_rooms_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `nblock_departments` (`department_id`);

--
-- Constraints for table `vblock_beds`
--
ALTER TABLE `vblock_beds`
  ADD CONSTRAINT `vblock_beds_ibfk_1` FOREIGN KEY (`room_id`) REFERENCES `vblock_rooms` (`room_id`);

--
-- Constraints for table `vblock_rooms`
--
ALTER TABLE `vblock_rooms`
  ADD CONSTRAINT `vblock_rooms_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `vblock_departments` (`department_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
