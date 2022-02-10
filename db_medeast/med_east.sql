-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 10, 2022 at 10:14 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `med_east`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` int(10) NOT NULL,
  `ADMIN_NAME` varchar(25) NOT NULL,
  `ADMIN_TYPE` varchar(25) NOT NULL,
  `ADMIN_EMAIL` varchar(50) NOT NULL,
  `ADMIN_USERNAME` varchar(25) NOT NULL,
  `ADMIN_PASSWORD` varchar(100) NOT NULL,
  `ADMIN_STATUS` varchar(25) NOT NULL,
  `ADMIN_SAVE_TIME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_NAME`, `ADMIN_TYPE`, `ADMIN_EMAIL`, `ADMIN_USERNAME`, `ADMIN_PASSWORD`, `ADMIN_STATUS`, `ADMIN_SAVE_TIME`) VALUES
(1, 'Syed Mubeen Hussain Shah', 'admin', 'shahmobeen333@gmail.com', 'mubeen.hussain', '$2y$10$u..eYfMbxbPLnx9Nl2wNO.rg0nOFCafswT1Azx9pXf8D8fiWVs/IO', 'active', '2022-01-23 15:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `bill_record`
--

CREATE TABLE `bill_record` (
  `BILL_ID` int(10) NOT NULL,
  `MR_ID` varchar(20) NOT NULL,
  `MOBILE` varchar(50) NOT NULL,
  `CNIC` varchar(50) DEFAULT NULL,
  `ADMISSION_DATE` varchar(100) NOT NULL,
  `DISCHARGE_DATE` varchar(100) DEFAULT NULL,
  `ADMIT_DAYS` int(10) DEFAULT NULL,
  `BILL_DATE` varchar(100) DEFAULT NULL,
  `SERVICES` mediumtext DEFAULT NULL,
  `BILL_AMOUNT` int(15) DEFAULT NULL,
  `DISCOUNT` int(15) DEFAULT NULL,
  `TOTAL` int(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_record`
--

INSERT INTO `bill_record` (`BILL_ID`, `MR_ID`, `MOBILE`, `CNIC`, `ADMISSION_DATE`, `DISCHARGE_DATE`, `ADMIT_DAYS`, `BILL_DATE`, `SERVICES`, `BILL_AMOUNT`, `DISCOUNT`, `TOTAL`) VALUES
(1, '3051448-ME', '03128776604', '3520151562791', '02/06/2022 12:58 AM', '02/10/2022 12:58 AM', 5, '02/10/2022 12:58 AM', 'Routine Medical Care,Admission Charges,Operation Charges,Anesthetist Charges,Operation Theater Medicines,Pediatric Doctor Charges,Nursery Charges,Nursing Staff Charges,M O Charges,Visit Charges,', 25005, 5220, 19785),
(2, '3051448-ME', '03128776604', '3520151562791', '01/30/2022 1:08 AM', '02/08/2022 1:08 AM', 5, '02/08/2022 1:08 AM', 'Routine Medical Care,Admission Charges,Anesthetist Charges,Labour Room Charges,Pediatric Doctor Charges,Nursing Staff Charges,M O Charges,Monitoring Charges,Visit Charges,CTG Charges,', 25005, 5000, 20005),
(3, '5032306-ME', '03214253974', NULL, '02/11/2022 1:32 AM', '02/11/2022 1:32 AM', 5, '02/11/2022 1:32 AM', 'Routine Medical Care,Admission Charges,Anesthetist Charges,Operation Theater Medicines,Nursery Charges,M O Charges,Monitoring Charges,Visit Charges,CTG Charges,Private Room Charges Edit,', 47505, 5420, 42085);

-- --------------------------------------------------------

--
-- Table structure for table `bill_service`
--

