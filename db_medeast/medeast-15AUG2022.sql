-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Aug 14, 2022 at 11:54 PM
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
-- Database: `medeast`
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
  `ADMIN_STATUS` int(10) NOT NULL DEFAULT 1,
  `CREATED_BY` int(10) NOT NULL,
  `ADMIN_SAVE_TIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`ADMIN_ID`, `ADMIN_NAME`, `ADMIN_TYPE`, `ADMIN_EMAIL`, `ADMIN_USERNAME`, `ADMIN_PASSWORD`, `ADMIN_STATUS`, `CREATED_BY`, `ADMIN_SAVE_TIME`) VALUES
(1, 'MedEast Administrator', 'admin', 'admin.medeast@gmail.com', 'Administrator', '$2y$10$j7bfaXlX.kZHL3Yiao4Qg.iusiQRgRRv7skT7LYJKOn2L9l3cUUni', 1, 1, '2022-08-15 02:52:01');

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `DEPARTMENT_ID` int(10) NOT NULL,
  `DEPARTMENT_NAME` varchar(100) NOT NULL,
  `DEPARTMENT_STATUS` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` int(10) NOT NULL,
  `DEPARTMENT_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`DEPARTMENT_ID`, `DEPARTMENT_NAME`, `DEPARTMENT_STATUS`, `STAFF_ID`, `DEPARTMENT_DATE_TIME`) VALUES
(1, 'Gyneacologist', 1, 1, '0000-00-00 00:00:00'),
(2, 'Ophthamology', 1, 1, '0000-00-00 00:00:00'),
(3, 'Pediatric', 1, 1, '0000-00-00 00:00:00'),
(4, 'Pediatric Surgery', 1, 1, '0000-00-00 00:00:00'),
(5, 'Medical Specialist', 1, 1, '0000-00-00 00:00:00'),
(6, 'General Surgery', 1, 1, '0000-00-00 00:00:00'),
(7, 'Psychiatrist', 1, 1, '0000-00-00 00:00:00'),
(8, 'Psychologist', 1, 1, '0000-00-00 00:00:00'),
(9, 'ENT', 1, 1, '0000-00-00 00:00:00'),
(10, 'Orthopedic', 1, 1, '0000-00-00 00:00:00'),
(11, 'Radiology', 1, 1, '0000-00-00 00:00:00'),
(12, 'Skin', 1, 1, '0000-00-00 00:00:00'),
(13, 'Urology', 1, 1, '0000-00-00 00:00:00'),
(14, 'Cardiology', 1, 1, '0000-00-00 00:00:00'),
(15, 'Physiotherapy', 1, 1, '0000-00-00 00:00:00'),
(16, 'General Surgery', 1, 1, '0000-00-00 00:00:00'),
(17, 'Nutrition', 1, 1, '0000-00-00 00:00:00'),
(18, 'Cupping Therapist', 1, 1, '0000-00-00 00:00:00'),
(19, 'Speech Therapy', 1, 1, '0000-00-00 00:00:00'),
(20, 'Neurologist', 1, 1, '0000-00-00 00:00:00'),
(21, 'Medical Officer', 1, 1, '0000-00-00 00:00:00'),
(23, 'Test Department', 0, 1, '2022-08-06 10:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `DOCTOR_ID` int(10) NOT NULL,
  `DOCTOR_NAME` varchar(50) NOT NULL,
  `DOCTOR_MOBILE` varchar(15) NOT NULL,
  `DEPARTMENT_ID` int(10) NOT NULL,
  `DOCTOR_STATUS` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` int(10) NOT NULL,
  `DOCTOR_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`DOCTOR_ID`, `DOCTOR_NAME`, `DOCTOR_MOBILE`, `DEPARTMENT_ID`, `DOCTOR_STATUS`, `STAFF_ID`, `DOCTOR_DATE_TIME`) VALUES
(1, 'Brig (R) Dr Shamim Akhtar', '03351149823', 1, 1, 1, '0000-00-00 00:00:00'),
(2, 'Assist Prof Dr Riffat Sarwar', '03214822323', 1, 0, 1, '0000-00-00 00:00:00'),
(3, 'Dr Sohaib Malik Abbas', '03008016669', 2, 1, 1, '0000-00-00 00:00:00'),
(4, 'Brig (R) Dr Humma Farrukh', '03215214420', 3, 1, 1, '0000-00-00 00:00:00'),
(5, 'Brig (R) Dr Bashir Ahmad', '03459301357', 3, 1, 1, '0000-00-00 00:00:00'),
(6, 'Dr Hammad Aslma Butt', '03217121008', 4, 1, 1, '0000-00-00 00:00:00'),
(7, 'Maj Dr Bilal', '03494823007', 5, 1, 1, '0000-00-00 00:00:00'),
(8, 'Dr Muhammad Rashid Khan', '03008421108', 5, 1, 1, '0000-00-00 00:00:00'),
(9, 'Dr Javariya Hammad', '03334171809', 6, 1, 1, '0000-00-00 00:00:00'),
(10, 'Dr Mehdi Raza Khawaja', '03218401331', 7, 1, 1, '0000-00-00 00:00:00'),
(11, 'Dr Tanzeela Atif', '03226067885', 8, 1, 1, '0000-00-00 00:00:00'),
(12, 'Maj (R) Khalid Ahmed', '03224232396', 9, 1, 1, '0000-00-00 00:00:00'),
(13, 'Dr Faheem Nawaz', '03018498483', 10, 1, 1, '0000-00-00 00:00:00'),
(14, 'Dr Tayyab Rehman', '03336918555', 10, 1, 1, '0000-00-00 00:00:00'),
(15, 'Dr Salma Muzaffar', '03006355995', 11, 1, 1, '0000-00-00 00:00:00'),
(16, 'Prof Col (R) Dr Asghar Bhatti', '03218848231', 11, 1, 1, '0000-00-00 00:00:00'),
(17, 'Dr Sidra Tariq', '03235142071', 12, 1, 1, '0000-00-00 00:00:00'),
(18, 'Assoc Prof Dr Hassan Raza Asghar', '03228468880', 13, 1, 1, '0000-00-00 00:00:00'),
(19, 'Dr Kamran Zebi', '03334257695', 13, 1, 1, '0000-00-00 00:00:00'),
(20, 'Dr Sobbyal', '03338733138', 14, 1, 1, '0000-00-00 00:00:00'),
(21, 'Dr Sana Ayesha', '03124452951', 15, 1, 1, '0000-00-00 00:00:00'),
(22, 'Brig (R) Dr Tariq', '03015385256', 16, 1, 1, '0000-00-00 00:00:00'),
(23, 'Brig (R) Dr Javaid Hashmi', '03009197419', 16, 1, 1, '0000-00-00 00:00:00'),
(24, 'Dr Humaira Rashid Khan', '03008421108', 17, 1, 1, '0000-00-00 00:00:00'),
(25, 'Dr Javariya Asif', '03067029279', 17, 1, 1, '0000-00-00 00:00:00'),
(26, 'Dr Ayesha Nawaz', '71557028809', 18, 1, 1, '0000-00-00 00:00:00'),
(27, 'Dr Nida Zahid', '03311446896', 19, 1, 1, '0000-00-00 00:00:00'),
(28, 'Dr Humaira Nazir', '03234401468', 19, 1, 1, '0000-00-00 00:00:00'),
(29, 'Dr Adeeb', '03328675357', 20, 1, 1, '0000-00-00 00:00:00'),
(30, 'Dr Ayesha', '03054336062', 21, 1, 1, '0000-00-00 00:00:00'),
(31, 'Dr Arslan Amjad', '03234979798', 21, 1, 1, '0000-00-00 00:00:00'),
(32, 'Dr M Fahad Imtiaz', '03084040035', 21, 1, 1, '0000-00-00 00:00:00'),
(37, 'Test Mubeen', '03234169956', 1, 0, 1, '2022-08-06 07:58:59'),
(38, 'Test Doctor', '03218820280', 6, 1, 1, '2022-08-06 08:17:40'),
(39, 'Testing Doctor', '03128776604', 23, 1, 1, '2022-08-06 13:08:28');

-- --------------------------------------------------------

--
-- Table structure for table `edit_request`
--

CREATE TABLE `edit_request` (
  `REQUEST_ID` int(10) NOT NULL,
  `REQUEST_TABLE_ID` int(10) NOT NULL,
  `REQUEST_TABLE_NAME` varchar(100) NOT NULL,
  `REQUEST_NAME` varchar(50) NOT NULL,
  `REQUEST_COMMENT` varchar(250) NOT NULL,
  `REQUEST_STATUS` int(11) NOT NULL DEFAULT 0,
  `REQUEST_BY` int(11) NOT NULL,
  `REQUEST_ON` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_bill`
