-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 04, 2022 at 08:52 PM
-- Server version: 10.4.21-MariaDB
-- PHP Version: 7.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES latin1 */;

--
-- Database: `medeast`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `ADMIN_ID` int(10) NOT NULL,
  `ADMIN_NAME` varchar(25) CHARACTER SET latin1 NOT NULL,
  `ADMIN_TYPE` varchar(25) CHARACTER SET latin1 NOT NULL,
  `ADMIN_EMAIL` varchar(50) CHARACTER SET latin1 NOT NULL,
  `ADMIN_USERNAME` varchar(25) CHARACTER SET latin1 NOT NULL,
  `ADMIN_PASSWORD` varchar(100) CHARACTER SET latin1 NOT NULL,
  `ADMIN_STATUS` varchar(25) CHARACTER SET latin1 NOT NULL,
  `ADMIN_SAVE_TIME` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_NAME`, `ADMIN_TYPE`, `ADMIN_EMAIL`, `ADMIN_USERNAME`, `ADMIN_PASSWORD`, `ADMIN_STATUS`, `ADMIN_SAVE_TIME`) VALUES
(1, 'Syed Mubeen Hussain Shah', 'admin', 'shahmobeen333@gmail.com', 'mubeen.hussain', '$2y$10$u..eYfMbxbPLnx9Nl2wNO.rg0nOFCafswT1Azx9pXf8D8fiWVs/IO', 'active', '2022-01-23 15:06:41');

-- --------------------------------------------------------

--
-- Table structure for table `bill_service`
--

CREATE TABLE `bill_service` (
  `BILL_SERVICE_ID` int(10) NOT NULL,
  `BILL_SERVICE_NAME` varchar(50) CHARACTER SET latin1 NOT NULL,
  `BILL_SERVICE_AMOUNT` int(10) NOT NULL,
  `SERVICE_STATUS` varchar(10) CHARACTER SET latin1 NOT NULL,
  `SERVICE_SAVE_TIME` varchar(100) CHARACTER SET latin1 NOT NULL
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
  `DEPARTMENT_NAME` varchar(100) CHARACTER SET latin1 NOT NULL,
  `DEPARTMENT_DESC` text CHARACTER SET latin1 NOT NULL,
  `DEPARTMENT_STATUS` varchar(10) CHARACTER SET latin1 NOT NULL,
  `DEPARTMENT_SAVE_TIME` varchar(100) CHARACTER SET latin1 NOT NULL
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
  `DOCTOR_NAME` varchar(50) CHARACTER SET latin1 NOT NULL,
  `DOCTOR_MOBILE` varchar(15) CHARACTER SET latin1 NOT NULL,
  `DEPARTMENT_ID` int(10) NOT NULL,
  `DOCTOR_EDUCATION` varchar(100) CHARACTER SET latin1 NOT NULL,
  `DOCTOR_EXPERIENCE` varchar(100) CHARACTER SET latin1 NOT NULL,
  `DOCTOR_STATUS` varchar(50) CHARACTER SET latin1 NOT NULL,
  `DOCTOR_SAVE_TIME` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `education`
--

CREATE TABLE `education` (
  `EDUCATION_ID` int(10) NOT NULL,
  `EDUCATION_NAME` varchar(100) CHARACTER SET latin1 NOT NULL,
  `EDUCATION_ALAIS` varchar(50) CHARACTER SET latin1 NOT NULL,
  `EDUCATION_STATUS` varchar(50) CHARACTER SET latin1 NOT NULL,
  `EDUCATION_DATE_TIME` varchar(100) CHARACTER SET latin1 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PATIENT_ID` int(10) NOT NULL,
  `PATIENT_MR_ID` varchar(25) CHARACTER SET latin1 NOT NULL,
  `PATIENT_NAME` varchar(100) CHARACTER SET latin1 NOT NULL,
  `PATIENT_TYPE` varchar(10) CHARACTER SET latin1 NOT NULL,
  `PATIENT_MOBILE` varchar(15) CHARACTER SET latin1 NOT NULL,
  `PATIENT_CNIC` varchar(20) CHARACTER SET latin1 DEFAULT NULL,
  `PATIENT_GENDER` varchar(20) CHARACTER SET latin1 NOT NULL,
  `PATIENT_AGE` varchar(10) CHARACTER SET latin1 NOT NULL,
  `PATIENT_ADDRESS` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `DOCTOR_ID` int(10) NOT NULL,
  `PATIENT_DATE_TIME` varchar(100) CHARACTER SET latin1 DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_bill`
--

CREATE TABLE `patient_bill` (
  `BILL_ID` int(10) NOT NULL,
  `PATIENT_MR_ID` varchar(20) NOT NULL,
  `PATIENT_MOBILE` varchar(50) CHARACTER SET latin1 NOT NULL,
  `PATIENT_CNIC` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `DISCHARGE_DATE_TIME` varchar(100) CHARACTER SET latin1 NOT NULL,
  `BILL_DATE_TIME` varchar(100) CHARACTER SET latin1 NOT NULL,
  `BILL_SERVICE_ID` varchar(100) CHARACTER SET latin1 NOT NULL,
  `BILL_TOTAL_AMOUNT` int(15) NOT NULL,
  `BILL_DISCOUNT` int(10) DEFAULT NULL,
  `BILL_FINAL_TOTAL` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_record`
--

CREATE TABLE `patient_record` (
  `RECORD_ID` int(10) NOT NULL,
  `PATIENT_MR_ID` varchar(20) CHARACTER SET latin1 NOT NULL,
  `PATIENT_MOBILE` varchar(50) CHARACTER SET latin1 NOT NULL,
  `PATIENT_CNIC` varchar(50) CHARACTER SET latin1 DEFAULT NULL,
  `PATIENT_ADMISSION_DATE_TIME` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `PATIENT_DISCHARGE_DATE_TIME` varchar(100) CHARACTER SET latin1 DEFAULT NULL,
  `PATIENT_ADMIT_DAYS` int(10) NOT NULL DEFAULT 0,
  `PATIENT_BILL_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient_type`
--

CREATE TABLE `patient_type` (
  `PATIENT_TYPE_ID` int(10) NOT NULL,
  `PATIENT_TYPE_NAME` varchar(100) CHARACTER SET latin1 NOT NULL,
  `PATIENT_TYPE_ALAIS` varchar(15) CHARACTER SET latin1 NOT NULL,
  `TYPE_SAVE_TIME` varchar(100) CHARACTER SET latin1 NOT NULL,
  `PATIENT_TYPE_STATUS` varchar(10) CHARACTER SET latin1 NOT NULL
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
-- Indexes for table `patient_bill`
--
ALTER TABLE `patient_bill`
  ADD PRIMARY KEY (`BILL_ID`);

--
-- Indexes for table `patient_record`
--
ALTER TABLE `patient_record`
  ADD PRIMARY KEY (`RECORD_ID`);

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
  MODIFY `DOCTOR_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `education`
--
ALTER TABLE `education`
  MODIFY `EDUCATION_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PATIENT_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_bill`
--
ALTER TABLE `patient_bill`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_record`
--
ALTER TABLE `patient_record`
  MODIFY `RECORD_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient_type`
--
ALTER TABLE `patient_type`
  MODIFY `PATIENT_TYPE_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