CREATE TABLE `bill_service` (
  `BILL_SERVICE_ID` int(10) NOT NULL,
  `BILL_SERVICE_NAME` varchar(50) NOT NULL,
  `BILL_SERVICE_AMOUNT` int(10) NOT NULL,
  `SERVICE_STATUS` varchar(10) NOT NULL,
  `SERVICE_SAVE_TIME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `bill_service`
--

INSERT INTO `bill_service` (`BILL_SERVICE_ID`, `BILL_SERVICE_NAME`, `BILL_SERVICE_AMOUNT`, `SERVICE_STATUS`, `SERVICE_SAVE_TIME`) VALUES
(1, 'Routine Medical Care', 500, 'active', '2022-01-23 15:05:20'),
(2, 'Admission Charges', 500, 'active', '2022-01-25 15:42:57'),
(3, 'Operation Charges', 500, 'active', '2022-01-25 15:43:15'),
(4, 'Anesthetist Charges', 500, 'active', '2022-01-25 15:43:36'),
(5, 'Operation Theater Medicines', 500, 'active', '2022-01-25 15:44:00'),
(6, 'Labour Room Charges', 500, 'active', '2022-01-25 15:46:19'),
(7, 'Pediatric Doctor Charges', 500, 'active', '2022-01-25 15:46:36'),
(8, 'Nursery Charges', 500, 'active', '2022-01-25 15:47:08'),
(9, 'Nursing Staff Charges', 500, 'active', '2022-01-25 15:47:32'),
(10, 'M O Charges', 500, 'active', '2022-01-25 15:47:51'),
(11, 'Monitoring Charges', 500, 'active', '2022-01-25 15:48:13'),
(12, 'Visit Charges', 500, 'active', '2022-01-25 15:48:35'),
(13, 'CTG Charges', 500, 'active', '2022-01-25 15:48:50'),
(14, 'Private Room Charges Edit', 5000, 'active', '2022-01-25 15:49:06');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DEPARTMENT_ID` int(10) NOT NULL,
  `DEPARTMENT_NAME` varchar(100) NOT NULL,
  `DEPARTMENT_DESC` text NOT NULL,
  `DEPARTMENT_STATUS` varchar(10) NOT NULL,
  `DEPARTMENT_SAVE_TIME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DEPARTMENT_ID`, `DEPARTMENT_NAME`, `DEPARTMENT_DESC`, `DEPARTMENT_STATUS`, `DEPARTMENT_SAVE_TIME`) VALUES
(1, 'Gynaecology', 'Test Department Description.', 'active', '2022-01-23 15:02:55');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `DOCTOR_ID` int(10) NOT NULL,
  `DOCTOR_NAME` varchar(50) NOT NULL,
  `DOCTOR_MOBILE` varchar(15) NOT NULL,
  `DEPARTMENT_ID` int(10) NOT NULL,
  `DOCTOR_EDUCATION` varchar(100) NOT NULL,
  `DOCTOR_EXPERIENCE` varchar(100) NOT NULL,
  `DOCTOR_STATUS` varchar(50) NOT NULL,
  `DOCTOR_SAVE_TIME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DOCTOR_ID`, `DOCTOR_NAME`, `DOCTOR_MOBILE`, `DEPARTMENT_ID`, `DOCTOR_EDUCATION`, `DOCTOR_EXPERIENCE`, `DOCTOR_STATUS`, `DOCTOR_SAVE_TIME`) VALUES
(1, 'Dr Sohaib Abbas', '0321-5153974', 1, 'test, test2, test3', '5 years of Practice', 'active', 'Sat Feb 05 2022 01:47:14 GMT+0500 (Pakistan Standard Time)');

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `EDUCATION_ID` int(10) NOT NULL,
  `EDUCATION_NAME` varchar(100) NOT NULL,
  `EDUCATION_ALAIS` varchar(50) NOT NULL,
  `EDUCATION_STATUS` varchar(50) NOT NULL,
  `EDUCATION_DATE_TIME` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `education`
--

