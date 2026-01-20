-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 20, 2026 at 09:46 AM
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
-- Database: `doc_house`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `aptid` int(11) NOT NULL,
  `sid` int(11) NOT NULL,
  `pid` int(11) NOT NULL,
  `time` time NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`aptid`, `sid`, `pid`, `time`, `status`) VALUES
(77, 621, 13, '10:50:00', 'cancelled'),
(78, 613, 13, '09:50:00', 'cancelled'),
(79, 614, 17, '09:05:00', 'cancelled'),
(80, 612, 17, '10:00:00', '0'),
(81, 618, 17, '16:00:00', 'cancelled'),
(83, 616, 13, '10:20:00', 'cancelled'),
(84, 612, 13, '09:30:00', 'cancelled'),
(85, 614, 13, '10:15:00', 'cancelled'),
(87, 612, 17, '11:30:00', 'accepted'),
(91, 627, 13, '05:30:00', 'cancelled'),
(92, 627, 13, '05:30:00', 'cancelled'),
(97, 627, 17, '06:00:00', 'accepted');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `did` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `fee` int(11) NOT NULL,
  `bio` varchar(2005) NOT NULL,
  `spid` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`did`, `uid`, `fee`, `bio`, `spid`) VALUES
(11, 34, 500, 'Changed', 1),
(12, 35, 400, 'Dermatologist specializing in skin treatments', 3),
(13, 47, 600, 'Senior cardiologist with 15+ years of experience in heart disease management.', 1),
(14, 48, 450, 'Dermatologist specializing in acne, allergy, and cosmetic skin care.', 2),
(15, 51, 700, 'Expert cardiologist focusing on heart failure and angiography.', 1),
(16, 52, 650, 'Neurologist with experience in stroke and epilepsy treatment.', 3),
(17, 53, 500, 'Pediatric specialist with 10 years of child care experience.', 4),
(18, 58, 12000, 'Future Doctor', 9),
(19, 60, 50000, 'Best doctor in the world, who knows programming as well.', 1);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `pid` int(11) NOT NULL,
  `uid` int(11) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `weight` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`pid`, `uid`, `gender`, `weight`) VALUES
(13, 1, 'male', 67),
(16, 38, 'female', 560),
(17, 39, 'male', 20),
(18, 46, 'male', 50),
(19, 49, 'male', 68),
(20, 50, 'female', 55),
(21, 54, 'male', 72),
(22, 55, 'female', 58),
(23, 56, 'male', 75),
(24, 57, 'female', 52);

-- --------------------------------------------------------

--
-- Table structure for table `session`
--