--

CREATE TABLE `emergency_bill` (
  `BILL_ID` int(10) NOT NULL,
  `MR_ID` varchar(20) NOT NULL,
  `SLIP_ID` int(10) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `MOBILE` varchar(50) NOT NULL,
  `DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `ES_MO_CHARGE` int(11) DEFAULT NULL,
  `INJECTION_IM` int(11) DEFAULT NULL,
  `INJECTION_IV` int(11) DEFAULT NULL,
  `IV_LINE` int(10) DEFAULT NULL,
  `IV_INFUSION` int(10) DEFAULT NULL,
  `PS_IN_300` int(10) DEFAULT NULL,
  `PS_OUT_100` int(10) DEFAULT NULL,
  `BSF_BSR` int(10) DEFAULT NULL,
  `SHORT_STAY` int(10) DEFAULT NULL,
  `BP` int(10) DEFAULT NULL,
  `ECG` int(10) DEFAULT NULL,
  `OTHER_1` int(10) DEFAULT NULL,
  `OTHER_TEXT_1` varchar(250) DEFAULT NULL,
  `OTHER_2` int(10) DEFAULT NULL,
  `OTHER_TEXT_2` varchar(250) DEFAULT NULL,
  `OTHER_3` int(10) DEFAULT NULL,
  `OTHER_TEXT_3` varchar(250) DEFAULT NULL,
  `OTHER_4` int(10) DEFAULT NULL,
  `OTHER_TEXT_4` varchar(250) DEFAULT NULL,
  `OTHER_5` int(10) DEFAULT NULL,
  `OTHER_TEXT_5` varchar(250) DEFAULT NULL,
  `OTHER_6` int(10) DEFAULT NULL,
  `OTHER_TEXT_6` varchar(250) DEFAULT NULL,
  `OTHER_7` int(10) DEFAULT NULL,
  `OTHER_TEXT_7` varchar(250) DEFAULT NULL,
  `OTHER_8` int(10) DEFAULT NULL,
  `OTHER_TEXT_8` varchar(250) DEFAULT NULL,
  `OTHER_9` int(10) DEFAULT NULL,
  `OTHER_TEXT_9` varchar(250) DEFAULT NULL,
  `OTHER_10` int(10) DEFAULT NULL,
  `OTHER_TEXT_10` varchar(250) DEFAULT NULL,
  `OTHER_11` int(10) DEFAULT NULL,
  `OTHER_TEXT_11` varchar(250) DEFAULT NULL,
  `OTHER_12` int(10) DEFAULT NULL,
  `OTHER_TEXT_12` varchar(250) DEFAULT NULL,
  `TOTAL_AMOUNT` int(15) DEFAULT NULL,
  `DISCOUNT` int(15) DEFAULT NULL,
  `TOTAL` int(15) DEFAULT NULL,
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `emergency_slip`
--

CREATE TABLE `emergency_slip` (
  `SLIP_ID` int(10) NOT NULL,
  `SLIP_MR_ID` varchar(20) NOT NULL,
  `SLIP_NAME` varchar(50) NOT NULL,
  `SLIP_MOBILE` varchar(15) NOT NULL,
  `DOCTOR_NAME` varchar(100) NOT NULL,
  `SLIP_DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` int(10) NOT NULL,
  `BILL_STATUS` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indoor_bill`
--

CREATE TABLE `indoor_bill` (
  `BILL_ID` int(10) NOT NULL,
  `MR_ID` varchar(20) NOT NULL,
  `SLIP_ID` int(10) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `MOBILE` varchar(50) NOT NULL,
  `ADMISSION_DATE` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `DISCHARGE_DATE` timestamp NULL DEFAULT current_timestamp(),
  `DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `ADMISSION_CHARGE` int(11) DEFAULT NULL,
  `SURGEON_CHARGE` int(11) DEFAULT NULL,
  `ANESTHETIST_CHARGE` int(11) DEFAULT NULL,
  `OPERATION_CHARGE` int(10) DEFAULT NULL,
  `LABOUR_ROOM_CHARGE` int(10) DEFAULT NULL,
  `PEDIATRIC_CHARGE` int(10) DEFAULT NULL,
  `PRIVATE_ROOM_CHARGE` int(10) DEFAULT NULL,
  `NURSURY_CHARGE` int(10) DEFAULT NULL,
  `NURSURY_STAFF_CHARGE` int(10) DEFAULT NULL,
  `MO_CHARGE` int(10) DEFAULT NULL,
  `CONSULTANT_CHARGE` int(10) DEFAULT NULL,
  `CTG_CHARGE` int(20) DEFAULT NULL,
  `RECOVERY_ROOM_CHARGE` int(20) DEFAULT NULL,
  `MONITOR_CHARGE` int(20) DEFAULT NULL,
  `NURSING_CHARGE` int(20) DEFAULT NULL,
  `OXYGEN_CHARGE` int(20) DEFAULT NULL,
  `OTHER` int(10) DEFAULT NULL,
  `OTHER_TEXT` varchar(250) DEFAULT NULL,
  `TOTAL_AMOUNT` int(15) DEFAULT NULL,
  `DISCOUNT` int(15) DEFAULT NULL,
  `TOTAL` int(15) DEFAULT NULL,
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indoor_slip`
--

CREATE TABLE `indoor_slip` (
  `SLIP_ID` int(10) NOT NULL,
  `SLIP_MR_ID` varchar(20) NOT NULL,
  `SLIP_NAME` varchar(100) NOT NULL,
  `SLIP_MOBILE` varchar(15) NOT NULL,
  `DEPT_ID` int(10) NOT NULL,
  `DOCTOR_NAME` varchar(100) NOT NULL,
  `SLIP_PROCEDURE` varchar(200) NOT NULL,
  `SLIP_TYPE` varchar(20) NOT NULL,
  `SLIP_DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` int(10) NOT NULL,
  `BILL_STATUS` varchar(15) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `indoor_type`
--

CREATE TABLE `indoor_type` (
  `TYPE_ID` int(11) NOT NULL,
  `TYPE_NAME` varchar(100) CHARACTER SET latin1 NOT NULL,
  `TYPE_ALAIS` varchar(15) CHARACTER SET latin1 NOT NULL,
  `TYPE_SAVE_TIME` datetime NOT NULL DEFAULT current_timestamp(),
  `TYPE_STATUS` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `indoor_type`
--

INSERT INTO `indoor_type` (`TYPE_ID`, `TYPE_NAME`, `TYPE_ALAIS`, `TYPE_SAVE_TIME`, `TYPE_STATUS`, `STAFF_ID`) VALUES
(1, 'Gynae Patient', 'gynae', '0000-00-00 00:00:00', 1, 1),
(2, 'General Surgery', 'gensurgery', '0000-00-00 00:00:00', 1, 1),
(3, 'General Illness', 'genillness', '0000-00-00 00:00:00', 1, 1),
(4, 'Eye Patient', 'eye', '0000-00-00 00:00:00', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `outdoor_slip`
--

CREATE TABLE `outdoor_slip` (
  `SLIP_ID` int(10) NOT NULL,
  `SLIP_MR_ID` varchar(20) NOT NULL,
  `SLIP_NAME` varchar(100) NOT NULL,
  `SLIP_MOBILE` varchar(15) NOT NULL,
  `DEPT_ID` int(10) NOT NULL,
  `DOCTOR_NAME` varchar(100) NOT NULL,
  `SLIP_FEE` int(10) NOT NULL,
  `SLIP_DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp(),
  `STAFF_ID` int(10) NOT NULL,
  `D_TYPE` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `PATIENT_ID` int(10) NOT NULL,
  `PATIENT_MR_ID` varchar(25) NOT NULL,
  `PATIENT_NAME` varchar(100) NOT NULL,
  `PATIENT_MOBILE` varchar(15) NOT NULL,
  `PATIENT_GENDER` varchar(20) NOT NULL,
  `PATIENT_AGE` varchar(10) NOT NULL,
  `PATIENT_ADDRESS` varchar(100) DEFAULT NULL,
  `CREATED_ON` timestamp NOT NULL DEFAULT current_timestamp(),
  `CREATED_BY` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `room`
--

CREATE TABLE `room` (
  `ROOM_ID` int(10) NOT NULL,
  `ROOM_NAME` varchar(100) NOT NULL,
  `ROOM_RATE` int(20) NOT NULL,
  `ROOM_STATUS` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` int(10) NOT NULL,
  `ROOM_DATE_TIME` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `visitor_doctor`
--

CREATE TABLE `visitor_doctor` (
  `VISITOR_ID` int(10) NOT NULL,
  `VISITOR_NAME` varchar(50) NOT NULL,
  `VISITOR_STATUS` int(10) NOT NULL DEFAULT 1,
  `STAFF_ID` int(10) NOT NULL,
  `VISITOR_DATE_TIME` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`ADMIN_ID`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`DEPARTMENT_ID`),
  ADD KEY `ADMIN_STAFF_ID` (`STAFF_ID`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`DOCTOR_ID`),
  ADD KEY `DOCTOR_STAFF_ID` (`STAFF_ID`),
  ADD KEY `DEPT_DOCTOR_ID` (`DEPARTMENT_ID`);

--
-- Indexes for table `edit_request`
--
ALTER TABLE `edit_request`
  ADD PRIMARY KEY (`REQUEST_ID`),
  ADD KEY `FK_STAFF_EDIT_REQUEST` (`REQUEST_BY`);

--
-- Indexes for table `emergency_bill`
--
ALTER TABLE `emergency_bill`
  ADD PRIMARY KEY (`BILL_ID`),
  ADD KEY `EMERGENCY_SLIP_ID` (`SLIP_ID`),
  ADD KEY `BILL_STAFF_ID` (`CREATED_BY`);

--
-- Indexes for table `emergency_slip`
--
ALTER TABLE `emergency_slip`
  ADD PRIMARY KEY (`SLIP_ID`),
  ADD KEY `FK_EMERGENCY_SLIP_ADMIN_ID` (`STAFF_ID`);

--
-- Indexes for table `indoor_bill`
--
ALTER TABLE `indoor_bill`
  ADD PRIMARY KEY (`BILL_ID`),
  ADD KEY `FK_INDOOR_SLIP_ID` (`SLIP_ID`),
  ADD KEY `FK_INDOOR_STAFF_ID` (`CREATED_BY`);

--
-- Indexes for table `indoor_slip`
--
ALTER TABLE `indoor_slip`
  ADD PRIMARY KEY (`SLIP_ID`),
  ADD KEY `FK_SLIP_DEPARTMENT_ID` (`DEPT_ID`),
  ADD KEY `FK_SLIP_STAFF_ID` (`STAFF_ID`);

--
-- Indexes for table `indoor_type`
--
ALTER TABLE `indoor_type`
  ADD PRIMARY KEY (`TYPE_ID`),
  ADD KEY `FK_INDOOR_TYPE_STAFF_ID` (`STAFF_ID`);

--
-- Indexes for table `outdoor_slip`
--
ALTER TABLE `outdoor_slip`
  ADD PRIMARY KEY (`SLIP_ID`),
  ADD KEY `OUTDOOR_SLIP_DEPT_ID` (`DEPT_ID`),
  ADD KEY `FK_OUTDOOR_SLIP_STAFF_ID` (`STAFF_ID`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`PATIENT_ID`),
  ADD UNIQUE KEY `PATIENT_MOBILE` (`PATIENT_MOBILE`),
  ADD KEY `FK_PATIENT_STAFF_ID` (`CREATED_BY`);

--
-- Indexes for table `room`
--
ALTER TABLE `room`
  ADD PRIMARY KEY (`ROOM_ID`),
  ADD KEY `FK_ROOM_STAFF_ID` (`STAFF_ID`);

--
-- Indexes for table `visitor_doctor`
--
ALTER TABLE `visitor_doctor`
  ADD PRIMARY KEY (`VISITOR_ID`),
  ADD KEY `FK_VISITOR_DOCTOR_STAFF_ID` (`STAFF_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `ADMIN_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `DEPARTMENT_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `DOCTOR_ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `edit_request`
--
ALTER TABLE `edit_request`
  MODIFY `REQUEST_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emergency_bill`
--
ALTER TABLE `emergency_bill`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emergency_slip`
--
ALTER TABLE `emergency_slip`
  MODIFY `SLIP_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indoor_bill`
--
ALTER TABLE `indoor_bill`
  MODIFY `BILL_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indoor_slip`
--
ALTER TABLE `indoor_slip`
  MODIFY `SLIP_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `indoor_type`
--
ALTER TABLE `indoor_type`
  MODIFY `TYPE_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `outdoor_slip`
--
ALTER TABLE `outdoor_slip`
  MODIFY `SLIP_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `PATIENT_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `room`
--
ALTER TABLE `room`
  MODIFY `ROOM_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `visitor_doctor`
--
ALTER TABLE `visitor_doctor`
  MODIFY `VISITOR_ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `ADMIN_STAFF_ID` FOREIGN KEY (`STAFF_ID`) REFERENCES `admin` (`ADMIN_ID`);

--
-- Constraints for table `doctor`
--
ALTER TABLE `doctor`
  ADD CONSTRAINT `DEPT_DOCTOR_ID` FOREIGN KEY (`DEPARTMENT_ID`) REFERENCES `department` (`DEPARTMENT_ID`),
  ADD CONSTRAINT `DOCTOR_STAFF_ID` FOREIGN KEY (`STAFF_ID`) REFERENCES `admin` (`ADMIN_ID`);

--
-- Constraints for table `edit_request`
--
ALTER TABLE `edit_request`
  ADD CONSTRAINT `FK_STAFF_EDIT_REQUEST` FOREIGN KEY (`REQUEST_BY`) REFERENCES `admin` (`ADMIN_ID`);

--
-- Constraints for table `emergency_bill`
--
ALTER TABLE `emergency_bill`
  ADD CONSTRAINT `BILL_STAFF_ID` FOREIGN KEY (`CREATED_BY`) REFERENCES `admin` (`ADMIN_ID`),
  ADD CONSTRAINT `EMERGENCY_SLIP_ID` FOREIGN KEY (`SLIP_ID`) REFERENCES `emergency_slip` (`SLIP_ID`);

--
-- Constraints for table `emergency_slip`
--
ALTER TABLE `emergency_slip`
  ADD CONSTRAINT `FK_EMERGENCY_SLIP_ADMIN_ID` FOREIGN KEY (`STAFF_ID`) REFERENCES `admin` (`ADMIN_ID`);

--
-- Constraints for table `indoor_bill`
--
ALTER TABLE `indoor_bill`
  ADD CONSTRAINT `FK_INDOOR_SLIP_ID` FOREIGN KEY (`SLIP_ID`) REFERENCES `indoor_slip` (`SLIP_ID`),
  ADD CONSTRAINT `FK_INDOOR_STAFF_ID` FOREIGN KEY (`CREATED_BY`) REFERENCES `admin` (`ADMIN_ID`);

--
-- Constraints for table `indoor_slip`
--
ALTER TABLE `indoor_slip`
  ADD CONSTRAINT `FK_SLIP_DEPARTMENT_ID` FOREIGN KEY (`DEPT_ID`) REFERENCES `department` (`DEPARTMENT_ID`),
  ADD CONSTRAINT `FK_SLIP_STAFF_ID` FOREIGN KEY (`STAFF_ID`) REFERENCES `admin` (`ADMIN_ID`);

--
-- Constraints for table `indoor_type`
--
ALTER TABLE `indoor_type`
  ADD CONSTRAINT `FK_INDOOR_TYPE_STAFF_ID` FOREIGN KEY (`STAFF_ID`) REFERENCES `admin` (`ADMIN_ID`);

--
-- Constraints for table `outdoor_slip`
--
ALTER TABLE `outdoor_slip`
  ADD CONSTRAINT `FK_OUTDOOR_SLIP_STAFF_ID` FOREIGN KEY (`STAFF_ID`) REFERENCES `admin` (`ADMIN_ID`),
  ADD CONSTRAINT `OUTDOOR_SLIP_DEPT_ID` FOREIGN KEY (`DEPT_ID`) REFERENCES `department` (`DEPARTMENT_ID`);

--
-- Constraints for table `patient`
--
ALTER TABLE `patient`
  ADD CONSTRAINT `FK_PATIENT_STAFF_ID` FOREIGN KEY (`CREATED_BY`) REFERENCES `admin` (`ADMIN_ID`);

--
-- Constraints for table `room`
--
ALTER TABLE `room`
  ADD CONSTRAINT `FK_ROOM_STAFF_ID` FOREIGN KEY (`STAFF_ID`) REFERENCES `admin` (`ADMIN_ID`);

--
-- Constraints for table `visitor_doctor`
--
ALTER TABLE `visitor_doctor`
  ADD CONSTRAINT `FK_VISITOR_DOCTOR_STAFF_ID` FOREIGN KEY (`STAFF_ID`) REFERENCES `admin` (`ADMIN_ID`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
