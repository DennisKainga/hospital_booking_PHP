-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jul 06, 2022 at 09:16 AM
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
-- Database: `hospital_booking`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_name` varchar(200) DEFAULT NULL,
  `admin_mobile` varchar(100) DEFAULT NULL,
  `admin_email` varchar(100) DEFAULT NULL,
  `admin_gender` varchar(100) DEFAULT NULL,
  `admin_login_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `ailment`
--

CREATE TABLE `ailment` (
  `ailment_id` int(11) NOT NULL,
  `ailment_appointment_id` int(11) DEFAULT NULL,
  `ailment_desc` varchar(200) DEFAULT NULL,
  `ailment_specialist_id` int(11) DEFAULT NULL,
  `ailment_status` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ailment`
--

INSERT INTO `ailment` (`ailment_id`, `ailment_appointment_id`, `ailment_desc`, `ailment_specialist_id`, `ailment_status`) VALUES
(17, 18, 'Malaria', 15, 'Very sick');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `appointment_patient_id` int(11) DEFAULT NULL,
  `appointment_specialist_id` int(11) NOT NULL,
  `appointment_date` varchar(100) DEFAULT NULL,
  `appointment_status` varchar(20) DEFAULT '0'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `appointment_patient_id`, `appointment_specialist_id`, `appointment_date`, `appointment_status`) VALUES
(16, 5, 15, '2022-07-15', '1'),
(17, 5, 15, '2022-07-20', '1'),
(18, 5, 15, '2022-07-22', '1'),
(19, 5, 15, '2022-07-25', '1'),
(20, 5, 14, '2022-07-14', '2');

-- --------------------------------------------------------

--
-- Table structure for table `login`
--

CREATE TABLE `login` (
  `login_id` int(11) NOT NULL,
  `login_username` varchar(100) DEFAULT NULL,
  `login_password` varchar(200) DEFAULT NULL,
  `login_rank` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `login`
--

INSERT INTO `login` (`login_id`, `login_username`, `login_password`, `login_rank`) VALUES
(14, 'sam', '$2y$10$K8fcIdY4C0PbEmVSJHDdPOI.pLLVYBQRwj7wGm1DrgzGJLGPXN.Ja', 'admin'),
(20, 'john', '$2y$10$tXEzhO2kIHgjf.JhtEOedeXcdWGok1t637TzPm0EVDZtiabgV7TNm', 'spec'),
(21, 'dennis', '$2y$10$KXdTm.b3I4EMPwVQaf7rbOL1NswcuhSVLadlc7oqvfxszMlhhhHFC', 'patient'),
(22, 'doc', '$2y$10$94Caowf3GmPGV3D381Ywo.sHpt2RXLAxjP5QqxO/kep5LGbmy.0Rq', 'spec');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `patient_name` varchar(200) DEFAULT NULL,
  `patient_mobile` varchar(100) DEFAULT NULL,
  `patient_email` varchar(100) DEFAULT NULL,
  `patient_gender` varchar(100) DEFAULT NULL,
  `patient_dob` varchar(100) DEFAULT NULL,
  `patient_location` varchar(100) DEFAULT NULL,
  `patient_login_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_name`, `patient_mobile`, `patient_email`, `patient_gender`, `patient_dob`, `patient_location`, `patient_login_id`) VALUES
(5, 'Dennis Kainga', '0799962392', 'dennis@gmail.com', 'Male', '2022-07-20', 'Nakuru', 21);

-- --------------------------------------------------------

--
-- Table structure for table `specialist`
--

CREATE TABLE `specialist` (
  `specialist_id` int(11) NOT NULL,
  `specialist_name` varchar(100) DEFAULT NULL,
  `specialist_mobile` varchar(100) DEFAULT NULL,
  `specialist_email` varchar(100) DEFAULT NULL,
  `specialist_gender` varchar(100) DEFAULT NULL,
  `specialist_location` varchar(100) DEFAULT NULL,
  `specialist_specialization_id` int(11) DEFAULT NULL,
  `specialist_login_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialist`
--

INSERT INTO `specialist` (`specialist_id`, `specialist_name`, `specialist_mobile`, `specialist_email`, `specialist_gender`, `specialist_location`, `specialist_specialization_id`, `specialist_login_id`) VALUES
(11, 'Samuel Karuga', '0732362782', 'sam@gmail.com', 'Male', 'Narobi', 2, 14),
(14, 'john Doe', '0799962392', 'john@gmail.com', 'male', 'Nakuru', 3, 20),
(15, 'Doctor Doctor', '0799962392', 'john@gmail.com', 'Male', 'Nakuru', 2, 22);

-- --------------------------------------------------------

--
-- Table structure for table `specialization`
--

CREATE TABLE `specialization` (
  `specialization_id` int(11) NOT NULL,
  `specialization_name` varchar(100) DEFAULT NULL,
  `specialization_desc` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialization`
--

INSERT INTO `specialization` (`specialization_id`, `specialization_name`, `specialization_desc`) VALUES
(1, 'Cardiology', 'Deals with cardiology'),
(2, 'Dental', 'Deals with dental staff'),
(3, 'Skin care', 'Deals with skin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`),
  ADD KEY `admin_login_id` (`admin_login_id`);

--
-- Indexes for table `ailment`
--
ALTER TABLE `ailment`
  ADD PRIMARY KEY (`ailment_id`),
  ADD KEY `ailment_appointment_id` (`ailment_appointment_id`),
  ADD KEY `ailment_specialist_id` (`ailment_specialist_id`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `appointment_patient_id` (`appointment_patient_id`),
  ADD KEY `appointment_specialist_id` (`appointment_specialist_id`);

--
-- Indexes for table `login`
--
ALTER TABLE `login`
  ADD PRIMARY KEY (`login_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`),
  ADD KEY `patient_login_id` (`patient_login_id`);

--
-- Indexes for table `specialist`
--
ALTER TABLE `specialist`
  ADD PRIMARY KEY (`specialist_id`),
  ADD KEY `specialist_login_id` (`specialist_login_id`),
  ADD KEY `specialist_specialization_id` (`specialist_specialization_id`);

--
-- Indexes for table `specialization`
--
ALTER TABLE `specialization`
  ADD PRIMARY KEY (`specialization_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `ailment`
--
ALTER TABLE `ailment`
  MODIFY `ailment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `login`
--
ALTER TABLE `login`
  MODIFY `login_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `specialist`
--
ALTER TABLE `specialist`
  MODIFY `specialist_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `specialization`
--
ALTER TABLE `specialization`
  MODIFY `specialization_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `admin`
--
ALTER TABLE `admin`
  ADD CONSTRAINT `admin_ibfk_1` FOREIGN KEY (`admin_login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE;

--
-- Constraints for table `ailment`
--
ALTER TABLE `ailment`
  ADD CONSTRAINT `ailment_ibfk_1` FOREIGN KEY (`ailment_appointment_id`) REFERENCES `appointment` (`appointment_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `ailment_ibfk_2` FOREIGN KEY (`ailment_specialist_id`) REFERENCES `specialist` (`specialist_id`) ON DELETE CASCADE;

--
-- Constraints for table `appointment`
--
ALTER TABLE `appointment`
  ADD CONSTRAINT `appointment_ibfk_1` FOREIGN KEY (`appointment_patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_2` FOREIGN KEY (`appointment_specialist_id`) REFERENCES `specialist` (`specialist_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `appointment_ibfk_3` FOREIGN KEY (`appointment_specialist_id`) REFERENCES `specialist` (`specialist_id`) ON DELETE CASCADE;

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `patient_ibfk_1` FOREIGN KEY (`patient_login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE;

--
-- Constraints for table `specialist`
--
ALTER TABLE `specialist`
  ADD CONSTRAINT `specialist_ibfk_1` FOREIGN KEY (`specialist_specialization_id`) REFERENCES `specialization` (`specialization_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `specialist_ibfk_2` FOREIGN KEY (`specialist_login_id`) REFERENCES `login` (`login_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `specialist_ibfk_3` FOREIGN KEY (`specialist_specialization_id`) REFERENCES `specialization` (`specialization_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