INSERT INTO `education` (`EDUCATION_ID`, `EDUCATION_NAME`, `EDUCATION_ALAIS`, `EDUCATION_STATUS`, `EDUCATION_DATE_TIME`) VALUES
(1, 'Test Education', 'test', 'active', 'Sat Feb 05 2022 01:45:47 GMT+0500 (Pakistan Standard Time)'),
(2, 'Test Education Two', 'test2', 'active', 'Sat Feb 05 2022 01:46:19 GMT+0500 (Pakistan Standard Time)'),
(3, 'Test Education Three', 'test3', 'active', 'Sat Feb 05 2022 01:46:36 GMT+0500 (Pakistan Standard Time)');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PATIENT_ID` int(10) NOT NULL,
  `PATIENT_MR_ID` varchar(25) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `PATIENT_TYPE` varchar(10) NOT NULL,
  `PATIENT_MOBILE` varchar(15) NOT NULL,
  `PATIENT_CNIC` varchar(20) DEFAULT NULL,
  `PATIENT_GENDER` varchar(20) NOT NULL,
  `PATIENT_AGE` varchar(10) NOT NULL,
  `PATIENT_ADDRESS` varchar(100) DEFAULT NULL,
  `DOCTOR_ID` int(10) NOT NULL,
  `PATIENT_DATE_TIME` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`PATIENT_ID`, `PATIENT_MR_ID`, `PATIENT_NAME`, `PATIENT_TYPE`, `PATIENT_MOBILE`, `PATIENT_CNIC`, `PATIENT_GENDER`, `PATIENT_AGE`, `PATIENT_ADDRESS`, `DOCTOR_ID`, `PATIENT_DATE_TIME`) VALUES
(1, '3051448-ME', 'Mubeen Shah', 'indoor', '03128776604', '3520151562791', 'male', '25', 'Lahore, Pakistan', 1, '02/10/2022 12:58 AM'),
(5, '5032306-ME', 'Zahid Shah', 'outdoor', '03214253974', '', 'male', '35', 'Lahore, Pakistan', 1, 'Fri Feb 11 2022 01:30:32 GMT+0500 (Pakistan Standard Time)');

-- --------------------------------------------------------

--
-- Table structure for table `patient_type`
--

CREATE TABLE `patient_type` (
  `PATIENT_TYPE_ID` int(10) NOT NULL,
  `PATIENT_TYPE_NAME` varchar(100) NOT NULL,
  `PATIENT_TYPE_ALAIS` varchar(15) NOT NULL,
  `TYPE_SAVE_TIME` varchar(100) NOT NULL,
  `PATIENT_TYPE_STATUS` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `patient_type`
--

INSERT INTO `patient_type` (`PATIENT_TYPE_ID`, `PATIENT_TYPE_NAME`, `PATIENT_TYPE_ALAIS`, `TYPE_SAVE_TIME`, `PATIENT_TYPE_STATUS`) VALUES
(1, 'Indoor Patient', 'indoor', '2022-01-23 14:35:39', 'active'),
(2, 'OPD Patient', 'outdoor', '2022-01-23 14:41:50', 'active'),
(3, 'Emergency Patient', 'outdoor', 'Fri Jan 28 2022 22:29:49 GMT+0500 (Pakistan Standard Time)', 'active');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `bill_record`
--
ALTER TABLE `bill_record`
  ADD PRIMARY KEY (`BILL_ID`);

--
-- Indexes for table `bill_service`
--
ALTER TABLE `bill_service`
  ADD PRIMARY KEY (`BILL_SERVICE_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DEPARTMENT_ID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`DOCTOR_ID`);

--
-- Indexes for table `education`
--
ALTER TABLE `education`
  ADD PRIMARY KEY (`EDUCATION_ID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PATIENT_ID`),
  ADD UNIQUE KEY `PATIENT_MOBILE` (`PATIENT_MOBILE`);

--
-- Indexes for table `patient_type`
--
ALTER TABLE `patient_type`
  ADD PRIMARY KEY (`PATIENT_TYPE_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bill_record`
--
ALTER TABLE `bill_record`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `bill_service`
--
ALTER TABLE `bill_service`
  MODIFY `BILL_SERVICE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DEPARTMENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `DOCTOR_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `EDUCATION_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PATIENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `patient_type`
--
ALTER TABLE `patient_type`
  MODIFY `PATIENT_TYPE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