CREATE TABLE `session` (
  `sid` int(11) NOT NULL,
  `did` int(11) NOT NULL,
  `date` date NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `slot_duration` int(11) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `session`
--

INSERT INTO `session` (`sid`, `did`, `date`, `start_time`, `end_time`, `slot_duration`, `status`) VALUES
(612, 11, '2026-01-20', '09:00:00', '15:00:00', 30, 'open'),
(613, 12, '2026-01-15', '09:20:00', '12:00:00', 15, 'open'),
(614, 11, '2026-01-21', '09:00:00', '11:00:00', 5, 'open'),
(615, 11, '2026-01-06', '12:00:00', '15:00:00', 30, 'open'),
(616, 13, '2026-01-22', '10:00:00', '14:00:00', 20, 'open'),
(617, 14, '2026-01-23', '09:00:00', '12:00:00', 15, 'open'),
(618, 11, '2026-01-24', '15:00:00', '18:00:00', 30, 'open'),
(619, 15, '2026-01-25', '09:00:00', '13:00:00', 20, 'open'),
(620, 15, '2026-01-26', '14:00:00', '18:00:00', 30, 'open'),
(621, 16, '2026-01-25', '10:00:00', '15:00:00', 25, 'open'),
(622, 16, '2026-01-27', '09:00:00', '12:00:00', 15, 'closed'),
(623, 17, '2026-01-26', '08:30:00', '12:30:00', 20, 'open'),
(624, 17, '2026-01-28', '13:00:00', '17:00:00', 30, 'open'),
(627, 18, '2026-05-28', '05:00:00', '08:00:00', 30, 'open'),
(628, 11, '2026-01-21', '15:43:00', '16:43:00', 30, 'open');

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `spid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `img` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`spid`, `name`, `img`) VALUES
(1, 'Cardiology', 'cardiology.png'),
(2, 'Dermatology', 'dermatology.png'),
(3, 'Neurology', 'neurology.png'),
(4, 'Pediatrics', 'pediatrics.png'),
(9, 'abcd', ''),
(11, '344', '');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `uid` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(32) NOT NULL,
  `phone` varchar(15) NOT NULL,
  `role` varchar(10) NOT NULL,
  `dob` date DEFAULT NULL,
  `img` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`uid`, `name`, `email`, `password`, `phone`, `role`, `dob`, `img`) VALUES
(1, 'Faysal Ahammed Chowdhury', 'faysal@gmail.com', '11111111', '01610137675', 'patient', '2002-11-29', '/Doc_House/uploads/profile/2703dummy_doctor.png'),
(34, 'Siyam Talukder', 'siyam@gmail.com', '12345678', '01710000012', 'doctor', '2002-11-14', '/Doc_House/uploads/profile/51722dummy_doctor_2.png'),
(35, 'Dr. Mehedi Hasan', 'mehedi.doctor@gmail.com', '1234', '01710000013', 'doctor', '2000-11-16', NULL),
(38, 'Fariya Akter Pushpo', 'fariya@gmail.com', '12345678', '01610137675', 'patient', '2026-01-07', '/Doc_House/uploads/profile/98296dummy_doctor_2.png'),
(39, 'Abdul Rahaman Fardin', 'fardin@gmail.com', '12345678', '01610137675', 'patient', '2026-01-05', '/Doc_House/uploads/profile/75334dummy_doctor_2.png'),
(46, 'Fariz Chowdhury', 'fariz@gmail.com', '11111111', '12121212121', 'patient', '2025-12-31', NULL),
(47, 'Dr. Hasan Mahmud', 'hasan.cardiology@gmail.com', '1234', '01710000020', 'doctor', '1985-06-15', NULL),
(48, 'Dr. Nusrat Jahan', 'nusrat.derma@gmail.com', '1234', '01710000021', 'doctor', '1988-03-22', NULL),
(49, 'Rahim Uddin', 'rahim@gmail.com', '12345678', '01810000001', 'patient', '1998-09-10', NULL),
(50, 'Karima Begum', 'karima@gmail.com', '12345678', '01810000002', 'patient', '1995-02-18', NULL),
(51, 'Dr. Kamal Hossain', 'kamal.cardio@gmail.com', '12345678', '01710000030', 'doctor', '1980-04-10', NULL),
(52, 'Dr. Rafiul Islam', 'rafiul.neuro@gmail.com', '1234', '01710000031', 'doctor', '1983-08-21', NULL),
(53, 'Dr. Sabrina Rahman', 'sabrina.pedia@gmail.com', '1234', '01710000032', 'doctor', '1987-12-01', NULL),
(54, 'Mahmudul Hasan', 'mahmud@gmail.com', '12345678', '01820000001', 'patient', '1997-06-11', NULL),
(55, 'Nusrat Sultana', 'nusrat@gmail.com', '12345678', '01820000002', 'patient', '2001-03-15', NULL),
(56, 'Tanvir Ahmed', 'tanvir@gmail.com', '12345678', '01820000003', 'patient', '1994-10-09', NULL),
(57, 'Sharmin Akter', 'sharmin@gmail.com', '12345678', '01820000004', 'patient', '1999-01-25', NULL),
(58, 'Farhana Akter Prity', 'farhana@gmail.com', '12345678', '+8801610137675', 'doctor', '2002-10-10', NULL),
(59, 'Test Admin', 'admin@gmail.com', '12345678', '01610137675', 'admin', '2002-10-10', NULL),
(60, 'Mehedi Hasan Khan', 'doctor@gmail.com', '12345678', '+8801610137675', 'doctor', '2002-10-10', NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`aptid`),
  ADD KEY `sid` (`sid`),
  ADD KEY `pid` (`pid`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`did`),
  ADD KEY `uid` (`uid`),
  ADD KEY `spid` (`spid`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`pid`),
  ADD KEY `uid` (`uid`);

--
-- Indexes for table `session`
--
ALTER TABLE `session`
  ADD PRIMARY KEY (`sid`),
  ADD KEY `did` (`did`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`spid`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`uid`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `aptid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=98;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `did` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `pid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;

--
-- AUTO_INCREMENT for table `session`
--
ALTER TABLE `session`
  MODIFY `sid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=629;

--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `spid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `uid` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`sid`) REFERENCES `session` (`sid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`pid`) REFERENCES `patient` (`pid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `doctor_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `doctor_ibfk_2` FOREIGN KEY (`spid`) REFERENCES `specialization` (`spid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`uid`) REFERENCES `user` (`uid`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `session`
--
ALTER TABLE `session`
  ADD CONSTRAINT `session_ibfk_1` FOREIGN KEY (`did`) REFERENCES `doctor` (`did`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
